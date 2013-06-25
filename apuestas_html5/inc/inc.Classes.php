<?php

include_once('../inc/inc.ClassInicial.php');
include_once('../inc/inc.Settings.php');
include_once('../inc/inc.DBAccess.php');
include_once('../inc/inc.ClassUI.php');
//include_once('../inc/inc.AddObjects.php');
include_once('../inc/inc.GetAllObjects.php');

global $db;

class Inventario extends Inicial{
	
  	function Inventario($id){
    		$this->_table = "maquinaria_inventario";
    		$this->_idfield = "inv_idmaquinariainventario";
    		$this->_id = $id;
  	}


}

class Deporte extends Inicial {

    function Deporte($id) {
        $this->_table = "deportes";
        $this->_idfield = "id";
        $this->_id = $id;
    }

}

class Equipo extends Inicial {

    function Equipo($id) {
        $this->_table = "equipos";
        $this->_idfield = "id";
        $this->_id = $id;
    }

}

class EspecialidadAnyo extends Inicial {

    function EspecialidadAnyo($id) {
        $this->_table = "especialidadanyos";
        $this->_idfield = "id";
        $this->_id = $id;
    }

}

class Especialidade extends Inicial {

    function Especialidade($id) {
        $this->_table = "especialidades";
        $this->_idfield = "id";
        $this->_id = $id;
    }

    /**
     * function getURL
     * - Función que devuelve la url completa (simple p de doble oportunidad) para na especialidad concreta
     * @param: 
     *    - $singleOrDouble: por defecto tiene el valor "sinle" para devolver la url principal, peo poniendo "double" devuele la url de doble oportunidad     
     */             
    function getURL($singleOrDouble="single") {
        $url_subfix = "/results/";
        if ($singleOrDouble == "double") {
            $url_subfix = "/matchdetails.php?matchid=";
        }
        return $this->getAt("url").$this->getTemporada().$url_subfix;
    }
    
    function getTemporada() {
        if ($this->getAt("temporada") == "s")
            return date("Y");
        else {
            if (date("n") >= 8)
                return date("Y")."-".(date("Y") + 1); 
            else
                return (date("Y") - 1)."-".date("Y");
        }
    }

}

class Evento extends Inicial {

    function Evento($id) {
        $this->_table = "eventos";
        $this->_idfield = "id";
        $this->_id = $id;
    }

}

class Pais extends Inicial {

    function Pais($id) {
        $this->_table = "paises";
        $this->_idfield = "id";
        $this->_id = $id;
    }
    
    function getBandera() {
        global $settings, $classUI;
        return $classUI->getImageTag($settings->_imagesDir.$settings->_iconImagesDir.$settings->_flagImagesDir.$this->_id."_icon.gif", "icon", "", $this->_id, $this->_id, "width=40");    
    }

}

class Resultado extends Inicial {

    function Resultado($id) {
        $this->_table = "resultados";
        $this->_idfield = "id";
        $this->_id = $id;
    }

}

class Repostaje extends Inicial {

    function Repostaje($id) {
        $this->_table = "repostajes";
        $this->_idfield = "id";
        $this->_id = $id;
    }

}

// -----------------------------------------------------------------------------


class Propuesta extends Inicial{
	
	function Propuesta($id){
		
		$this->_table = _TABLE_PROPS_;
		$this->_idfield = _IDFIELD_PROPS_;
		$this->_id=$id;
		
	}
	
	function getUsuario(){
		
		include_once('../inc/inc.DBAccess.php');
		include_once('../inc/inc.ClassUser.php');
		
		$usuario = getUser($this->getAt('usu_id'));
		
		return $usuario;
		
		
	}
	
	function getEstadoPropuesta(){
		
		$epid=$this->getAt('esp_id');
		
		$estadoPropuesta = new EstadoPropuesta($epid);
		
		return $estadoPropuesta;
		
		
	}
	
}

class Servicio extends Inicial{

	function Servicio($id){
		
		$this->_table = _TABLE_SERVICES_;
		$this->_idfield = _IDFIELD_SERVICES_;
		$this->_id=$id;
		
	}
	
	function getContenidos(){
		
		global $db;
	
		$queryStr = "SELECT id_contenido FROM "._TABLE_PREFIX_._TABLE_CONTENTSERVICE_." WHERE id_servicio = ".$this->_id.";";
		$resArr = $db->getResultArray($queryStr);
		
		if (is_bool($resArr) && $resArr == false)
			return false;
		
		$contenidoServicio = array();
		
		for ($i = 0; $i < count($resArr); $i++)
			$contenidoServicio[$i] = new Contenido($resArr[$i]['id_contenido']);
		
		return $contenidoServicio;
		
		
		
	}

}

/*class Apartado extends Inicial{

	function Apartado($id){
		
		$this->_table = _TABLE_CHAPTERS_;
		$this->_idfield = _IDFIELD_CHAPTERS_;
		$this->_id=$id;
		
	}
	

}*/

/*class ContenidoServicio extends Inicial{

	function ContenidoServicio($id){
		
		$this->_table = _TABLE_CONTENTSERVICE_;
		$this->_idfield = _IDFIELD_CONTENTSERVICE_;
		$this->_id = $id;
		
	}
	
	function getContenidoServicioUsuario() {

		global $db;
	
		$queryStr = "SELECT  FROM "._TABLE_PREFIX_._TABLE_CONTENTSERVICE_." WHERE id_servicio = ".$this->_id.";";
		$resArr = $db->getResultArray($queryStr);
		
		if (is_bool($resArr) && $resArr == false)
			return false;
		
		$contenidoServicio = array();
		
		for ($i = 0; $i < count($resArr); $i++)
			$contenidoServicio[$i] = new Contenido($resArr[$i]['id_contenido']);
		
		return $contenidoServicio;
		
    
  }
	

} */


/*class ApartadoEnlace extends Inicial{

	function Apartado($id){
		
		$this->_table = _TABLE_CHAPTERS_LINKS_;
		$this->_idfield = _IDFIELD_CHAPTERS_LINKS_;
		$this->_id=$id;
		
	}
	

}*/

class Categoria extends Inicial{

	function Categoria($id){
		
		$this->_table = _TABLE_CATEGORIES_;
		$this->_idfield = _IDFIELD_CATEGORIES_;
		$this->_id=$id;
		
	}
	

}

class Ciudad extends Inicial{

	function Ciudad($id){
		
		$this->_table = _TABLE_CITIES_;
		$this->_idfield = _IDFIELD_CITIES_;
		$this->_id=$id;
		
	}
	
	function getPais(){
		
		$pais=new Pais($this->getAt('pai_id'));
		
		return $pais;		
	}
	

}

class Contenido extends Inicial{

	function Contenido($id){
		
		$this->_table = _TABLE_CONTENT_;
		$this->_idfield = _IDFIELD_CONTENT_;
		$this->_id=$id;
		
	}
	function getServicios(){
		
		global $db;
	
		$queryStr = "SELECT id_servicio FROM "._TABLE_PREFIX_._TABLE_CONTENTSERVICE_." WHERE id_contenido = ".$this->_id.";";
		$resArr = $db->getResultArray($queryStr);
		
		if (is_bool($resArr) && $resArr == false)
			return false;
		
		$servicioContenido = array();
		
		for ($i = 0; $i < count($resArr); $i++)
			$servicioContenido[$i] = new Servicio($resArr[$i]['id_servicio']);
		
		return $servicioContenido;
		
		
		
	}
	
	function getEstadisticas(){
		
		global $db;
	
		$queryStr = "SELECT cont_id FROM "._TABLE_PREFIX_._TABLE_STATISTICS_." WHERE id_contenido = ".$this->_id.";";
		$resArr = $db->getResultArray($queryStr);
		
		if (is_bool($resArr) && $resArr == false)
			return false;
		
		$estadistica = array();
		
		for ($i = 0; $i < count($resArr); $i++)
			$estadistica[$i] = new Estadistica($resArr[$i]['est_id']);
		
		return $estadistica;
		
		
		
	}

}

class Estadistica extends Inicial{

	function Estadistica($id){
		
		$this->_table = _TABLE_STATISTICS_;
		$this->_idfield = _IDFIELD_STATISTICS_;
		$this->_id=$id;
		
	}
	
	function getContenido(){
		
		$contenido=new Contenido($this->getAt('cont_id'));
		
		return $contenido;		
		
	}

}

class EstadoInvitado extends Inicial{

	function EstadoInvitado($id){
		
		$this->_table = _TABLE_STATEINVIT_;
		$this->_idfield = _IDFIELD_STATEINVIT_;
		$this->_id=$id;
		
	}
	

}

class EstadoPropuesta extends Inicial{

	function EstadoPropuesta($id){
		
		$this->_table = _TABLE_STATEPROP_;
		$this->_idfield = _IDFIELD_STATEPROP_;
		$this->_id=$id;
		
	}
	

}

class Idioma extends Inicial{

	function Idioma($id){
		
		$this->_table = _TABLE_IDIOM_;
		$this->_idfield = _IDFIELD_IDIOM_;
		$this->_id=$id;
		
	}
	

}

class Invitacion extends Inicial{

	function Invitacion($id){
		
		$this->_table = _TABLE_INVITATIONS_;
		$this->_idfield = _IDFIELD_INVITATIONS_;
		$this->_id=$id;
		
	}
	
	function getTipoInvitacion(){
		
		$tipoInvitacion=new TipoInvitacion($this->getAt('tin_id'));
		
		return $tipoInvitacion;
		
	}
	
	function getEstadoInvitado(){
		
		$estadoInvitacion=new EstadoInvitado($this->getAt('esi_id'));
		
		return $estadoInvitacion;
		
	}

}

class Maquetado extends Inicial{

	function Maquetado($id){
		
		$this->_table = _TABLE_MAQUETADO_;
		$this->_idfield = _IDFIELD_MAQUETADO_;
		$this->_id=$id;
		
	}
	

}

class Medio extends Inicial{

	function Medio($id){
		
		$this->_table = _TABLE_MIDDLES_;
		$this->_idfield = _IDFIELD_MIDDLES_;
		$this->_id=$id;
		
	}
	
	function getUsuarios(){
		
		global $db;
	
		$queryStr = "SELECT id_usuario FROM "._TABLE_PREFIX_._TABLE_USERMIDDLE_." WHERE id_medio = ".$this->_id.";";
		$resArr = $db->getResultArray($queryStr);
		
		if (is_bool($resArr) && $resArr == false)
			return false;
		
		$usuarios = array();
		
		for ($i = 0; $i < count($resArr); $i++)
			$usuarios[$i] = new Usuario($resArr[$i]['id_usuario']);
		
		return $usuarios;
		
		
	}

}

class Navegacion extends Inicial{

	function Navegacion($id){
		
		$this->_table = _TABLE_NAVIGATION_;
		$this->_idfield = _IDFIELD_NAVIGATION_;
		$this->_id=$id;
		
	}
	

}

class Noticia extends Inicial{

	function Noticia($id){
		
		$this->_table = _TABLE_NEWS_;
		$this->_idfield = _IDFIELD_NEWS_;
		$this->_id=$id;
		
	}
	

}

class Paises extends Inicial{

	function Paises($id){
		
		$this->_table = _TABLE_COUNTRIES_;
		$this->_idfield = _IDFIELD_COUNTRIES_;
		$this->_id=$id;
		
	}
	

}


class Sesion extends Inicial{

	function Sesion($id){
		
		$this->_table = _TABLE_SESSIONS_;
		$this->_idfield = _IDFIELD_SESSIONS_;
		$this->_id=$id;
		
	}
	

}

class Subcategoria extends Inicial{

	function Subcategoria($id){
		
		$this->_table = _TABLE_SUBCATEGORIES_;
		$this->_idfield = _IDFIELD_SUBCATEGORIES_;
		$this->_id=$id;
		
	}
	

}

class TipoInvitacion extends Inicial{

	function TipoInvitacion($id){
		
		$this->_table = _TABLE_TYPEINVITATION_;
		$this->_idfield = _IDFIELD_TYPEINVITATION_;
		$this->_id=$id;
		
	}
	

}

class UsuarioMedio extends Inicial{

	function TipoInvitacion($id){
		
		$this->_table = _TABLE_USERMIDDLE_;
		$this->_idfield = _IDFIELD_USERMIDDLE_;
		$this->_id=$id;
		
	}
	

}

class Voto extends Inicial{

	function Voto($id){
		
		$this->_table = _TABLE_VOTES_;
		$this->_idfield = _IDFIELD_VOTES_;
		$this->_id=$id;
		
	}
	

}

class Web extends Inicial{

	function Web($id){
		
		$this->_table = _TABLE_WEBS_;
		$this->_idfield = _IDFIELD_WEBS_;
		$this->_id=$id;
		
	}
	

}

//$propuesta = new Propuesta(1);

//$usuario = $propuesta->getEstadoPropuesta();

//print_r($usuario);


?>