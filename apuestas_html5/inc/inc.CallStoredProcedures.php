<?php

include_once("../inc/inc.Settings.php");

global $settings;
/*
$mysqli = new mysqli($settings->_dbHostname, $settings->_dbUser, $settings->_dbPass, $settings->_dbDatabase);  
$query = "CALL resultadosporcumplimiento('1', 3, 2013)";
if (!($res = $mysqli->query($query)))
    echo "<br /><br />FALLO !!";
ELSE
    echo "<br /><br />Todo bien por ahora";
//$resArr = $db->getResultArray($query);

$row = $res->fetch_assoc();

echo "<br /><br />row : ".$row["cuenta"]."<br />";
print_r($row);
$mysqli->store_result();
$res->free();

$mysqli->close();   
$mysqli = new mysqli("localhost", "root", "babilusas", "apuestas");  
*/

// Funci�n que llama a un procedimiento almacenado que devuelve un �nico valor.
// Est� preparada para que el array resultado sea convertido en xml
// Par�metros:
// - Nombre del procedimiento
// - Array de par�metros
// Restricciones:
// - El nombre del �nico campo devuelto por la consulta debe ser "res"
function callProcedureSingle($nombreProcedure, $arrParams) {
    global $settings;
    
    $mysqli = new mysqli($settings->_dbHostname, $settings->_dbUser, $settings->_dbPass, $settings->_dbDatabase);
    $i = 0;
    $params = "";
    if (count($arrParams) > 0) {
        foreach ($arrParams as $param) {
            if ($i > 0)
                $params.= ", ";
            $params.= "'".$param."'";
            $i++;
        }
    }  
    $query = "CALL ".$nombreProcedure."(".$params.")";

    //print_r($mysqli->query($query));
    
    if (!($res = $mysqli->query($query)))
        return false;
    $row = $res->fetch_assoc();
    $mysqli->close();   
    return $row["res"];
}

// Funci�n que llama a un procedimiento almacenado que devuelve un array de valores
// Est� preparada para que el array resultado sea convertido en xml
// Par�metros:
// - Nombre del procedimiento
// - Array de par�metros
function callProcedureArray($nombreProcedure, $arrParams) {
    global $settings;

    $result = array();
    $mysqli = new mysqli($settings->_dbHostname, $settings->_dbUser, $settings->_dbPass, $settings->_dbDatabase);
    $i = 0;
    $params = "";
    if (count($arrParams) > 0) {
        foreach ($arrParams as $param) {
            if ($i > 0)
                $params.= ", ";
            $params.= "'".$param."'";
            $i++;
        }
    }  
    $query = "CALL ".$nombreProcedure."(".$params.")";
    if (!$mysqli->multi_query($query)) {
        echo "CALL failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    $i = 0;
    do {
        if ($res = $mysqli->store_result()) {
            //printf("---\n");
            //var_dump($res->fetch_all());
            while ($arr = $res->fetch_array(MYSQLI_ASSOC)) {
                $result[$i]["post"] = $arr;
                $i++;
            }
            $res->free();
        } else {
            if ($mysqli->errno) {
                echo "Store failed: (" . $mysqli->errno . ") " . $mysqli->error;
            }
        }
    } while ($mysqli->more_results() && $mysqli->next_result());
    $mysqli->close();
    return $result;
}  

?>