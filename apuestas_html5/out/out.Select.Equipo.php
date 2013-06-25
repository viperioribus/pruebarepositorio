<?php

// out.SelectEspecialidad.php

include_once("../inc/inc.Settings.php");
include_once("../inc/inc.DBAccess.php");
include_once("../inc/inc.ClassUI.php");
include_once("../inc/inc.Utils.php");
include_once("../inc/inc.CallStoredProcedures.php");
include_once("../inc/inc.Classes.php");
include_once("../inc/inc.ClassInicial.php");
include_once("../inc/inc.GetAllObjects.php");

global $settings, $db, $classUI;

define("_DEFAULT_SELECT_OPTION_", "Pick one");

// Parámetros GET
$param_origen = "-1";
if (isset($_GET["origen"]) && ($_GET["origen"] != "")) {
    $param_origen = $_GET["origen"];
}
if ($param_origen == -1)
    $param_origen = "Home";
$param_especialidad = "-1";
if (isset($_GET["especialidad"]) && ($_GET["especialidad"] != "")) {
    $param_especialidad = $_GET["especialidad"];
}

echo UI::htmlStartPage("Select Equipo");?>
<div data-role="page" id="page">
<?php

echo UI::getHeader("Select Equipo");

$especialidade_id = $param_especialidad;
$anyo = 2013;

$equipos = getAllEquipos("", $especialidade_id, $anyo);

$especialidades = getAllEspecialidades($param_especialidad);
$paises = getAllPaises($especialidades[0]->getAt("pais_id"));
$bandera = $paises[0]->getBandera();

?>


<div class="content-primary">	
    <ul data-role="listview" data-split-icon="gear" data-split-theme="d" data-filter="true">
<?php
    if (($equipos != false) && (count($equipos) > 0)){
    		foreach ($equipos as $eq) {
?>
        <li>
            <a href=<?php echo "../out/out.Stats.".$param_origen.".php?pais=".$especialidades[0]->getAt("pais_id")."&especialidad=".$especialidades[0]->getAt("id")."&equipo=".$eq->getAt("id"); ?>>
            <img src=<?php echo "../images/icons/teams/".str_replace(" ", "", strtolower($eq->getAt("nombre"))).".png";?> width=70 />
            <h3><?php echo $eq->getAt("nombre"); ?></h3>
            <p><?php echo $bandera.$classUI->getImageTag($settings->_imagesDir.$settings->_iconImagesDir.getRutaImagen($especialidades[0]->getAt("id")), "icon", "", $especialidades[0]->getAt("nombre"), $especialidades[0]->getAt("nombre"), "width=40"); ?></p>
            </a><a href="#purchase" data-rel="popup" data-position-to="window" data-transition="pop">Purchase album</a>
        </li>
<?php
        }
    }
?>
    </ul>
</div>
<?php

//echo UI::footerNavBar();

echo UI::htmlEndPage();

?>
