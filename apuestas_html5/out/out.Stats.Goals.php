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

define("_DEFAULT_SELECT_OPTION_", "Pick one");

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

echo UI::htmlStartPage("Goals");
echo UI::htmlDataRolePage($settings->_default_data_theme, $settings->_default_data_content_theme);
echo UI::getHeader("Stats page goals");

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

// valor máximo del slider por defecto
$max_slider = 100;


$arr = array();
$arr[0] = $param_especialidad;
$arr[1] = $anyo;
$numPartidos = callProcedureSingle("numpartidos", $arr);
$arr = null;

$arrParams = array();
$arrParams[0] = $param_especialidad;
$arrParams[1] = $anyo;
$arrParams[2] = 0;
$arrParams[3] = '=';



/*$puntuacion_0_goles = getAllPuntuacionPartidos($param_especialidad, $anyo, 0, "=");
//$puntuacion_0_goles = callProcedureSingle("puntuacionpartidosnumpartidos", $arrParams);

//print_r($puntuacion_0_goles);die;

$puntuacion_1_goles = getAllPuntuacionPartidos($param_especialidad, $anyo, 1, "=");
$puntuacion_2omas_goles = getAllPuntuacionPartidos($param_especialidad, $anyo, 2, ">=");

$puntuacion_pm_0_goles = getAllPuntuacionDescanso($param_especialidad, $anyo, "pri", 0, "=");
$puntuacion_pm_1_goles = getAllPuntuacionDescanso($param_especialidad, $anyo, "pri", 1, "=");
$puntuacion_pm_2omas_goles = getAllPuntuacionDescanso($param_especialidad, $anyo, "pri", 2, ">=");

$puntuacion_sm_0_goles = getAllPuntuacionDescanso($param_especialidad, $anyo, "seg", 0, "=");
$puntuacion_sm_1_goles = getAllPuntuacionDescanso($param_especialidad, $anyo, "seg", 1, "=");
$puntuacion_sm_2omas_goles = getAllPuntuacionDescanso($param_especialidad, $anyo, "seg", 2, ">=");
*/


$puntuacion_0_goles = callProcedureSingle("puntuacionpartidosnumpartidos", $arrParams);
if ($param_equipo != -1) {
    $arrParams[4] = $param_equipo;
    $puntuacion_0_goles = callProcedureSingle("puntuacionpartidosnumpartidosequipo", $arrParams);
}
$arrParams[2] = 1;
$puntuacion_1_goles = callProcedureSingle("puntuacionpartidosnumpartidos", $arrParams);
if ($param_equipo != -1) {
    $arrParams[4] = $param_equipo;
    $puntuacion_1_goles = callProcedureSingle("puntuacionpartidosnumpartidosequipo", $arrParams);
}
$arrParams[2] = 2;
$puntuacion_2_goles = callProcedureSingle("puntuacionpartidosnumpartidos", $arrParams);
if ($param_equipo != -1) {
    $arrParams[4] = $param_equipo;
    $puntuacion_2_goles = callProcedureSingle("puntuacionpartidosnumpartidosequipo", $arrParams);
}
$arrParams[2] = 3;
$puntuacion_3_goles = callProcedureSingle("puntuacionpartidosnumpartidos", $arrParams);
if ($param_equipo != -1) {
    $arrParams[4] = $param_equipo;
    $puntuacion_3_goles = callProcedureSingle("puntuacionpartidosnumpartidosequipo", $arrParams);
}
$arrParams[2] = 4;
$arrParams[3] = '>=';
$puntuacion_4_goles = callProcedureSingle("puntuacionpartidosnumpartidos", $arrParams);
if ($param_equipo != -1) {
    $arrParams[4] = $param_equipo;
    $puntuacion_4_goles = callProcedureSingle("puntuacionpartidosnumpartidosequipo", $arrParams);
}

$arrParams = null;

$equipos = getAllEquipos("", $param_especialidad, $anyo);

?>


<div class="content-primary">	
    <ul data-role="listview" data-split-icon="gear">
<?php
    if (($equipos != false) && (count($equipos) > 0)){
    		foreach ($equipos as $eq) {
?>
      <!--  <li><a href="../out/out.Stats.Home.php?id=2">
            <img src="../images/icons/premierleague_icon.png" />
            <h3><?php echo $eq->getAt("nombre"); ?></h3>
            <p><?php echo $eq->getAt("ciudad"); ?></p>
            </a><a href="#purchase" data-rel="popup" data-position-to="window" data-transition="pop">Purchase album</a>
        </li>   -->
<?php
        }
    }
?>
    </ul>
</div>


<div data-role="fieldcontain">
  <!--<label for="selectmenu" class="select">Equipos:</label>
  <select name="selectmenu" id="selectmenu">-->
  <?php
	/*if (($equipos != false) && (count($equipos) > 0)){
		echo "<option value=\"-1\">"._DEFAULT_SELECT_OPTION_."</option>";
		foreach ($equipos as $eq) {
			echo "<option value=\"".$eq->getAt("id")."\">".$eq->getAt("nombre")."</option>";
		}
	}*/
  ?>
  <!--</select>-->
</div>


<div data-role="controlgroup" data-type="horizontal">
  <a href="../out/out.Stats.Goals.php?origen=Goals&pais=ESP" data-role="button"><img src="../images/icons/flags/ESP_icon.gif" width=23></a>
  <a href="../out/out.Stats.Goals.php?origen=Goals&pais=GBP" data-role="button"><img src="../images/icons/flags/GBP_icon.gif" width=23></a>
  <a href="../out/out.Stats.Goals.php?origen=Goals&pais=DEU" data-role="button"><img src="../images/icons/flags/DEU_icon.gif" width=23></a>
  <a href="../out/out.Stats.Goals.php?origen=Goals&pais=ITA" data-role="button"><img src="../images/icons/flags/ITA_icon.gif" width=23></a>
  <a href="../out/out.Stats.Goals.php?origen=Goals&pais=NOR" data-role="button"><img src="../images/icons/flags/NOR_icon.gif" width=23></a>
  <a href="../out/out.Stats.Goals.php?origen=Goals&pais=SWE" data-role="button"><img src="../images/icons/flags/SWE_icon.gif" width=23></a>
  <a href="../out/out.Stats.Goals.php?origen=Goals&pais=FIN" data-role="button"><img src="../images/icons/flags/FIN_icon.gif" width=23></a>
</div>
<div data-role="fieldcontain">
	<a href="<?php echo "../out/out.Select.Especialidad.php?origen=Goals&pais=".$param_pais;?>">Seleccione especialidad</a>
  <a href="<?php echo "../out/out.Select.Equipo.php?origen=Goals&especialidad=".$param_especialidad;?>">Seleccione equipo</a>
</div>

<fieldset class="ui-grid-a">
	<div class="ui-block-a">
    <div data-role="fieldcontain">
      <li><?php echo $bandera.$classUI->getImageTag($settings->_imagesDir.$settings->_iconImagesDir.getRutaImagen($especialidad->getAt("id")), "icon", "", $especialidad->getAt("nombre"), $especialidad->getAt("nombre"), "width=40"); ?></li>

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
	<h5>N&uacute;mero partidos con estos goles</h5>
    <!-- Puntuacion 0 goles -->
    <div data-role="fieldcontain">
      <label for="slider">0 goles:</label>
      <input type="range" name="slider" id="slider" value="<?php echo $puntuacion_0_goles; ?>" min="0" max=<?php echo $max_slider?> disabled />
    </div>
    <!-- Puntuacion 1 goles -->
    <div data-role="fieldcontain">
      <label for="slider">1 gol:</label>
      <input type="range" name="slider" id="slider" value="<?php echo $puntuacion_1_goles; ?>" min="0" max=<?php echo $max_slider?> disabled />
    </div>
    <!-- Puntuacion 2 goles -->
    <div data-role="fieldcontain">
      <label for="slider">2 goles:</label>
      <input type="range" name="slider" id="slider" value="<?php echo $puntuacion_2_goles; ?>" min="0" max=<?php echo $max_slider?> disabled />
    </div>
    <!-- Puntuacion 3 goles -->
    <div data-role="fieldcontain">
      <label for="slider">3 goles:</label>
      <input type="range" name="slider" id="slider" value="<?php echo $puntuacion_3_goles; ?>" min="0" max=<?php echo $max_slider?> disabled />
    </div>
    <!-- Puntuacion 4 o más goles -->
    <div data-role="fieldcontain">
      <label for="slider">4 o más goles:</label>
      <input type="range" name="slider" id="slider" value="<?php echo $puntuacion_4_goles; ?>" min="0" max=<?php echo $max_slider?> disabled />
    </div>
</div> <!-- div class celda_datos -->
<?php

echo UI::footerNavBar();
?>
</div> <!-- div data-role="page" id="page" -->


<div data-role="page" id="page2">
	<div data-role="header">
		<h1>Seleccione equipo</h1>
	</div>
  <div data-role="content">	
	<ul data-role="listview">
			<li><a href="#page?id=1">Equipo 1</a></li>
            <li><a href="#page?id=2">Equipo 2</a></li>
			<li><a href="./out.Stats.Goals.php?id=3#page">Equipo 3</a></li>
	</ul>
    <div data-role="fieldcontain">
    </div>
	<div data-role="fieldcontain">
		Contenido div<br />
		Segunda fila
	</div>
  </div>
  <div data-role="footer">
		<h4>Pie de página</h4>
	</div>
</div>


<?php
echo UI::htmlEndPage();

?>
