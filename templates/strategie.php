<?php
//Template name: Strategie
?>
<?php get_header(); ?>
<?php 
include(dirname(__FILE__) . DIRECTORY_SEPARATOR .'SimpleXLSX.php'); ?>
<?php
  $file = get_field('subor_strategii');
  
  
  $retJson = [];
  
  if ( $xlsx = SimpleXLSX::parse($_SERVER["DOCUMENT_ROOT"] . parse_url($file['url'])['path']) ) {
  	$rows = $xlsx->rows();
  	
  	foreach($rows as $i=>$row) {
  	  if($i == 0) {
  	    continue;
  	  } else {
  	    $item = [];
        $item['ministry'] = $row[0];
        $item['title'] = $row[1];
        $item['area'] = $row[2];
        $item['level'] = $row[4];
        $item['state'] = $row[5];
        $item['nominalStart'] = $row[6];
        $item['nominalFinish'] = $row[7];
        $item['parentLegislative'] = $row[8];
        $item['relatedDocument'] = $row[9];
        $item['annotation'] = $row[10];
        $item['note'] = $row[11];
        $item['decreeNumber'] = $row[12];
        $item['documentLink'] = $row[13];
        $item['approvalDate'] = $row[14];
        $item['reviewer'] = $row[15];
        $item['reviewForm'] = $row[16];
        $item['reviewFreq'] = $row[17];
        $item['terminationReason'] = $row[18];
        $item['successor'] = $row[19];
        $item['officialStart'] = $row[20];
        $item['cancellationProposal'] = $row[21];
        $item['preparationStart'] = $row[22];
        $item['preparationStatus'] = $row[23];
        $item['preparationFinish'] = $row[24];
        $item['approvingBody'] = $row[25];
        $retJson[] = $item;
  	  }
  	}
  } else {
  	echo SimpleXLSX::parseError();
  }
  
?>
  <script>
    var excelFile = <?php echo json_encode($retJson); ?>
  </script>
  <div class="govuk-width-container pdt-25 pdb-25 strategie">
    <div class="left">
      <img src="<?php theme_url(); ?>assets/img/strategie/lines-left.svg" alt="background image left margin">
    </div>
    <div class="right">
      <img src="<?php theme_url(); ?>assets/img/strategie/lines-right.svg" alt="background image">
    </div>
  
    <div class="tab">
      <button id="search-button" class="tab-button" onclick="openTab(event, 'search')"><span>Vyhľadávanie stratégií</span></button>
      <button id="detail-button" class="tab-button" onclick="openTab(event, 'detail')"><span>Detail stratégie</span></button>
    </div>
    
    <div id="search" class="tab-content">
    
    <form class="main-form" name="main-form" action="javascript:main();">
      <div class="wrapper-form">
        <fieldset class="ministry-field">
          <legend>Rezort:</legend>
          <select name="ministry">
            <option value="Všetky">Všetky</option>
            <option value="MDaV SR" selected>Ministerstvo dopravy a výstavby SR</option>
            <option value="MF SR">Ministerstvo financií SR</option>
            <option value="MH SR">Ministerstvo hospodárstva SR</option>
            <option value="MK SR">Ministerstvo kultúry SR</option>
            <option value="MO SR">Ministerstvo obrany SR</option>
            <option value="MPaRV SR">Ministerstvo pôdohospodárstva a rozvoja vidieka SR</option>
            <option value="MPSVaR SR">Ministerstvo práce, sociálnych vecí a rodiny SR</option>
            <option value="MS SR">Ministerstvo spravodlivosti SR</option>
            <option value="MŠVVaŠ SR">Ministerstvo školstva, vedy, výskumu a športu SR</option>
            <option value="MV SR">Ministerstvo vnútra SR</option>
            <option value="MZVaEZ SR">Ministerstvo zahraničných vecí a európskych záležitostí SR</option>
            <option value="MZ SR">Ministerstvo zdravotníctva SR</option>
            <option value="MŽP SR">Ministerstvo životného prostredia SR</option>
            <option value="ÚPVII SR">Úrad podpredsedu vlády SR pre investície a informatizáciu</option>
            <option value="ÚV SR">Úrad vlády SR</option>
          </select> 
        </fieldset>
      
      
        <fieldset class="area-field">
          <legend>Obsah:</legend>
          <select name="area">
            <option value="Všetky">Všetky</option>
            <option value="Bezpečnosť a obrana">Bezpečnosť a obrana</option>
            <option value="Cestovný ruch">Cestovný ruch</option>
            <option value="Doprava">Doprava</option>
            <option value="Energetika">Energetika</option>
            <option value="Financie a rozpočet">Financie a rozpočet</option>
            <option value="Informatizácia">Informatizácia</option>
            <option value="Koordinácia riadenia štátu">Koordinácia riadenia štátu</option>
            <option value="Kultúra">Kultúra</option>
            <option value="Medzinárodné vzťahy">Medzinárodné vzťahy</option>
            <option value="Podnikateľské prostredie">Podnikateľské prostredie</option>
            <option value="Pošty a telekomunikácie">Pošty a telekomunikácie</option>
            <option value="Pôdohospodárstvo">Pôdohospodárstvo</option>
            <option value="Priemysel">Priemysel</option>
            <option value="Regionálny rozvoj">Regionálny rozvoj</option>
            <option value="Rodinná politika">Rodinná politika</option>
            <option value="Sociálne služby">Sociálne služby</option>
            <option value="Sociálne začlenenie">Sociálne začlenenie</option>
            <option value="Spravodlivosť">Spravodlivosť</option>
            <option value="Veda, výskum a inovácie">Veda, výskum a inovácie</option>
            <option value="Výstavba, bytová politika">Výstavba, bytová politika</option>
            <option value="Vzdelanie, mládež, šport">Vzdelanie, mládež, šport</option>
            <option value="Zamestnanosť a trh práce">Zamestnanosť a trh práce</option>
            <option value="Zdravotníctvo">Zdravotníctvo</option>
            <option value="Životné prostredie">Životné prostredie</option>
          </select> 
        </fieldset>
        
        <fieldset class="state-field">
          <legend>Stav:</legend>
          <input type="radio" name="state" value="Všetky" checked>Všetky
          <br>
          <input type="radio" name="state" value="Aktuálna">Aktuálne
          <br>
          <input type="radio" name="state" value="Nevyužívaná">Nevyužívané
          <br>
          <input type="radio" name="state" value="Pripravovaná">Pripravované
          <br>
          <input type="radio" name="state" value="Zrušená">Zrušené
        </fieldset>
      
        <fieldset class="level-field">
          <legend>Úroveň:</legend>
          <input type="radio" name="level" value="Všetky" checked>Všetky
          <br>
          <input type="radio" name="level" value="Rezortná">Rezortná
          <br>
          <input type="radio" name="level" value="Regionálna">Regionálna
          <br>
          <input type="radio" name="level" value="Celoštátna">Celoštátna
        </fieldset>
      
        <fieldset class="start-field">
          <legend>Platnosť od:</legend>
          <input type="number" name="start" min="0" max="9999" step="1" value="1990" required>
        </fieldset>
      
        <fieldset class="finish-field">
          <legend>Platnosť do:</legend>
          <input type="number" name="finish" min="0" max="9999" step="1" value="2030" required>
        </fieldset>
      
        <fieldset class="submit-field">
          <input id="submit-button" type="submit" value="Hľadaj">
        </fieldset>
      
        <fieldset class="count-field">
          <legend>Výsledok vyhľadávania:</legend>
          <div id="result-count"></div>
        </fieldset>
      </div>
    </form>
    
    <div class="search-table-container">
      <table id="search-table">
      </table>
    </div>
    </div> <!-- search tab-->
    
    <div id="detail" class="tab-content">
      <table id="detail-table">
      </table>
    </div>
    <div class="container">
        <div class="row-eq-height">
            <div class="col-sm-24 col-md-12">
                <img src="<?php theme_url(); ?>/assets/img/OP-EVS-loga-farebne-SVK-600x150-300x113.png" alt=""/>
            </div>
            <div class="col-sm-24 col-md-12">
                <img src="<?php theme_url(); ?>/assets/img/logo-esf-600x150-300x72.png" alt=""/>
            </div>
        </div>
    </div>
  </div>


<?php get_footer(); ?>

<script>
  document.getElementById("search-button").click();
  document.getElementById("submit-button").click();
  //r = document.getElementById("search-table").rows.length;

</script>

</body>

</html>
