<?php

include_once("../inc/inc.Settings.php");
include_once("../inc/inc.DBAccess.php");
include_once("../inc/inc.ClassUI.php");
include_once("../inc/inc.Utils.php");
include_once("../inc/inc.CallStoredProcedures.php");
include_once("../inc/inc.Classes.php");
include_once("../inc/inc.ClassInicial.php");
include_once("../inc/inc.GetAllObjects.php");

global $settings, $db;

echo UI::htmlStartPage("Stats");
echo UI::htmlDataRolePage($settings->_default_data_theme, $settings->_default_data_content_theme);
echo UI::getHeader("Stats page home");

// -----------------------------------------------------------------------------
// Parámetros GET
$param_pais = "ESP";
if ((isset($_GET["pais"])) && ($_GET["pais"] != "")) {
    $param_pais = sanitizeString($_GET["pais"]);
}
$param_especialidad = 3;
if ((isset($_GET["especialidad"])) && ($_GET["especialidad"] != "")) {
    $param_especialidad = sanitizeString($_GET["especialidad"]);
}
$anyo = 2013;
if ((isset($_GET["anyo"])) && ($_GET["anyo"] != "")) {
    $anyo = sanitizeString($_GET["anyo"]);
}
$param_equipo = "-1";
if (isset($_GET["equipo"]) && ($_GET["equipo"] != "")) {
    $param_equipo = sanitizeString($_GET["equipo"]);
}
// Fin Parámetros GET
// -----------------------------------------------------------------------------

/*
$especialidades = getAllEspecialidades($param_especialidad);
$paises = getAllPaises($especialidades[0]->getAt("pais_id"));
$bandera = $paises[0]->getBandera();
*/
// inicializo valoras con los parámetros GET
if ($param_pais != "")
    $especialidades = getAllEspecialidadesByPais($param_pais);
else
    $especialidades = getAllEspecialidades();
//$especialidades = getAllEspecialidades($param_especialidad);
$paises = getAllPaises($especialidades[0]->getAt("pais_id"));
$bandera = $paises[0]->getBandera();
if (($param_especialidad == -1) || ($param_pais != "")) {
    $especialidad = $especialidades[0];
}
else {
    $especialidad = getAllEspecialidades($param_especialidad);
    $especialidad = $especialidad[0];
}



// Saco datos para Media y sistemáticas 1-X-2 y 1X-X2-12

$arr = array();
$arr[0] = $param_especialidad;
$arr[1] = $anyo;
$numPartidos = callProcedureSingle("numpartidos", $arr);
if ($param_equipo != -1) {
    $arr[2] = $param_equipo;
    $numPartidos = callProcedureSingle("numpartidosequipo", $arr);
}

$arr = null;
$arr[0] = '1';
$arr[1] = $param_especialidad;
$arr[2] = $anyo;

// Número de resultados de oportunidad única 0.33
if ($param_equipo == -1) {
    $resultados1s = callProcedureSingle("resultadosporcumplimiento", $arr);
    $arr[0] = 'X';
    $resultadosXs = callProcedureSingle("resultadosporcumplimiento", $arr);
    $arr[0] = '2';
    $resultados2s = callProcedureSingle("resultadosporcumplimiento", $arr);
    $arr = null;
}
else {
    $arr[3] = $param_equipo;
    $arr[0] = '1';
    $resultados1s = callProcedureSingle("resultadosporcumplimientoequipo", $arr);
    $arr[0] = 'X';
    $resultadosXs = callProcedureSingle("resultadosporcumplimientoequipo", $arr);
    $arr[0] = '2';
    $resultados2s = callProcedureSingle("resultadosporcumplimientoequipo", $arr);
    $arr = null;
}



// Número de resultados de doble oportunidad 0.66
$resultados1Xs = $resultados1s + $resultadosXs;
$resultadosX2s = $resultadosXs + $resultados2s;
$resultados12s = $resultados1s + $resultados2s;

if ($param_equipo == -1) {
    // Suma de ratios de oportunidad simple 0.33
    $arrmedia = array();
    $arrmedia[0] = $param_especialidad;
    $arrmedia[1] = $anyo;
    $arrmedia[2] = '1';
    $sumratios1 = callProcedureArray("sumratiosespecialidadanyoressimple", $arrmedia);
    $sumratios1 = $sumratios1[0]["post"]["sumratio1"];
    $arrmedia[2] = 'X';
    $sumratiosX = callProcedureArray("sumratiosespecialidadanyoressimple", $arrmedia);
    $sumratiosX = $sumratiosX[0]["post"]["sumratiox"];
    $arrmedia[2] = '2';
    $sumratios2 = callProcedureArray("sumratiosespecialidadanyoressimple", $arrmedia);
    $sumratios2 = $sumratios2[0]["post"]["sumratio2"];
    $arrmedia = null;
    
    // Suma de ratios de doble oportunidad 0.66
    $arrmedia = array();
    $arrmedia[0] = $param_especialidad;
    $arrmedia[1] = $anyo;
    $arrmedia[2] = "1";
    $arrmedia[3] = "X";
    $sumratios1X = callProcedureArray("sumratiosespecialidadanyoresdoble", $arrmedia);
    $sumratios1X = $sumratios1X[0]["post"]["sumratio1x"];
    $arrmedia[2] = "X";
    $arrmedia[3] = "2";
    $sumratiosX2 = callProcedureArray("sumratiosespecialidadanyoresdoble", $arrmedia);
    $sumratiosX2 = $sumratiosX2[0]["post"]["sumratiox2"];
    $arrmedia[2] = "1";
    $arrmedia[3] = "2";
    $sumratios12 = callProcedureArray("sumratiosespecialidadanyoresdoble", $arrmedia);
    $sumratios12 = $sumratios12[0]["post"]["sumratio12"];
    $arrmedia = null;

} // if ($param_equipo == -1)
else {
    // Suma de ratios de oportunidad simple 0.33
    $arrmedia = array();
    $arrmedia[0] = $param_especialidad;
    $arrmedia[1] = $anyo;
    $arrmedia[2] = '1';
    $arrmedia[3] = $param_equipo;
    $sumratios1 = callProcedureArray("sumratiosespecialidadanyoressimpleequipo", $arrmedia);
    $sumratios1 = $sumratios1[0]["post"]["sumratio1"];
    $arrmedia[2] = 'X';
    $sumratiosX = callProcedureArray("sumratiosespecialidadanyoressimpleequipo", $arrmedia);
    $sumratiosX = $sumratiosX[0]["post"]["sumratiox"];
    $arrmedia[2] = '2';
    $sumratios2 = callProcedureArray("sumratiosespecialidadanyoressimpleequipo", $arrmedia);
    $sumratios2 = $sumratios2[0]["post"]["sumratio2"];
    $arrmedia = null;
    
    // Suma de ratios de doble oportunidad 0.66
    $arrmedia = array();
    $arrmedia[0] = $param_especialidad;
    $arrmedia[1] = $anyo;
    $arrmedia[2] = "1";
    $arrmedia[3] = "X";
    $arrmedia[4] = $param_equipo;
    $sumratios1X = callProcedureArray("sumratiosespecialidadanyoresdobleequipo", $arrmedia);
    $sumratios1X = $sumratios1X[0]["post"]["sumratio1x"];
    $arrmedia[2] = "X";
    $arrmedia[3] = "2";
    $sumratiosX2 = callProcedureArray("sumratiosespecialidadanyoresdobleequipo", $arrmedia);
    $sumratiosX2 = $sumratiosX2[0]["post"]["sumratiox2"];
    $arrmedia[2] = "1";
    $arrmedia[3] = "2";
    $sumratios12 = callProcedureArray("sumratiosespecialidadanyoresdobleequipo", $arrmedia);
    $sumratios12 = $sumratios12[0]["post"]["sumratio12"];
    $arrmedia = null;

} // else if (param_equipo == -1)

?>

<div data-role="controlgroup" data-type="horizontal">
  <a href="../out/out.Stats.Home.php?origen=Home&pais=ESP" data-role="button"><img src="../images/icons/flags/ESP_icon.gif" width=23></a>
  <a href="../out/out.Stats.Home.php?origen=Home&pais=GBP" data-role="button"><img src="../images/icons/flags/GBP_icon.gif" width=23></a>
  <a href="../out/out.Stats.Home.php?origen=Home&pais=DEU" data-role="button"><img src="../images/icons/flags/DEU_icon.gif" width=23></a>
  <a href="../out/out.Stats.Home.php?origen=Home&pais=ITA" data-role="button"><img src="../images/icons/flags/ITA_icon.gif" width=23></a>
  <a href="../out/out.Stats.Home.php?origen=Home&pais=NOR" data-role="button"><img src="../images/icons/flags/NOR_icon.gif" width=23></a>
  <a href="../out/out.Stats.Home.php?origen=Home&pais=SWE" data-role="button"><img src="../images/icons/flags/SWE_icon.gif" width=23></a>
  <a href="../out/out.Stats.Home.php?origen=Home&pais=FIN" data-role="button"><img src="../images/icons/flags/FIN_icon.gif" width=23></a>
</div>
<div data-role="fieldcontain">
	<a href="<?php echo "../out/out.Select.Especialidad.php?origen=Home&pais=".$param_pais;?>">Seleccione especialidad</a>
  <a href="<?php echo "../out/out.Select.Equipo.php?origen=Home&especialidad=".$param_especialidad;?>">Seleccione equipo</a>
</div>

<fieldset class="ui-grid-a">
	<div class="ui-block-a">
    <div data-role="fieldcontain">
      <li><?php echo $bandera.$classUI->getImageTag($settings->_imagesDir.$settings->_iconImagesDir.getRutaImagen($especialidades[0]->getAt("id")), "icon", "", $especialidades[0]->getAt("nombre"), $especialidades[0]->getAt("nombre"), "width=40"); ?></li>
      <?php
      if ($param_equipo == -1) {
      ?>
          <li>No has seleccionado equipo</li>
      <?php } else { ?>
          <li><?php
              $equipo = getAllEquipos($param_equipo);
              echo $equipo[0]->getAt("nombre");
              $arrParams = array();
              $arrParams[0] = $param_especialidad;
              $arrParams[1] = $anyo;
              $arrParams[2] = $param_equipo;
              $max_slider = callProcedureSingle("puntuacionequipo", $arrParams); 
          }
          ?>
          </li>
    </div>
  </div>
	<div class="ui-block-b">
    <?php if ($param_equipo != -1) { ?>
    <img src=<?php echo "../images/icons/teams/".str_replace(" ", "", strtolower($equipo[0]->getAt("nombre"))).".png";?> width=70 />
    <?php } ?>
  </div>
</fieldset>

<!-- Muestro la estructura para Media y sistemáticas 1-X-2 -->
  <div class="celda_datos">
  	<h5>Media y sistemáticas 1-X-2</h5>
    <div data-role="fieldcontain">
      <label for="slider">Número de partidos que finalizan en 1-X-2:</label>
    </div>
    <div data-role="fieldcontain">
      <label for="slider">1's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo $resultados1s; ?>" min="0" max="<?php echo $numPartidos; ?>" disabled />
    </div>
    <div data-role="fieldcontain">
      <label for="slider">X's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo $resultadosXs; ?>" min="0" max="<?php echo $numPartidos; ?>" disabled />
    </div>
    <div data-role="fieldcontain">
      <label for="slider">2's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo $resultados2s; ?>" min="0" max="<?php echo $numPartidos; ?>" disabled />
    </div>  
    <div data-role="fieldcontain">
      <label for="slider">Apuestas sistemáticas a:</label>
    </div>
    <div data-role="fieldcontain">
      <label for="slider">Sis 1's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo round($sumratios1 / $numPartidos * 100); ?>" min="0" max="100" disabled />
    </div>
    <div data-role="fieldcontain">
      <label for="slider">Sis X's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo round($sumratiosX / $numPartidos * 100); ?>" min="0" max="100" disabled />
    </div>
    <div data-role="fieldcontain">
      <label for="slider">Sis 2's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo round($sumratios2 / $numPartidos * 100); ?>" min="0" max="100" disabled />
    </div>
    
  </div>


  <!-- Muestro la estructura para Media y sistemáticas 1X-X2-12 -->
  <div class="celda_datos">
  	<h5>Media y sistemáticas 1X-X2-12</h5>
    <div data-role="fieldcontain">
      <label for="slider">Número de partidos que finalizan en 1X-X2-12:</label>
    </div>
    <div data-role="fieldcontain">
      <label for="slider">1X's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo $resultados1Xs; ?>" min="0" max="<?php echo $numPartidos; ?>" disabled />
    </div>
    <div data-role="fieldcontain">
      <label for="slider">X2's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo $resultadosX2s; ?>"min="0" max="<?php echo $numPartidos; ?>" disabled />
    </div>
    <div data-role="fieldcontain">
      <label for="slider">12's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo $resultados12s; ?>" min="0" max="<?php echo $numPartidos; ?>" disabled />
    </div>  
    <div data-role="fieldcontain">
      <label for="slider">Apuestas sistemáticas a:</label>
    </div>
    <div data-role="fieldcontain">
      <label for="slider">Sis 1X's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo round($sumratios1X / $numPartidos * 100); ?>" min="0" max="100" disabled />
    </div>
    <div data-role="fieldcontain">
      <label for="slider">Sis X2's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo round($sumratiosX2 / $numPartidos * 100); ?>" min="0" max="100" disabled />
    </div>
    <div data-role="fieldcontain">
      <label for="slider">Sis 12's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo round($sumratios12 / $numPartidos * 100); ?>" min="0" max="100" disabled />
    </div>
    
  </div>  

<!--	<div data-role="footer">
		<h4><img src="../images/icons/futbol_icon.png" class="icon" alt="Futbol">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date("d", mktime())." / ".date("m", mktime())." / ".date("Y", mktime());?></h4>
	</div>-->
<?php

echo UI::footerNavBar();

echo UI::htmlEndPage();

?>