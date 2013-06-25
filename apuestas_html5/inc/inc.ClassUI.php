<?php

// inc.ClassUI.php

class UI {

    function htmlStartPage($title="", $bodyClass="") {

        global $settings;
        $return = "<!DOCTYPE html>"; 
        $return.= "<html>";
        $return.= "<head>";
        $return.= "<meta charset=\"utf-8\">";
        $return.= "<title>".$settings->_siteName." : ".$title."</title>";
        $return.= "<link href=\"http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css\" rel=\"stylesheet\" type=\"text/css\"/>";
        $return.= "<link href=\"../style/black/style.css\" rel=\"stylesheet\" type=\"text/css\"/>";
        $return.= "<script src=\"http://code.jquery.com/jquery-1.6.4.min.js\" type=\"text/javascript\"></script>";
        $return.= "<script src=\"http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js\" type=\"text/javascript\"></script>";
        $return.= "</head>"; 
        $return.= "<body>"; 
        
        return $return;    
    }
    
    function htmlDataRolePage($theme="", $theme_content="") {
        $return = "<div data-role=\"page\" id=\"page\"  data-theme=\"".$theme."\" data-content-theme=\"".$theme_content."\">";
        return $return;
    }
    
    function htmlEndPage() {
    
        $return.= "</body>";
        $return.= "</html>";
        
        return $return;
    }
    
    function getHeader($title="") {

        $return.= "<div data-role=\"header\">";
		    $return.= "<h1>".$title."</h1>";
        $return.= "</div>";
        
        return $return;    
    }
    
    function footerNavBar() {
        $return.= "<div id=\"id_nav_bar\" data-role=\"navbar\" data-iconpos=\"top\" class=\"class_nav_bar\">
            <ul>
                <li>
                    <a href=\"../out/out.Stats.Home.php\" data-transition=\"fade\" data-theme=\"c\" data-icon=\"arrow-u\"
                    class=\"ui-state-persist\">
                        Stats
                    </a>
                </li>
                <li>
                    <a href=\"../out/out.Stats.Average.php\" data-transition=\"fade\" data-theme=\"\" data-icon=\"arrow-u\"
                    class=\"ui-state-persist\">
                        Average
                    </a>
                </li>
                <li>
                    <a href=\"../out/out.Stats.Goals.php\" data-transition=\"fade\" data-theme=\"\" data-icon=\"arrow-u\"
                    class=\"ui-state-persist\">
                        Goals
                    </a>
                </li>
            </ul>
        </div>";
        
        return $return;    
    }




    function getImageTag($src, $class, $id, $alt, $title, $adicionales) {
      $return = "<img src=\"".$src."\" ";
      if ($class != "")
          $return.= "class=\"".$class."\" ";
      if ($id != "")
          $return.= "id=\"".$id."\" ";
      if ($alt != "")
          $return.= "<alt=\"".$alt."\" ";
      if ($title != "")
          $return.= "title=\"".$title."\" ";
      $return.= $adicionales." />\n";
      return $return;
    }


} // class UI

// Instancio el objeto
$classUI = new UI();

?>
