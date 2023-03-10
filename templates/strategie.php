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
      <button id="search-button" class="tab-button" onclick="openTab(event, 'search')"><span>Vyh??ad??vanie strat??gi??</span></button>
      <button id="detail-button" class="tab-button" onclick="openTab(event, 'detail')"><span>Detail strat??gie</span></button>
    </div>
    
    <div id="search" class="tab-content">
    
    <form class="main-form" name="main-form" action="javascript:main();">
      <div class="wrapper-form">
        <fieldset class="ministry-field">
          <legend>Rezort:</legend>
          <select name="ministry">
            <option value="V??etky">V??etky</option>
            <option value="MDaV SR" selected>Ministerstvo dopravy a v??stavby SR</option>
            <option value="MF SR">Ministerstvo financi?? SR</option>
            <option value="MH SR">Ministerstvo hospod??rstva SR</option>
            <option value="MK SR">Ministerstvo kult??ry SR</option>
            <option value="MO SR">Ministerstvo obrany SR</option>
            <option value="MPaRV SR">Ministerstvo p??dohospod??rstva a rozvoja vidieka SR</option>
            <option value="MPSVaR SR">Ministerstvo pr??ce, soci??lnych vec?? a rodiny SR</option>
            <option value="MS SR">Ministerstvo spravodlivosti SR</option>
            <option value="M??VVa?? SR">Ministerstvo ??kolstva, vedy, v??skumu a ??portu SR</option>
            <option value="MV SR">Ministerstvo vn??tra SR</option>
            <option value="MZVaEZ SR">Ministerstvo zahrani??n??ch vec?? a eur??pskych z??le??itost?? SR</option>
            <option value="MZ SR">Ministerstvo zdravotn??ctva SR</option>
            <option value="M??P SR">Ministerstvo ??ivotn??ho prostredia SR</option>
            <option value="??PVII SR">??rad podpredsedu vl??dy SR pre invest??cie a informatiz??ciu</option>
            <option value="??V SR">??rad vl??dy SR</option>
          </select> 
        </fieldset>
      
      
        <fieldset class="area-field">
          <legend>Obsah:</legend>
          <select name="area">
            <option value="V??etky">V??etky</option>
            <option value="Bezpe??nos?? a obrana">Bezpe??nos?? a obrana</option>
            <option value="Cestovn?? ruch">Cestovn?? ruch</option>
            <option value="Doprava">Doprava</option>
            <option value="Energetika">Energetika</option>
            <option value="Financie a rozpo??et">Financie a rozpo??et</option>
            <option value="Informatiz??cia">Informatiz??cia</option>
            <option value="Koordin??cia riadenia ??t??tu">Koordin??cia riadenia ??t??tu</option>
            <option value="Kult??ra">Kult??ra</option>
            <option value="Medzin??rodn?? vz??ahy">Medzin??rodn?? vz??ahy</option>
            <option value="Podnikate??sk?? prostredie">Podnikate??sk?? prostredie</option>
            <option value="Po??ty a telekomunik??cie">Po??ty a telekomunik??cie</option>
            <option value="P??dohospod??rstvo">P??dohospod??rstvo</option>
            <option value="Priemysel">Priemysel</option>
            <option value="Region??lny rozvoj">Region??lny rozvoj</option>
            <option value="Rodinn?? politika">Rodinn?? politika</option>
            <option value="Soci??lne slu??by">Soci??lne slu??by</option>
            <option value="Soci??lne za??lenenie">Soci??lne za??lenenie</option>
            <option value="Spravodlivos??">Spravodlivos??</option>
            <option value="Veda, v??skum a inov??cie">Veda, v??skum a inov??cie</option>
            <option value="V??stavba, bytov?? politika">V??stavba, bytov?? politika</option>
            <option value="Vzdelanie, ml??de??, ??port">Vzdelanie, ml??de??, ??port</option>
            <option value="Zamestnanos?? a trh pr??ce">Zamestnanos?? a trh pr??ce</option>
            <option value="Zdravotn??ctvo">Zdravotn??ctvo</option>
            <option value="??ivotn?? prostredie">??ivotn?? prostredie</option>
          </select> 
        </fieldset>
        
        <fieldset class="state-field">
          <legend>Stav:</legend>
          <input type="radio" name="state" value="V??etky" checked>V??etky
          <br>
          <input type="radio" name="state" value="Aktu??lna">Aktu??lne
          <br>
          <input type="radio" name="state" value="Nevyu????van??">Nevyu????van??
          <br>
          <input type="radio" name="state" value="Pripravovan??">Pripravovan??
          <br>
          <input type="radio" name="state" value="Zru??en??">Zru??en??
        </fieldset>
      
        <fieldset class="level-field">
          <legend>??rove??:</legend>
          <input type="radio" name="level" value="V??etky" checked>V??etky
          <br>
          <input type="radio" name="level" value="Rezortn??">Rezortn??
          <br>
          <input type="radio" name="level" value="Region??lna">Region??lna
          <br>
          <input type="radio" name="level" value="Celo??t??tna">Celo??t??tna
        </fieldset>
      
        <fieldset class="start-field">
          <legend>Platnos?? od:</legend>
          <input type="number" name="start" min="0" max="9999" step="1" value="1990" required>
        </fieldset>
      
        <fieldset class="finish-field">
          <legend>Platnos?? do:</legend>
          <input type="number" name="finish" min="0" max="9999" step="1" value="2030" required>
        </fieldset>
      
        <fieldset class="submit-field">
          <input id="submit-button" type="submit" value="H??adaj">
        </fieldset>
      
        <fieldset class="count-field">
          <legend>V??sledok vyh??ad??vania:</legend>
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
