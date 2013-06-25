<?php

include_once("../inc/inc.Settings.php");
include_once("../inc/inc.DBAccess.php");
include_once("../inc/inc.ClassUI.php");
include_once("../inc/inc.Utils.php");
include_once("../inc/inc.CallStoredProcedures.php");
include_once("../inc/inc.GetAllObjects.php");

global $settings, $db;

echo UI::htmlStartPage("Average");
echo UI::htmlDataRolePage("a", "a");
echo UI::getHeader("Stats page average");

// Saco datos para Media y sistemáticas 1-X-2 y 1X-X2-12

$especialidade_id = 3;
$anyo = 2013;

$arr = array();
$arr[0] = $especialidade_id;
$arr[1] = $anyo;
$numPartidos = callProcedureSingle("numpartidos", $arr);
$arr = null;
$arr[0] = '1';
$arr[1] = $especialidade_id;
$arr[2] = $anyo;

// Número de resultados de oportunidad única 0.33
$resultados1s = callProcedureSingle("resultadosporcumplimiento", $arr);
$arr[0] = 'X';
$resultadosXs = callProcedureSingle("resultadosporcumplimiento", $arr);
$arr[0] = '2';
$resultados2s = callProcedureSingle("resultadosporcumplimiento", $arr);
$arr = null;

// Número de resultados de doble oportunidad 0.66
$resultados1Xs = $resultados1s + $resultadosXs;
$resultadosX2s = $resultadosXs + $resultados2s;
$resultados12s = $resultados1s + $resultados2s;

// Suma de ratios de oportunidad simple 0.33
$arrmedia = array();
$arrmedia[0] = $especialidade_id;
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
$arrmedia[0] = $especialidade_id;
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

?>

<!-- Muestro la estructura para Media y sistemáticas 1-X-2 -->
  <div class="celda_datos">
  	<h5>Media y sistemáticas 1-X-2</h5>
    <div data-role="fieldcontain">
      <label for="slider">1's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo $resultados1s; ?>" min="0" max="<?php echo $numPartidos; ?>" disabled />
    </div>
    <div data-role="fieldcontain">
      <label for="slider">Sis 1's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo round($sumratios1 / $numPartidos * 100); ?>" min="0" max="100" />
    </div>
    <div data-role="fieldcontain">
      <label for="slider">X's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo $resultadosXs; ?>"min="0" max="<?php echo $numPartidos; ?>" disabled />
    </div>
    <div data-role="fieldcontain">
      <label for="slider">Sis X's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo round($sumratiosX / $numPartidos * 100); ?>" min="0" max="100" />
    </div>
    <div data-role="fieldcontain">
      <label for="slider">2's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo $resultados2s; ?>" min="0" max="<?php echo $numPartidos; ?>" disabled />
    </div>  
    <div data-role="fieldcontain">
      <label for="slider">Sis 2's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo round($sumratios2 / $numPartidos * 100); ?>" min="0" max="100" />
    </div>
    
  </div>


  <!-- Muestro la estructura para Media y sistemáticas 1X-X2-12 -->
  <div class="celda_datos">
  	<h5>Media y sistemáticas 1X-X2-12</h5>
    <div data-role="fieldcontain">
      <label for="slider">1X's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo $resultados1Xs; ?>" min="0" max="<?php echo $numPartidos; ?>" disabled />
    </div>
    <div data-role="fieldcontain">
      <label for="slider">Sis 1X's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo round($sumratios1X / $numPartidos * 100); ?>" min="0" max="100" />
    </div>
    <div data-role="fieldcontain">
      <label for="slider">X2's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo $resultadosX2s; ?>"min="0" max="<?php echo $numPartidos; ?>" disabled />
    </div>
    <div data-role="fieldcontain">
      <label for="slider">Sis X2's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo round($sumratiosX2 / $numPartidos * 100); ?>" min="0" max="100" />
    </div>
    <div data-role="fieldcontain">
      <label for="slider">12's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo $resultados12s; ?>" min="0" max="<?php echo $numPartidos; ?>" disabled />
    </div>  
    <div data-role="fieldcontain">
      <label for="slider">Sis 12's:</label>
      <input type="range" name="slider" id="slider" value="<?php echo round($sumratios12 / $numPartidos * 100); ?>" min="0" max="100" />
    </div>
    
  </div>  

<!--	<div data-role="footer">
		<h4><img src="../images/icons/futbol_icon.png" class="icon" alt="Futbol">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date("d", mktime())." / ".date("m", mktime())." / ".date("Y", mktime());?></h4>
	</div>-->

<?php

echo UI::footerNavBar();

echo UI::htmlEndPage();

?>