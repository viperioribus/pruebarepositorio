<?php

// Prefijo de las tablas
define("_TABLE_PREFIX_","");


// Tablas de la base de datos
define("_TABLE_ACCESS_","accesos");
define("_TABLE_CHAPTERS_","apartados");
define("_TABLE_CHAPTERS_LINKS_","apartados_enlaces");
define("_TABLE_SESSIONS_","sesiones");
define("_TABLE_USERS_","usuarios");
define("_TABLE_USERS_TMP_","usuarios_tmp");

// Apartados
define("_CHAPTER_MAIN_","1");
define("_CHAPTER_LOGIN_","3");
define("_CHAPTER_NEWUSER_","5");
define("_CHAPTER_BETS_", "6");
define("_CHAPTER_OIL_", "8");
define("_CHAPTER_BETS_MANAGEMENT_", "6");
define("_CHAPTER_BETSSTATS_", "11");
define("_CHAPTER_BETSSTATS_NBA_", "12");

//define("M_READ","2");

class Settings {

    var $_completeURL = "C:/wamp/www/apuestas_html5/";    
    var $_completeURLWindows = "C:\\wamp\\www\\apuestas_html5\\";
    var $_trazascron = "inc\\cron\\trazas.cron\\";
    var $_guestID = 2;
    var $_siteDefaultPage = "out/out.Main.php";
    var $_siteName = "Viper Stats";
    // estilo por defecto
    var $_style = "black";
    // idioma por defecto
    var $_language = "Spanish";
    var $_httpRoot = "/instalacion_limpia/";
    var $_rootDir = "../";
    var $_contentDir = "../content/";
    var $_imagesDir = "../images/";
    var $_userImagesDir = "users/";
    var $_iconImagesDir = "icons/";
    var $_flagImagesDir = "flags/";
    var $_enableGuestLogin = false;
    //var $_complete_url = "/home/acciona/domains/construccion2030.org/public_html/ciclos/"; 
  	var $_expireTime = 12000;
  	var $_separatorArray = "##";
  	var $_cookie_name = "mydms_session";

    // ------------------------------- Opciones de maquetaci�n -------------------------------
    var $_menu_superior = true;
    var $_barra_inferior = true;
    var $_gradiente = true;

    // Clase PHPMailerDir
    var $_phpMailerDir = "../../PHPMailer/";
    var $_smtpServer = "correo.acciona.es";
    var $_smtpUserName = "ismael.rodriguez.cabado@acciona.com";
    var $_smtpPassword = "alfalfa8";
    var $_mailServerType = "smtp";
    
    // ------------------------------- Configuracion apuestas_html5 --------------------------
    var $_default_data_theme = "a";
    var $_default_data_content_theme = "a";

    // ------------------------------------- Base de Datos -----------------------------------
    
    // Configuraci�n general
  	var $_ADOdbPath = "../adodb/";
  	var $_dbDriver = "mysql";
  	var $_dbHostname = "localhost";
  	var $_dbDatabase = "apuestas";
  	var $_dbUser = "root";
  	var $_dbPass = "babilusas";
  	
}

$settings = new Settings();

?>
