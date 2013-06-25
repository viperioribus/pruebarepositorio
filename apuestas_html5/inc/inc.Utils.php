<?php
//    MyDMS. Document Management System
//    Copyright (C) 2002-2005  Markus Westphal
//
//    This program is free software; you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation; either version 2 of the License, or
//    (at your option) any later version.
//
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//
//    You should have received a copy of the GNU General Public License
//    along with this program; if not, write to the Free Software
//    Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.


function getReadableDate($timestamp) {
	return date("d.m.Y", $timestamp);
}

function getLongReadableDate($timestamp) {
	return date("d.m.Y - H:i", $timestamp);
}


function redondear_dos_decimal($valor)
{
    $float_redondeado = round($valor * 100) / 100;
    return $float_redondeado;
}

// Devuelve el mktime asociado a una fecha dada en formato dd/mm/yyyy o d/m/yyyy
function tratarFecha($date) {
    $arr = explode("/",$date);
    if (($arr[0] < 10) && (strlen($arr[0]) == 2)) {
        $arrDay = explode("0",$arr[0]);
        $day = $arrDay[1];
    }
    else $day = $arr[0];
    if (($arr[1] < 10) && (strlen($arr[0]) == 2)){
        $arrMonth = explode("0",$arr[1]);
        $month = $arrMonth[1];
    }
    else $month = $arr[1];
    
    //print $arr[1]." - ".$arr[0]." - ".$arr[2];
    return mktime(0,0,0,$month,$day,$arr[2]);
}

// Devuelve una fecha en formato dd/mm/yyy pasada en formato mktime
// Importante : para ser consecuente con la conversión en sentido contrario, no se ponen los ceros iniciales
function tratarFechaADiasMesAnyo($date) {
    if (($date == 0) || ($date == ""))
        return "No definida";
    else
        return date("d",$date)."/".date("m",$date)."/".date("Y",$date);
}

// Devuelve una fecha en formato dd/mm/yyy pasada en formato mktime
// Importante : para ser consecuente con la conversión en sentido contrario, no se ponen los ceros iniciales
function tratarFechaADiasMesAnyoCerosIniciales($date) {
    if (($date == 0) || ($date == ""))
        return "No definida";
    else
        return date("d",$date)."/".date("m",$date)."/".date("y",$date);
}

//
// The original string sanitizer, kept for reference.
//function sanitizeString($string) {
//	$string = str_replace("'",  "&#0039;", $string);
//	$string = str_replace("--", "", $string);
//	$string = str_replace("<",  "&lt;", $string);
//	$string = str_replace(">",  "&gt;", $string);
//	$string = str_replace("/*", "", $string);
//	$string = str_replace("*/", "", $string);
//	$string = str_replace("\"", "&quot;", $string);
//	
//	return $string;
//}

function sanitizeString($string) {

	//$string = (string) $string;
	//if (get_magic_quotes_gpc()) {
	//	$string = stripslashes($string);
	//}

	$string = str_replace("\\", "\\\\", $string);
	$string = str_replace("--", "\-\-", $string);
	$string = str_replace(";", "\;", $string);
	// Use HTML entities to represent the other characters that have special
	// meaning in SQL. These can be easily converted back to ASCII / UTF-8
	// with a decode function if need be.
	$string = str_replace("&", "&amp;", $string);
	$string = str_replace("%", "&#0037;", $string); // percent
	$string = str_replace("\"", "&quot;", $string); // double quote
	$string = str_replace("/*", "&#0047;&#0042;", $string); // start of comment
	$string = str_replace("*/", "&#0042;&#0047;", $string); // end of comment
	$string = str_replace("<", "&lt;", $string);
	$string = str_replace(">", "&gt;", $string);
	$string = str_replace("=", "&#0061;", $string);
	$string = str_replace(")", "&#0041;", $string);
	$string = str_replace("(", "&#0040;", $string);
	$string = str_replace("'", "&#0039;", $string);
	$string = str_replace("+", "&#0043;", $string);
	
  $string = str_replace("á", "&aacute;", $string);
  $string = str_replace("é", "&eacute;", $string);
  $string = str_replace("í", "&iacute;", $string);  
  $string = str_replace("ó", "&oacute;", $string);
  $string = str_replace("ú", "&uacute;", $string);
  $string = str_replace("Á", "&Aacute;", $string);
  $string = str_replace("É", "&Eacute;", $string);
  $string = str_replace("Í", "&Iacute;", $string);
  $string = str_replace("Ó", "&Oacute;", $string);
  $string = str_replace("Ú", "&Uacute;", $string);
  $string = str_replace("ñ", "&ntilde;", $string);
  $string = str_replace("Ñ", "&Ntilde;", $string);
  $string = str_replace("ö", "o", $string);
  $string = str_replace("ü", "u", $string);
	return $string;
}


function sanitizePhotoName($string) {
  $string = ($string);
  $string = strtolower($string);
  $string = str_replace("&nbsp;","_",$string);
  $string = str_replace(" ","_",$string);
  $string = sanitizeString($string);
  $string = sanitizeAcutes($string);
  return $string;
}


function acutesPlanos($string) {
	$string = (string) $string;
  $string = str_replace("á", "a", $string);
  $string = str_replace("é", "e", $string);
  $string = str_replace("í", "i", $string);  
  $string = str_replace("ó", "o", $string);
  $string = str_replace("ú", "u", $string);
  $string = str_replace("Á", "A", $string);
  $string = str_replace("É", "E", $string);
  $string = str_replace("Í", "I", $string);
  $string = str_replace("Ó", "O", $string);
  $string = str_replace("Ú", "U", $string);
  return $string;
}

function mydmsDecodeString($string) {

	$string = (string)$string;

	$string = str_replace("&amp;", "&", $string);
	$string = str_replace("&#0037;", "%", $string); // percent
	$string = str_replace("&quot;", "\"", $string); // double quote
	$string = str_replace("&#0047;&#0042;", "/*", $string); // start of comment
	$string = str_replace("&#0042;&#0047;", "*/", $string); // end of comment
	$string = str_replace("&lt;", "<", $string);
	$string = str_replace("&gt;", ">", $string);
	$string = str_replace("&#0061;", "=", $string);
	$string = str_replace("&#0041;", ")", $string);
	$string = str_replace("&#0040;", "(", $string);
	$string = str_replace("&#0039;", "'", $string);
	$string = str_replace("&#0043;", "+", $string);

  $string = str_replace("&aacute;", "á", $string);
  $string = str_replace("&eacute;", "é", $string);
  $string = str_replace("&iacute;", "í", $string);  
  $string = str_replace("&oacute;", "ó", $string);
  $string = str_replace("&uacute;", "ú", $string);
  $string = str_replace("&Aacute;", "Á", $string);
  $string = str_replace("&Eacute;", "É", $string);
  $string = str_replace("&Iacute;", "Í", $string);
  $string = str_replace("&Oacute;", "Ó", $string);
  $string = str_replace("&Uacute;", "Ú", $string);
  $string = str_replace("&ntilde;", "ñ", $string);
  $string = str_replace("&Ntilde;", "Ñ", $string);

	return $string;
}

/*

// función getIP() original -------------------------------------
function getIP() {
  $return = "";
  if($_SERVER["HTTP_X_FORWARDED_FOR"])
  {
  	if($pos=strpos($_SERVER["HTTP_X_FORWARDED_FOR"]," "))
  	{
  		$return.= "IP local: ".substr($_SERVER["HTTP_X_FORWARDED_FOR"],0,$pos)." - IP Pública: ".substr($_SERVER["HTTP_X_FORWARDED_FOR"],$pos+1);
  		$hostlocal=substr($_SERVER["HTTP_X_FORWARDED_FOR"],$pos+1);
  	}else{
  		$return.= "IP Pública: ".$_SERVER["HTTP_X_FORWARDED_FOR"];
  		$hostlocal=$_SERVER["HTTP_X_FORWARDED_FOR"];
  	}
  	if($_SERVER["REMOTE_ADDR"])
  		$return.= " - Proxy: ".$_SERVER["REMOTE_ADDR"];
  }else{
  	$return.= "IP Pública: ".$_SERVER["REMOTE_ADDR"];
  	$hostlocal=$_SERVER["REMOTE_ADDR"];
  	if($hostlocal!=$_SERVER["REMOTE_ADDR"])
  		$return.= " - Hostname: ".$hostlocal;
  }
  $hostname=gethostbyaddr($hostlocal);
  if($hostlocal!=$hostname)
  	$return.= "<br>Hostname: ".$hostname;
  return $return;
} ---------------------------------------------------------------
*/

function getIP() {
  if($_SERVER["HTTP_X_FORWARDED_FOR"])
  {
  	if($pos=strpos($_SERVER["HTTP_X_FORWARDED_FOR"]," "))
  	{
  		$return = substr($_SERVER["HTTP_X_FORWARDED_FOR"],0,$pos)." - IP Pública: ".substr($_SERVER["HTTP_X_FORWARDED_FOR"],$pos+1);
  	}else{
  		$return = $_SERVER["HTTP_X_FORWARDED_FOR"];
  	}
  	if($_SERVER["REMOTE_ADDR"])
  		$return = $_SERVER["REMOTE_ADDR"];
  }else{
  	$return = $_SERVER["REMOTE_ADDR"];
  }
  return $return;
}

function ultimo_dia_mes($fecha) {
    $mes = date("n",$fecha);
    if ($mes == 2)
        return 28;
    elseif (($mes == 11) || ($mes == 4) || ($mes == 6) || ($mes == 9))
        return 30;
    else
        return 31;
}

function contarMeses($mktime) {
    $mes_inicial = date("n",$mktime);
    $anyo_inicial = date("Y",$mktime);
    $mes_actual = date("n",time());
    $anyo_actual = date("Y",time());
    if ($anyo_inicial == $anyo_actual)
        $meses = $mes_actual - $mes_inicial;
    else {
        $distancia_anyos = $anyo_actual - $anyo_inicial;
        if ($distancia_anyos == 1)
            $meses = 12 - $mes_inicial + $mes_actual;
        else {
            $meses = 12 - $mes_inicial + $mes_actual;
            $meses = $meses + (12 * ($distancia_anyos - 1));
        }
    }
    return $meses;
}

// Devuelve el código fuente de una página web
function get_source($url, $show_headers=0) {
    if (preg_match('!^http://!',$url))
        $url = substr($url,7,strlen($url));
    
    if ($start = strpos($url,'/')) {
        $uri = substr($url,$start,strlen($url));
    }
    else {
        $uri='';
    }
    
    $fp = fsockopen($url,80,$errno,$errstr,4);
    if (!$fp) {
        echo "<p class=\"error\">Imposible conectar a: $url</p>";
        return false;
    }
    else {
        $headers = $buffer = '';
        fputs($fp,"GET /$uri HTTP/1.0\r\n");
        fputs($fp,"Host: $url\r\n");
        fputs($fp,"User-Agent: sourcegetter\r\n");
        fputs($fp,"Connection: close\r\n");
        fputs($fp,"\r\n");
        while (!feof($fp)) {
            if (!isset($end_of_headers)) {
                $header = fgets($fp,4096);
                if ($header == "\r\n")
                    $end_of_headers = 1;
                $headers.= $header;
            }
            else {
                $buffer.=fgets($fp,4096);
            }
        }
        fclose($fp);
        if($show_headers) {
            $headers = htmlentities($headers);
            $headers = nl2br($headers);
            echo $headers;
        }
        $buffer = htmlentities($buffer);
        $buffer = nl2br($buffer);
        echo $buffer;
        return true;
    }
}

function getGastosMedios($spend, $url_value) {
    global $db, $user;
    $query = "select gastos.nombre,categorias.nombre,gastos.fecha,gastos.importe,gastos.desgravado from gastos inner join categorias on gastos.idCategoria = categorias.id where (iduser = ".$user->getID().")";
//    if (($url_value == 'oil') || ($url_value == 'mobile'))
//        $query.= " and categorias.id = (select id from categorias where valor_url= '".$url_value."')";
//    else 
        $query.= " and (categorias.id = ".$spend.")";
    $query.= " order by fecha;";
    if (!$db->getResult($query)){
        print "<br />".getMLText("error_occured");
        exit;
    }
    $resArr = $db->getResultArray($query);
    $i = 0;
    $total = 0;
    $total_desgravado = 0;
    while ($res = $resArr[$i]){
        $array[0] = $res[0];
        $array[1] = $res[1];
        $array[2] = $res[2];
        $array[3] = $res[3];
        $array[4] = $res[4];
        //UI::viewRow($array,'spendings',0);
        $i++;
        if ($res[4] == NULL)
            $total_desgravado = $total_desgravado + $res[3];
        $total = $total + $res[3];
    }
    return $total;
    //echo "<br><div>Media por mes : <b>".($total / $meses_total)." €</b></div>";
}

// Función comprobar_mail
// En el primer if compruebo que el email tiene por lo menos 6 caracteres (el mínimo), que tiene una arroba y sólo una y que no está 
//      colocada ni al principio ni al final.
// En el segundo if comprueba que no tiene algunos caracteres no permitidos. Y los restantes hacen comprobaciones de las distintas 
//      partes de la dirección de correo, a saber: Que hay un punto en algún lado y que la terminación del dominio es correcta y que 
//      el principio de la dirección también es correcto.
// Finalmente, se devuelve la variable local utilizada para guardar la validez o incorrección del correo.

function comprobar_email($email){ 
    $mail_correcto = 0; 
    //compruebo unas cosas primeras 
    if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){ 
        if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) { 
            //miro si tiene caracter . 
            if (substr_count($email,".")>= 1){ 
                //obtengo la terminacion del dominio 
                $term_dom = substr(strrchr ($email, '.'),1); 
                //compruebo que la terminación del dominio sea correcta 
                if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){ 
                    //compruebo que lo de antes del dominio sea correcto 
                    $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 
                    $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 
                    if ($caracter_ult != "@" && $caracter_ult != "."){ 
                        $mail_correcto = 1; 
                    } 
                } 
            } 
        } 
    } 
    if ($mail_correcto) 
        return 1; 
    else 
        return 0; 
}


?>
