//https://www.w3schools.com/howto/howto_js_tabs.asp
function openTab(evt, tabName) {
  $("html, body").animate({ scrollTop: 0 }, "slow");
  var i, tabContents, tabButtons;

  // loop through content divs and hide them 
  tabContents = document.getElementsByClassName("tab-content");
  for (i = 0; i < tabContents.length; i++) {
    tabContents[i].style.display = "none";
  }

  // loop through buttons and remove "active" from their class names 
  tabButtons = document.getElementsByClassName("tab-button");
  for (i = 0; i < tabButtons.length; i++) {
    tabButtons[i].className = tabButtons[i].className.replace(" active", "");
  }

  // show content 
  document.getElementById(tabName).style.display = "block";
  // add "active" to the button class name
  evt.currentTarget.className += " active";
}		
			
function isYear(str) {		
  return Number.isInteger(parseInt(str));		
}

/* 
 * It is important to have the all/Všetky option in the drop-down menus
 * and radio buttons. This selection then includes strategies
 * that have other then pre-defined values, e.g. empty cells or "N/A".
 */
function isSelected(strat) {
  form = document.forms["main-form"];
  var boolMinistry;
  var boolArea;
  var boolState;
  var boolLevel;
  var boolYear;
  var valState;
  var valLevel;
  var valStart;
  var valFinish;
  var valuesAreGood;

  if (form["ministry"].value == "Všetky") {
    boolMinistry = true;
  } else {
    boolMinistry = (form["ministry"].value == strat.ministry);
  }

  if (form["area"].value == "Všetky") {
    boolArea = true;
  } else {
    boolArea = (form["area"].value == strat.area);
  }

  valState = document.querySelector('input[name="state"]:checked').value;
  if (valState == "Všetky") {
    boolState = true;
  } else {
    boolState = (valState == strat.state);
  }

  valLevel = document.querySelector('input[name="level"]:checked').value;
  if (valLevel == "Všetky") {
    boolLevel = true;
  } else {
    boolLevel = (valLevel == strat.level);
  }
  
  // use year filter only if we have valid numbers in the database and 
  // in the form
  boolYear = true;
  if (isYear(form["start"].value) && isYear(form["finish"].value) &&
      isYear(strat.nominalStart) && isYear(strat.nominalFinish)) {
    boolYear = false;
    
    // if there is no overlap between strategy interval and interval in the form
    // do not show the strategy
    console.log(form["finish"].value + " - " + strat.nominalFinish);
    console.log(form["start"].value + " - " + strat.nominalStart);
    if (parseInt(form["finish"].value) >= parseInt(strat.nominalFinish) &&
      parseInt(form["start"].value) <= parseInt(strat.nominalStart)) {
      boolYear = true;

    }
  }

/*
  checkboxes = form["level"];
  for (i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      checked.push(checkboxes[i].value);
    }
  }
  boolLevel = checked.includes(strat.level);
*/

  return boolMinistry && boolArea && boolState  && boolLevel && boolYear;
}



var dict = {};
dict.ministry = 'Rezort';
dict.title = 'Názov strategického dokumentu'; 
dict.area = 'Obsahové zameranie strategického dokumentu';
dict.level = 'Úroveň platnosti strategického dokumentu';
dict.state = 'Stav'; 
dict.nominalStart = 'Platnosť od'; 
dict.nominalFinish = 'Platnosť do'; 
dict.parentLegislative = 'Podnet na vypracovanie materiálu';
dict.relatedDocument = 'Súvisiaci dokument (nadradená stratégia alebo podriadený akčný plán)';
dict.annotation = 'Anotácia dokumentu (textové pole)';
dict.note = 'Poznámka k dokumentu';

dict.decreeNumber = 'Číslo uznesenia';
dict.documentLink = 'Odkaz na dokument';	
dict.approvalDate = 'Dátum schválenia';
dict.reviewer = 'Vyhodnotenie plnenia strategického dokumentu (NR SR, vláda SR, ministerstvo)';
dict.reviewForm = 'Forma vyhodnotenia a monitorovania strategického dokumentu';
dict.reviewFreq = 'Opakovací cyklus vyhodnocovania strategického dokumentu';

dict.terminationReason = 'Dôvod zastaranosti strategického dokumentu';
dict.successor = 'Aktualizácia resp. nahradenie strategického dokumentu novým dokumentom';
dict.officialStart = 'Termín kedy tento strategický dokument vstúpil do platnosti';
dict.cancellationProposal = 'Návrhy na formálne zrušenie strategického dokumentu';

dict.preparationStart = 'Termín začatia prác na strategickom dokumente'; 
dict.preparationStatus = 'Štádium prípravy';
dict.preparationFinish = 'Predpokladaný termín dopracovania';
dict.approvingBody = 'Spôsob schválenia (napr. vládou SR, vedením ministerstva)';


/*
 * planned:  blue orange 
 * current:  blue green
 * obsolete: blue green red 
 *
 */
function viewDetail(strat) {
  var table;
  var row;
  var key;
  var html;
  var blue, green, red, orange;
  var i;

  table = document.getElementById("detail-table");
  table.innerHTML = '';

  //https://stackoverflow.com/questions/684672/how-do-i-loop-through-or-enumerate-a-javascript-object
  blue = ['ministry','title','area','level','state','nominalStart','nominalFinish','parentLegislative','relatedDocument','annotation','note'];
  for (i = 0; i < blue.length; i++) {
    key = blue[i];
    row = table.insertRow();

    row.insertCell(0).innerHTML = dict[key];
    if (key == 'relatedDocument') {
      row.insertCell(1).innerHTML = '<a href = "' + strat[key] + '">' + strat[key] + '</a>';
    }
    else {
      row.insertCell(1).innerHTML = strat[key];
    }
  }

  if (strat.state == "Aktuálna" || strat.state == "Nevyužívaná") {
    green = ['decreeNumber','approvalDate','reviewer','reviewForm','reviewFreq'];
    for (i = 0; i < green.length; i++) {
      key = green[i];
      row = table.insertRow();

      row.insertCell(0).innerHTML = dict[key];

      html = strat[key];
      if (key == 'decreeNumber' && html != null) {
        html = '<a href = "' + strat['documentLink'] + '">' + html + '</a>';
      }
      row.insertCell(1).innerHTML = html;
    }
  }


  if (strat.state == "Nevyužívaná") {
    red = ['terminationReason','successor','officialStart','cancellationProposal'];
    for (i = 0; i < red.length; i++) {
      key = red[i];
      row = table.insertRow();

      row.insertCell(0).innerHTML = dict[key];
      row.insertCell(1).innerHTML = strat[key];
    }
  }
                   
  if (strat.state == "Pripravovaná") {
    orange = ['preparationStart','preparationStatus','preparationFinish','approvingBody'];
    for (i = 0; i < orange.length; i++) {
      key = orange[i];
      row = table.insertRow();

      row.insertCell(0).innerHTML = dict[key];
      row.insertCell(1).innerHTML = strat[key];;
    }
  }

  document.getElementById("main-content").classList.add("activated-strategy")

  document.getElementById("detail-button").click();

}

var hasBeen = false

function main()
{
  var i;
  var table;
  var url;
  var request;
  var strategies;
  var strat;
  var row;
  var cell0, cell1, cell2, cell3;
  var count;
  var countStr;

  table = document.getElementById("search-table");
  table.innerHTML = '<tr>'
                  + '<th>Id</th>'
                  + '<th>Rezort</th>'
                  + '<th>Názov</th>'
                  + '<th>Obsah</th>'
                  + '</tr>';

  //get data
  /*url = "https://s3.eu-central-1.amazonaws.com/karol-min/strategies.json";
  request = new XMLHttpRequest();
  request.open("GET", url, false); // false for synchronous request
  request.send(null);
  strategies = JSON.parse(request.responseText);
  */
  strategies = excelFile
  //write table
  //https://www.w3schools.com/jsref/met_table_insertrow.asp
  //https://www.html5-tutorial.net/tables/changing-column-width/
  count = 0;
  for (i = 0; i < strategies.length; i++) {
    strat = strategies[i];
    if (isSelected(strat)) {
      row = table.insertRow();

      cell0 = row.insertCell(0);
      cell1 = row.insertCell(1);
      cell2 = row.insertCell(2);
      cell3 = row.insertCell(3);

      cell0.innerHTML = i;
      cell1.innerHTML = strat.ministry;
      cell2.innerHTML = strat.title;
      cell3.innerHTML = strat.area;

      row.onclick = function() { 
        var ind;
        ind = this.cells[0].innerHTML;
        viewDetail(strategies[ind]);
      }
      count += 1;
    }
  }

  if (count == 1) {
    countStr = count + " stratégia";
  } else if (count >= 2 && count <= 4) {
    countStr = count + " stratégie";
  } else {
    countStr = count + " stratégií";
  }

  document.getElementById("result-count").innerHTML = countStr;

  if(hasBeen) {
    $([document.documentElement, document.body]).animate({
      scrollTop: $("#search-table").offset().top - 100
    }, 500);
  } else {
    hasBeen = true
  }
}
