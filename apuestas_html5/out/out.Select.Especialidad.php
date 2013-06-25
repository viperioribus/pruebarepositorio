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
$param_pais = "";
if (isset($_GET["pais"]) && ($_GET["pais"] != "")) {
    $param_pais = $_GET["pais"];
}
$param_origen = "-1";
if (isset($_GET["origen"]) && ($_GET["origen"] != "")) {
    $param_origen = $_GET["origen"];
}
if ($param_origen == -1)
    $param_origen = "Home";

echo UI::htmlStartPage("Select Especialidad");?>
<div data-role="page" id="page">
<?php

echo UI::getHeader("Select Especialidad");

if ($param_pais != "")
    $especialidades = getAllEspecialidadesByPais($param_pais);
else
    $especialidades = getAllEspecialidades();

?>


<div class="content-primary">	
    <ul data-role="listview" data-split-icon="gear" data-split-theme="d" data-filter="true" data-clear-btn="true">
<?php
    if (($especialidades != false) && (count($especialidades) > 0)){
    		foreach ($especialidades as $es) {
            $paises = getAllPaises($es->getAt("pais_id"));
            $bandera = $paises[0]->getBandera();
?>
            <li>
                <a href=<?php echo "../out/out.Stats.".$param_origen.".php?pais=".$especialidades[0]->getAt("pais_id")."&especialidad=".$es->getAt("id"); ?>>
                <img src=<?php echo "../images/icons/".$es->getAt("icon");?> width=70 />
                <h3><?php echo $es->getAt("nombre"); ?></h3>
                <p><?php echo $bandera.$classUI->getImageTag($settings->_imagesDir.$settings->_iconImagesDir.getRutaImagen($es->getAt("id")), "icon", "", $es->getAt("nombre"), $es->getAt("nombre"), "width=40"); ?></p>
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