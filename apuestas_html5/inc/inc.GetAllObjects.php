<?php

/*
include_once("../inc/inc.Settings.php");
include_once("../inc/inc.DBAccess.php");
include_once("../inc/inc.ClassUser.php");
*/

    function getAllEquipos($id = "", $especialidade = 0, $anyo = 0){
    
        global $db;
        $queryStr = "SELECT equipos.id FROM "._TABLE_PREFIX_."equipos";
        if (($especialidade != 0) && ($anyo != 0))
            $queryStr.= " INNER JOIN especialidadanyos ON equipos.id = especialidadanyos.equipo_id WHERE (especialidadanyos.especialidade_id = ".$especialidade.") AND (especialidadanyos.anyo = ".$anyo.") ";
        if ($id != '') {
            if (($especialidade == 0) && ($anyo == 0))
                $queryStr.= " WHERE ";
            else
                $queryStr.= " AND ";
            $queryStr.= " (id = '".$id."')";
        }
        $queryStr.= " ORDER BY nombre;";
        if (!$db->getResult($queryStr))
            echo "Error.";
        
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++)
          	$arr[$i] = new Equipo($resArr[$i]['id']);
        
        return $arr;
    }

    function getAllEquiposByNombre($nombre){
    
        global $db;
        $queryStr = "SELECT equipos.id FROM apuestas."._TABLE_PREFIX_."equipos WHERE nombre LIKE '%".$nombre."%' ORDER BY nombre;";
        if (!$db->getResult($queryStr))
            echo "Error.";
        
        $resArr = $db->getResultArray($queryStr);
  
        if (is_bool($resArr) && $resArr == false)
          	return false;

        //print "<br />".$queryStr;print "<br />".count($resArr);
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++)
          	$arr[$i] = new Equipo($resArr[$i]['id']);

        return $arr;
    }

    function getAllEquiposByNombreEspecialidadAnyo($nombre, $especialidade_id, $anyo){
    
        global $db;
                
        $queryStr = "SELECT equipos.id FROM apuestas.equipos INNER JOIN apuestas.especialidadanyos ON equipos.id = especialidadanyos.equipo_id AND especialidadanyos.especialidade_id = ".$especialidade_id." AND especialidadanyos.anyo = ".$anyo." WHERE nombre LIKE '%".$nombre."%' ORDER BY nombre;";
        if (!$db->getResult($queryStr))
            echo "Error.";

        $resArr = $db->getResultArray($queryStr);

        if (is_bool($resArr) && $resArr == false)
          	return false;

        //print "<br />".$queryStr;print "<br />".count($resArr);
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++)
          	$arr[$i] = new Equipo($resArr[$i]['id']);

        return $arr;
    }
    
    function getAllEquiposEventos($idevento) {
        global $db;
        $queryStr = "SELECT equipos_id, ubicacion FROM "._TABLE_PREFIX_."equipos_eventos WHERE (eventos_id = ".$idevento.");";
        if (!$db->getResult($queryStr))
            echo "Error.";
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++) {
            if ($resArr[$i]['ubicacion'] == "local")
                $arr[0] = new Equipo($resArr[$i]['equipos_id']);
            else
                $arr[1] = new Equipo($resArr[$i]['equipos_id']);
        }
        return $arr;
    }

    function getAllEspecialidadAnyos($id = 0, $especialidade_id = 0, $anyo = 0) {
        global $db;
        $queryStr = "SELECT id FROM "._TABLE_PREFIX_."especialidadanyos";
        if ($id != 0)
            $queryStr.= " WHERE (id = ".$id.")";
        if (($especialidade_id != 0) && ($anyo != 0))
            $queryStr.= " WHERE (especialidade_id = ".$especialidade_id.") AND (anyo = ".$anyo.");";
        if (!$db->getResult($queryStr))
            echo "Error.";
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++)
          	$arr[$i] = new EspecialidadAnyo($resArr[$i]['id']);
        return $arr;
    }

    function getAllEspecialidadesByPais($pais_id) {
        global $db;
        $queryStr = "SELECT id FROM "._TABLE_PREFIX_."especialidades WHERE (pais_id = '".$pais_id."');";
        if (!$db->getResult($queryStr))
            echo "Error.";
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++)
          	$arr[$i] = new Especialidade($resArr[$i]['id']);
        return $arr;
    }

    function getAllDeportes($id = 0) {
        global $db;
        $queryStr = "SELECT id FROM "._TABLE_PREFIX_."deportes";
        if ($id != 0)
            $queryStr.= " WHERE (id = ".$id.");";
        if (!$db->getResult($queryStr))
            echo "Error.";
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++)
          	$arr[$i] = new Deporte($resArr[$i]['id']);
        return $arr;
    }

    function getAllEspecialidades($id = 0) {
        global $db;
        $queryStr = "SELECT id FROM "._TABLE_PREFIX_."especialidades";
        if ($id != 0)
            $queryStr.= " WHERE (id = ".$id.")";
        $queryStr.= " ORDER BY deporte_id, pais_id;";
        if (!$db->getResult($queryStr))
            echo "Error.";
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++)
          	$arr[$i] = new Especialidade($resArr[$i]['id']);
        return $arr;
    }

    function getAllEspecialidadesByEquipo($equipo) {
        global $db;

    		$queryStr = "SELECT especialidades.id as id, equipos.id as idequipo, especialidadanyos.anyo 
						FROM "._TABLE_PREFIX_."especialidades 
						INNER JOIN "._TABLE_PREFIX_."especialidadanyos 
						ON especialidades.id = especialidadanyos.especialidade_id
						INNER JOIN "._TABLE_PREFIX_."equipos
						ON especialidadanyos.equipo_id = equipos.id
						WHERE equipos.nombre LIKE '%".$equipo."%' 
						ORDER BY especialidadanyos.anyo DESC; ";



        if (!$db->getResult($queryStr))
            echo "Error.";
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++) {
          	$arr[$i]["esp"] = new Especialidade($resArr[$i]['id']);
      			$arr[$i]["eq"] = new Equipo($resArr[$i]['idequipo']);
      			$arr[$i]["anyo"] = $resArr[$i]['anyo'];
    		}
        return $arr;
    }

    function getAllEventos($id = "", $especialidade = 0, $anyo = 0, $order = "DESC"){
    
        global $db;
        $queryStr = "SELECT eventos.id FROM "._TABLE_PREFIX_."eventos";
        if (($especialidade != 0) && ($anyo != 0))
            $queryStr.= " , equipos_eventos INNER JOIN especialidadanyos ON equipos_eventos.equipos_id = especialidadanyos.equipo_id WHERE (especialidadanyos.especialidade_id = ".$especialidade.") AND (especialidadanyos.anyo = ".$anyo.") ";
        if ($id != '') {
            if ($especialidade == 0)
                $queryStr.= " WHERE ";
            else
                $queryStr.= " AND ";
            $queryStr.= " (id = '".$id."')";
        }
        $queryStr.= " ORDER BY fecha ".$order.";";
        if (!$db->getResult($queryStr))
            echo "Error.";
        
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++)
          	$arr[$i] = new Evento($resArr[$i]['id']);
        
        return $arr;
    }


    function getAllEventosFiltrados($id = "", $pais = -1, $especialidade = -1, $anyo = 0, $search_name_fecha_ini = "", $search_name_fecha_fin = "",
                                    $search_select_equipo_1 = -1, $search_select_equipo_2 = -1, $search_input_ratio_mayor_que = "",
                                    $search_input_ratio_menor_que = "", $search_input_cantidad_mayor_que = "", $search_input_cantidad_menor_que = "",
                                    $search_select_ganadas_perdidas = -1){
    
        global $db;
        $campos_where = 0;
        $queryStr = "SELECT eventos.id FROM "._TABLE_PREFIX_."eventos";
        if (($select_equipo_1 != -1) || ($select_equipo_2 != -1))
            $queryStr.= " INNER JOIN "._TABLE_PREFIX_."equipos_eventos ON "._TABLE_PREFIX_."eventos.id = "._TABLE_PREFIX_."equipos_eventos.eventos_id ";

        if (($pais != -1) && ($especialidade == -1)) {
            if (($select_equipo_1 == -1) && ($select_equipo_2 == -1))
                $queryStr.= _TABLE_PREFIX_."equipos_eventos ";
            $queryStr.= " INNER JOIN especialidades ON "._TABLE_PREFIX_."especialidades.id = "._TABLE_PREFIX_."eventos.especialidade_id INNER JOIN paises ON "._TABLE_PREFIX_."especialidades.pais_id = "._TABLE_PREFIX_."paises.id ";
        }

        if (($especialidade != -1) && ($anyo != 0)) {
            //if (($select_equipo_1 == -1) && ($select_equipo_2 == -1))
            //    $queryStr.= _TABLE_PREFIX_."equipos_eventos ";
            $queryStr.= " INNER JOIN especialidadanyos ON "._TABLE_PREFIX_."equipos_eventos.equipos_id = "._TABLE_PREFIX_."especialidadanyos.equipo_id ";
        }
        if ($id != '') {
            if ($especialidade == -1)
                $queryStr.= " WHERE ";
            else
                $queryStr.= " AND ";
            $queryStr.= " (id = '".$id."')";
            $campos_where++;
        }
/*
        if ($id != "") {
            if ($campos_where == 0)
                $queryStr.= " WHERE ";
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " ("._TABLE_PREFIX_."eventos.id = ".$id.")";
            $campos_where++;
        }*/
        if ($fechaini != "") {
            if ($campos_where == 0)
                $queryStr.= " WHERE ";
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " ("._TABLE_PREFIX_."especialidadanyos.especialidade_id = ".$especialidade.") AND ("._TABLE_PREFIX_."especialidadanyos.anyo = ".$anyo.")";
            $campos_where++;
        }
        if (($pais != -1) && ($especialidade == -1)) {
            if ($campos_where == 0)
                $queryStr.= " WHERE ";
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " ("._TABLE_PREFIX_."paises.id = '".$pais."')";
            $campos_where++;
        }
        if (($especialidade != -1) && ($anyo != 0)) {
            if ($campos_where == 0)
                $queryStr.= " WHERE ";
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " ("._TABLE_PREFIX_."especialidadanyos.especialidade_id = ".$especialidade.") AND ("._TABLE_PREFIX_."especialidadanyos.anyo = ".$anyo.")";
            $campos_where++;
        }
        if ($search_name_fecha_ini != 0) {
            $fecha_ini = @mktime(0, 0, 1, date("m", $search_name_fecha_ini), date("d", $search_name_fecha_ini), date("Y", $search_name_fecha_ini));
            if ($campos_where == 0)
                $queryStr.= " WHERE ";
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " ("._TABLE_PREFIX_."eventos.fecha > ".$fecha_ini.")";
            $campos_where++;
        }
        if ($search_name_fecha_fin != 0) {
            $fecha_fin = @mktime(23, 59, 59, date("m", $search_name_fecha_fin), date("d", $search_name_fecha_fin), date("Y", $search_name_fecha_fin));
            if ($campos_where == 0)
                $queryStr.= " WHERE ";
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " ("._TABLE_PREFIX_."eventos.fecha < ".$fecha_fin.")";
            $campos_where++;
        }        
        if ($search_select_equipo_1 != -1) {
            if ($campos_where == 0)
                $queryStr.= " WHERE ";
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " ("._TABLE_PREFIX_."equipos_eventos.equipos_id = ".$search_select_equipo_1.")";
            $campos_where++;
        }
        if ($search_select_equipo_2 != -1) {
            if ($campos_where == 0)
                $queryStr.= " WHERE ";
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " ("._TABLE_PREFIX_."equipos_eventos.equipos_id = ".$search_select_equipo_2.")";
            $campos_where++;
        }
        if ($search_input_ratio_mayor_que != "") {
            if ($campos_where == 0)
                $queryStr.= " WHERE ";
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " ("._TABLE_PREFIX_."eventos.ratio >= ".$search_input_ratio_mayor_que.")";
            $campos_where++;
        }
        if ($search_input_ratio_menor_que != "") {
            if ($campos_where == 0)
                $queryStr.= " WHERE ";
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " ("._TABLE_PREFIX_."eventos.ratio <= ".$search_input_ratio_menor_que.")";
            $campos_where++;
        }
        if ($search_input_cantidad_mayor_que != "") {
            if ($campos_where == 0)
                $queryStr.= " WHERE ";
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " ("._TABLE_PREFIX_."eventos.cantidad >= ".$search_input_cantidad_mayor_que.")";
            $campos_where++;
        }
        if ($search_input_cantidad_menor_que != "") {
            if ($campos_where == 0)
                $queryStr.= " WHERE ";
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " ("._TABLE_PREFIX_."eventos.cantidad <= ".$search_input_cantidad_menor_que.")";
            $campos_where++;
        }
        if ($search_select_ganadas_perdidas != -1) {
            if ($campos_where == 0)
                $queryStr.= " WHERE ";
            if ($campos_where > 0)
                $queryStr.= " AND ";
            if ($search_select_ganadas_perdidas == "ganadas")
                $queryStr.= " ("._TABLE_PREFIX_."eventos.pronostico = "._TABLE_PREFIX_."eventos.resultado)";
            else
                $queryStr.= " ("._TABLE_PREFIX_."eventos.pronostico <> "._TABLE_PREFIX_."eventos.resultado)";
            $campos_where++;
        }

        if ($campos_where == 0)
            $queryStr.= " WHERE ("._TABLE_PREFIX_."eventos.especialidade_id = 0) ";
        //if ($campos_where > 0)
        //    $queryStr.= " AND ";
        if ($especialidade != -1)
            $queryStr.= " AND ("._TABLE_PREFIX_."eventos.especialidade_id != 0) ";


        //print "<br /><br />".$queryStr."<br />";die;

        $queryStr.= " GROUP BY eventos.id ORDER BY fecha DESC;";
        if (!$db->getResult($queryStr))
            echo "Error.";
        
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++)
          	$arr[$i] = new Evento($resArr[$i]['id']);
        
        return $arr;
    }




    function getAllPaises($id = "", $con_apuestas = "") {
    
        global $db;
        $queryStr = "SELECT id FROM "._TABLE_PREFIX_."paises";
        if ($id != '')
            $queryStr.= " WHERE (id = '".$id."')";
        if ($con_apuestas != "") {
            $queryStr.= " WHERE (id IN (SELECT pais_id FROM especialidades INNER JOIN eventos ON especialidades.id = eventos.especialidade_id))";
        }
        $queryStr.= ";";
        
        //if ($con_apuestas != "")
        //    print $queryStr;die;
        
        if (!$db->getResult($queryStr))
            echo "Error.";
        
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++)
          	$arr[$i] = new Pais($resArr[$i]['id']);
        
        return $arr;
    }
    
    function getAllResultados($id = "", $especialidade = 0, $anyo = 0, $jornada_mayor_que = 0, $jornada_menor_que = 0, $search_name_fecha_ini = "", $search_name_fecha_fin = "") {
    
        global $db;
        $campos_where = 0;
        $queryStr = "SELECT resultados.id FROM "._TABLE_PREFIX_."resultados";
        
        if (($id != '') || ($especialidade != 0) || ($anyo != 0) || ($jornada_mayor_que != 0) || ($jornada_menor_que != 0)) {
            $queryStr.= " WHERE ";
        }
        if ($id != '') {
            $queryStr.= " (id = ".$id.") ";
            $campos_where++;
        }
        if ($especialidade > 0) {
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " (especialidade_id = ".$especialidade.") ";
            $campos_where++;
        }
        if ($anyo > 0) {
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " (anyo = ".$anyo.") ";
            $campos_where++;
        }
        if ($jornada_mayor_que > 0) {
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " (jornada >= ".$jornada_mayor_que.") ";
            $campos_where++;
        }
        if ($jornada_menor_que > 0) {
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " (jornada <= ".$jornada_menor_que.") ";
            $campos_where++;
        }
        if ($search_name_fecha_ini != 0) {
            $fecha_ini = @mktime(0, 0, 1, date("m", $search_name_fecha_ini), date("d", $search_name_fecha_ini), date("Y", $search_name_fecha_ini));
            if ($campos_where == 0)
                $queryStr.= " WHERE ";
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " ("._TABLE_PREFIX_."resultados.fecha > ".$fecha_ini.")";
            $campos_where++;
        }
        if ($search_name_fecha_fin != 0) {
            $fecha_fin = @mktime(0, 0, 1, date("m", $search_name_fecha_fin), date("d", $search_name_fecha_fin), date("Y", $search_name_fecha_fin));
            if ($campos_where == 0)
                $queryStr.= " WHERE ";
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " ("._TABLE_PREFIX_."resultados.fecha < ".$fecha_fin.")";
            $campos_where++;
        }
        $queryStr.= " ORDER BY fecha DESC;";        
        //print $queryStr;die;
        if (!$db->getResult($queryStr))
            echo "Error.";
        
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++)
          	$arr[$i] = new Resultado($resArr[$i]['id']);
        
        return $arr;
    
    }
    
    function getAllEventosByResultados($idresultado = 0) {

        global $db;
        $campos_where = 0;
        $queryStr = "SELECT eventos_resultados.eventos_id FROM "._TABLE_PREFIX_."eventos_resultados";

        if ($idresultado > 0) {
            if ($campos_where == 0)
                $queryStr.= " WHERE ";
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " (resultados_id = ".$idresultado.") ";
            $campos_where++;
        }
        
        //print $queryStr;die;
        if (!$db->getResult($queryStr))
            echo "Error.";
        
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++)
          	$arr[$i] = new Evento($resArr[$i]['eventos_id']);
        
        return $arr;        
    }

    function getAllAsociacionesByEvento($idevento = 0) {

        global $db;
        $campos_where = 0;
        $queryStr = "SELECT eventos_resultados.eventos_id FROM "._TABLE_PREFIX_."eventos_resultados";

        if ($idevento > 0) {
            if ($campos_where == 0)
                $queryStr.= " WHERE ";
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " (eventos_id = ".$idevento.") ";
            $campos_where++;
        }
        
        //print $queryStr;die;
        if (!$db->getResult($queryStr))
            echo "Error.";
        
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++)
          	$arr[$i] = new Evento($resArr[$i]['eventos_id']);
        
        return $arr;        
    }

    
    function getAllResultadosByEquipos($equipo_local = 0, $equipo_visitante = 0) {

        global $db;
        $campos_where = 0;
        $queryStr = "SELECT resultados.id FROM "._TABLE_PREFIX_."resultados";

        if ($equipo_local > 0) {
            if ($campos_where == 0)
                $queryStr.= " WHERE ";
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " (equipo_local = ".$equipo_local.") ";
            $campos_where++;
        }
        if ($equipo_visitante > 0) {
            if ($campos_where == 0)
                $queryStr.= " WHERE ";
            if ($campos_where > 0)
                $queryStr.= " AND ";
            $queryStr.= " (equipo_visitante = ".$equipo_visitante.") ";
            $campos_where++;
        }

        //print $queryStr;die;
        if (!$db->getResult($queryStr))
            echo "Error.";
        
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++)
          	$arr[$i] = new Resultado($resArr[$i]['id']);
        
        return $arr;        
    }
    
    function getIsEventoGanado($id) {
        
        global $db;
        $evento = getAllEventos($id);
        if (($evento != false) && (count($evento) > 0)) {
            foreach ($evento as $ev) {
                if ($ev->getAt("pronostico") == $ev->getAt("resultado"))
                    return true;
                else
                    return false;
            }
        }
        
    }
    
    function getIsResultadoAnyadidoYa($especialidade_id, $anyo, $equipo_local, $equipo_visitante, $resultado_local, $resultado_visitante, $fecha, $jornada=0) {

        global $db;
        $queryStr = "SELECT * 
                    FROM apuestas.resultados 
                    WHERE (
                        (especialidade_id = ".$especialidade_id.") AND
                        (anyo = ".$anyo.") AND
                        (equipo_local = ".$equipo_local.") AND
                        (equipo_visitante = ".$equipo_visitante.") AND
                        (resultado_local = ".$resultado_local.") AND
                        (resultado_visitante = ".$resultado_visitante.")";
        if ($jornada != 0)
            $queryStr.= " AND (jornada = ".$jornada.")";                
        
        $queryStr.= ");";
        //print "<br />".$queryStr;
        if (!$db->getResult($queryStr))
            echo "Error.";
        
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return -1;
        else return count($resArr);        
    }
    
    function getRutaImagen($idespecialidad) {
    
        global $db;
        $especialidades = getAllEspecialidades($idespecialidad);
        if ($especialidades[0]->getAt("icon") == null) {
            $deporte = getAllDeportes($especialidades[0]->getAt("deporte_id"));
            $ruta_imagen = $deporte[0]->getAt("icon");
        }
        else 
            $ruta_imagen = $especialidades[0]->getAt("icon");
        return $ruta_imagen;
    }
	
  	function getMinAnyo($idespecialidad) {
  	
    		global $db;
    		$queryStr = "SELECT min(anyo) FROM especialidadanyos WHERE (especialidade_id = ".$idespecialidad.");";
        if (!$db->getResult($queryStr))
            echo "Error.";
        
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        return $resArr[0][0];
    		
  	}
  
  	function getMaxAnyo($idespecialidad) {
  	
    		global $db;
    		$queryStr = "SELECT max(anyo) FROM especialidadanyos WHERE (especialidade_id = ".$idespecialidad.");";
        if (!$db->getResult($queryStr))
            echo "Error.";
        
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        return $resArr[0][0];
  		
  	}
    
    /**
    * Función que devuelve la suma de los ratios que de han cumplido para un determinado resultado, ya sea simple o doble.
    * STORE PROCEDURE
    * - sumratiosespecialidadanyoressimple (IN param_especialidad INT, IN param_anyo INT, IN param_resultado CHAR(1))
    * - sumratiosespecialidadanyoresdoble (IN param_especialidad INT, IN param_anyo INT, IN param_resultado_1 CHAR(1), IN param_resultado_2 CHAR(1))
    */
    function getAllSumRatiosEspecialidadAnyo($especialidade_id, $anyo, $resultado, $resultado_alternativo="") {
    
        global $db, $user;
        $query = "SELECT id, sum(ratio1) as sumratio1, sum(ratiox) as sumratiox, sum(ratio2) as sumratio2, 
                            sum(ratio1x) as sumratio1x, sum(ratiox2) as sumratiox2, sum(ratio12) as sumratio12, 
                            resultado, equipo_local, equipo_visitante 
                  FROM apuestas.resultados 
                  WHERE 
                      (especialidade_id = ".$especialidade_id.") AND 
                      (anyo = ".$anyo.") ";
        if ($resultado_alternativo == "")
            $query.= " AND (resultado = '".$resultado."')";
        else
            $query.= " AND ((resultado = '".$resultado."') OR (resultado = '".$resultado_alternativo."'))";
        $query.= ";";
        //print "<br />".$query;
        if (!$db->getResult($query)) {
            echo "Error !";
            exit;
        }
        $ratio = 0;
        $resArr = $db->getResultArray($query);
        return $resArr;
    
    }

    function getAllRatiosEquipo($especialidade_id, $anyo, $equipo_id, $ratio=0) {
    
        global $db, $user;
        $query = "SELECT id, ratio1, ratiox, ratio2, ratio1x, ratiox2, ratio12, resultado, equipo_local, equipo_visitante 
                  FROM apuestas.resultados 
                  WHERE 
                      (especialidade_id = ".$especialidade_id.") AND 
                      (anyo = ".$anyo.") AND 
                      ((equipo_local = ".$equipo_id.") OR (equipo_visitante = ".$equipo_id.")) ";
        if ($ratio > 0) {
            $query.= " AND ((ratio1 < ".$ratio.") AND (equipo_local = ".$equipo_id.")) OR ((ratio2 < ".$ratio.") AND (equipo_visitante = ".$equipo_id."))";
        }
        $query.= ";";
        //print "<br />".$query;
        if (!$db->getResult($query)) {
            echo "Error !";
            exit;
        }
        $ratio = 0;
        $resArr = $db->getResultArray($query);
        return $resArr;
    
    }
    
    /**
    * Función que devuelve el número de partidos jugados por un equipo en una especialidad en un anyo.
    * STORED PROCEDURE
    * - numpartidosequipo (IN param_especialidad INT, IN param_anyo INT, IN param_equipo INT)
    */
    function getAllNumPartidosEquipo($especialidade_id, $anyo, $equipo_id) {
    
        global $db, $user;
        $queryNumPartidos = "SELECT count(*) 
                      FROM apuestas.resultados
                      WHERE
                          (especialidade_id = ".$especialidade_id.") AND 
                          (anyo = ".$anyo.") AND 
                          ((equipo_local = ".$equipo_id.") OR (equipo_visitante = ".$equipo_id.")); 
                      ";
        if (!$db->getResult($queryNumPartidos)) {
            echo "<br /><br />No se puede lanzar la query: ".$queryNumPartidos."<br /><br />";
        }
        $resArrNumPartidos = $db->getResultArray($queryNumPartidos);
        return $resArrNumPartidos[0][0];
    }
    
    // Número de partidos jugados en una especialidad y anyo detemrinados
    /**
    * Función que devuelve el número de partidos jugados en una especialidad en un anyo concreto
    * STORED PROCEDURE
    * - numpartidos (IN param_especialidad INT, IN param_anyo INT)        
    */         
    function getAllNumPartidos($especialidade_id, $anyo) {
    
        global $db, $user;
        $queryNumPartidos = "SELECT count(*) 
                      FROM apuestas.resultados
                      WHERE
                          (especialidade_id = ".$especialidade_id.") AND 
                          (anyo = ".$anyo."); 
                      ";
        if (!$db->getResult($queryNumPartidos)) {
            echo "<br /><br />No se puede lanzar la query: ".$queryNumPartidos."<br /><br />";
        }
        $resArrNumPartidos = $db->getResultArray($queryNumPartidos);
        return $resArrNumPartidos[0][0];
    }

    // Devuelve todos los partidos jugados por un equipos en una especialidad y en un anyo como local
    function getAllPartidosEquipoLocal($especialidade_id, $anyo, $equipo_id, $ubicacion="local") {

        global $db, $user;
        $queryPartidosLocal = "SELECT *
                      FROM apuestas.resultados
                      WHERE
                          (especialidade_id = ".$especialidade_id.") AND 
                          (anyo = ".$anyo.") AND 
                          (equipo_".$ubicacion." = ".$equipo_id."); 
                      ";
        if (!$db->getResult($queryPartidosLocal)) {
            echo "<br /><br />No se puede lanzar la query: ".$queryPartidosLocal."<br /><br />";
        }
        $resArrPartidosLocal = $db->getResultArray($queryPartidosLocal);
        return $resArrPartidosLocal;
    
    }

    // Devuelve todos los partidos ganados por un equipo en una especialidad y un anyo dado
    function getAllPartidosGanadosEquipo($especialidade_id, $anyo, $equipo_id) {
    
        global $db, $user;
        $queryPartidosGanados = "SELECT * 
                      FROM apuestas.resultados
                      WHERE
                          (especialidade_id = ".$especialidade_id.") AND 
                          (anyo = ".$anyo.") AND 
                          (((equipo_local = ".$equipo_id.") AND (resultado = 1)) OR ((equipo_visitante = ".$equipo_id.") AND (resultado = 2))); 
                      ";
        if (!$db->getResult($queryPartidosGanados)) {
            echo "<br /><br />No se puede lanzar la query: ".$queryPartidosGanados."<br /><br />";
        }
        $resArrPartidosGanados = $db->getResultArray($queryPartidosGanados);
        return $resArrPartidosGanados;
    }

    // Devuelve todos los partidos empatados por un equipo en una especialidad y un anyo dado
    function getAllPartidosEmpatadosEquipo($especialidade_id, $anyo, $equipo_id) {
    
        global $db, $user;
        $queryPartidosEmpatados = "SELECT * 
                      FROM apuestas.resultados
                      WHERE
                          (especialidade_id = ".$especialidade_id.") AND 
                          (anyo = ".$anyo.") AND 
                          (resultado = 'x') AND ((equipo_local = ".$equipo_id.") OR (equipo_visitante = ".$equipo_id.")); 
                      ";
        if (!$db->getResult($queryPartidosEmpatados)) {
            echo "<br /><br />No se puede lanzar la query: ".$queryPartidosEmpatados."<br /><br />";
        }
        $resArrPartidosEmpatados = $db->getResultArray($queryPartidosEmpatados);
        return $resArrPartidosEmpatados;
    }

    // Devuelve la fecha del último partido de un equipo en una especialidad en un año
    /**
    * Función la fecha del último partido jugado por un equipo en una especialidad en un anyo.
    * STORED PROCEDURE
    * - fechaultimopartido (IN param_especialidad INT, IN param_anyo INT, IN param_equipo INT)
    */
    function getAllFechaUltimoPartido($especialidade_id, $anyo, $equipo_id) {
    
        global $db, $user;
        $queryUltimoPartido = "SELECT max(fecha) 
                      FROM apuestas.resultados
                      WHERE
                          (especialidade_id = ".$especialidade_id.") AND 
                          (anyo = ".$anyo.") AND 
                          ((equipo_local = ".$equipo_id.") OR (equipo_visitante = ".$equipo_id."));";
        //echo "<br />".$queryUltimoPartido;
        if (!$db->getResult($queryUltimoPartido)) {
            echo "<br /><br />No se puede lanzar la query: ".$queryUltimoPartido."<br /><br />";
        }
        $resArrUltimoPartido = $db->getResultArray($queryUltimoPartido);
        return $resArrUltimoPartido[0][0];
    }
    
    /**
     * Devuelve el total de puntuación de un equipo en una especialidad en un año
     * - total: $ubicacion=""
     * - partidos como local: $ubicacion="local"
     * - partidos como visitante: $ubicacion="visitante"
     * STORED PROCEDURE
     * - puntuacionequipo (IN param_especialidad INT, IN param_anyo INT, IN param_equipo INT)
     * - puntuacionequipolocal (IN param_especialidad INT, IN param_anyo INT, IN param_equipo INT)
     * - puntuacionequipovisitante (IN param_especialidad INT, IN param_anyo INT, IN param_equipo INT)                    
     */         
    function getAllPuntuacion($especialidade_id, $anyo, $equipo_id, $ubicacion="") {
    
        global $db, $user;
        $queryAllPuntuacion = "SELECT ( SELECT sum(resultado_local) as res_local 
                                        FROM `apuestas`.`resultados` 
                                        WHERE (especialidade_id = ".$especialidade_id.") AND (anyo = ".$anyo.") AND (equipo_local = ".$equipo_id.")
                                      ) 
                                        +
                                      ( SELECT sum(resultado_visitante) as res_visitante 
                                        FROM `apuestas`.`resultados` 
                                        WHERE (especialidade_id = ".$especialidade_id.") AND (anyo = ".$anyo.") AND (equipo_visitante = ".$equipo_id.")
                                      )";
        
        $queryAllPuntuacionLocal = "SELECT sum(resultado_local) as res_local 
                                        FROM `apuestas`.`resultados` 
                                        WHERE (especialidade_id = ".$especialidade_id.") AND (anyo = ".$anyo.") AND (equipo_local = ".$equipo_id.")";
        
        $queryAllPuntuacionVisitante = "SELECT sum(resultado_visitante) as res_visitante 
                                        FROM `apuestas`.`resultados` 
                                        WHERE (especialidade_id = ".$especialidade_id.") AND (anyo = ".$anyo.") AND (equipo_visitante = ".$equipo_id.")";

        switch ($ubicacion) {
            case "local": {
                $query = $queryAllPuntuacionLocal;
                break;
            }
            case "visitante": {
                $query = $queryAllPuntuacionVisitante;
                break;
            } 
            default: {
                $query = $queryAllPuntuacion;
                break;
            }
        }                              
        
        if (!$db->getResult($query)) {
            echo "<br /><br />No se puede lanzar la query: ".$query."<br /><br />";
        }
        $resArrAllPuntuacion = $db->getResultArray($query);
        return $resArrAllPuntuacion[0][0];
    }

    /**
     * Función que devuelve el número de partidos en función del número de goles según los parámetros goles y comparacion
     * STORED PROCEDURE
     * - puntuacionpartidos (IN param_especialidad INT, IN param_anyo INT, IN param_goles INT, IN param_comparacion CHAR(2)
     * --> devuelve suma de goles de todos los partidos que cumplan la condicion
     * - puntuacionpartidosnumpartidos
     * --> devuelve numero de partidos que cumplen la condicion                             
     */    
    function getAllPuntuacionPartidos($especialidade_id, $anyo, $goles, $comparacion="<") {
        
        global $db;
        $queryPuntuacionTotal = "SELECT id, sum(resultado_local + resultado_visitante) suma 
                                    FROM apuestas.resultados 
                                    WHERE 
                                        (especialidade_id = ".$especialidade_id.") AND 
                                        (anyo = ".$anyo.") 
                                    GROUP BY id
                                    HAVING (suma ".$comparacion." ".$goles.")";

        $resArr = $db->getResultArray($queryPuntuacionTotal);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++)
          	$arr[$i] = new Resultado($resArr[$i]['id']);
        
        return $arr;

        
        
    }

    // Devuelve el total de puntuación de un equipo en una especialidad en un año
    // - total: $ubicacion=""
    // - partidos como local: $ubicacion="local"
    // - partidos como visitante: $ubicacion="visitante"
    function getAllPuntuacionMitad($especialidade_id, $anyo, $equipo_id, $mitad, $ubicacion="") {
    
        global $db, $user;
        $queryAllPuntuacion = "SELECT ( SELECT sum(resultado_".$mitad."_mitad_local) as res_local 
                                        FROM `apuestas`.`resultados` 
                                        WHERE (especialidade_id = ".$especialidade_id.") AND (anyo = ".$anyo.") AND (equipo_local = ".$equipo_id.")
                                      ) 
                                        +
                                      ( SELECT sum(resultado_".$mitad."_mitad_visitante) as res_visitante 
                                        FROM `apuestas`.`resultados` 
                                        WHERE (especialidade_id = ".$especialidade_id.") AND (anyo = ".$anyo.") AND (equipo_visitante = ".$equipo_id.")
                                      )";
        
        $queryAllPuntuacionLocal = "SELECT sum(resultado_".$mitad."_mitad_local) as res_local 
                                        FROM `apuestas`.`resultados` 
                                        WHERE (especialidade_id = ".$especialidade_id.") AND (anyo = ".$anyo.") AND (equipo_local = ".$equipo_id.")";
        
        $queryAllPuntuacionVisitante = "SELECT sum(resultado_".$mitad."_mitad_visitante) as res_visitante 
                                        FROM `apuestas`.`resultados` 
                                        WHERE (especialidade_id = ".$especialidade_id.") AND (anyo = ".$anyo.") AND (equipo_visitante = ".$equipo_id.")";

        switch ($ubicacion) {
            case "local": {
                $query = $queryAllPuntuacionLocal;
                break;
            }
            case "visitante": {
                $query = $queryAllPuntuacionVisitante;
                break;
            } 
            default: {
                $query = $queryAllPuntuacion;
                break;
            }
        }                              
        
        if (!$db->getResult($query)) {
            echo "<br /><br />No se puede lanzar la query: ".$query."<br /><br />";
        }
        $resArrAllPuntuacion = $db->getResultArray($query);
        return $resArrAllPuntuacion[0][0];
    }


    /**
     * Devuelve el total de puntuación en contra de un equipo en una especialidad en un año
     * - total: $ubicacion=""
     * - partidos como local: $ubicacion="local"
     * - partidos como visitante: $ubicacion="visitante"
     * STORED PROCEDURE
     * - puntuacionequipocontra (IN param_especialidad INT, IN param_anyo INT, IN param_equipo INT)
     * - puntuacionequipocontralocal (IN param_especialidad INT, IN param_anyo INT, IN param_equipo INT)
     * - puntuacionequipocontravisitante (IN param_especialidad INT, IN param_anyo INT, IN param_equipo INT)                    
     */         
    function getAllPuntuacionContra($especialidade_id, $anyo, $equipo_id, $ubicacion="") {
    
        global $db, $user;
        $queryAllPuntuacionContra = "SELECT ( SELECT sum(resultado_visitante) as res_visitante 
                                        FROM `apuestas`.`resultados` 
                                        WHERE (especialidade_id = ".$especialidade_id.") AND (anyo = ".$anyo.") AND (equipo_local = ".$equipo_id.")
                                      ) 
                                        +
                                      ( SELECT sum(resultado_local) as res_local 
                                        FROM `apuestas`.`resultados` 
                                        WHERE (especialidade_id = ".$especialidade_id.") AND (anyo = ".$anyo.") AND (equipo_visitante = ".$equipo_id.")
                                      )";
        
        $queryAllPuntuacionContraLocal = "SELECT sum(resultado_visitante) as res_local 
                                        FROM `apuestas`.`resultados` 
                                        WHERE (especialidade_id = ".$especialidade_id.") AND (anyo = ".$anyo.") AND (equipo_local = ".$equipo_id.")";
        
        $queryAllPuntuacionContraVisitante = "SELECT sum(resultado_local) as res_visitante 
                                        FROM `apuestas`.`resultados` 
                                        WHERE (especialidade_id = ".$especialidade_id.") AND (anyo = ".$anyo.") AND (equipo_visitante = ".$equipo_id.")";

        switch ($ubicacion) {
            case "local": {
                $queryContra = $queryAllPuntuacionContraLocal;
                break;
            }
            case "visitante": {
                $queryContra = $queryAllPuntuacionContraVisitante;
                break;
            } 
            default: {
                $queryContra = $queryAllPuntuacionContra;
                break;
            }
        }                              
        
        if (!$db->getResult($queryContra)) {
            echo "<br /><br />No se puede lanzar la query: ".$queryContra."<br /><br />";
        }
        $resArrAllPuntuacionContra = $db->getResultArray($queryContra);
        return $resArrAllPuntuacionContra[0][0];
    }

    // Devuelve el total de puntuación en contra de un equipo en una especialidad en un año
    // - total: $ubicacion=""
    // - partidos como local: $ubicacion="local"
    // - partidos como visitante: $ubicacion="visitante"
    function getAllPuntuacionContraMitad($especialidade_id, $anyo, $equipo_id, $mitad, $ubicacion="") {
    
        global $db, $user;
        $queryAllPuntuacionContra = "SELECT ( SELECT sum(resultado_".$mitad."_mitad_visitante) as res_visitante 
                                        FROM `apuestas`.`resultados` 
                                        WHERE (especialidade_id = ".$especialidade_id.") AND (anyo = ".$anyo.") AND (equipo_local = ".$equipo_id.")
                                      ) 
                                        +
                                      ( SELECT sum(resultado_".$mitad."_mitad_local) as res_local 
                                        FROM `apuestas`.`resultados` 
                                        WHERE (especialidade_id = ".$especialidade_id.") AND (anyo = ".$anyo.") AND (equipo_visitante = ".$equipo_id.")
                                      )";
        
        $queryAllPuntuacionContraLocal = "SELECT sum(resultado_".$mitad."_mitad_visitante) as res_local 
                                        FROM `apuestas`.`resultados` 
                                        WHERE (especialidade_id = ".$especialidade_id.") AND (anyo = ".$anyo.") AND (equipo_local = ".$equipo_id.")";
        
        $queryAllPuntuacionContraVisitante = "SELECT sum(resultado_".$mitad."_mitad_local) as res_visitante 
                                        FROM `apuestas`.`resultados` 
                                        WHERE (especialidade_id = ".$especialidade_id.") AND (anyo = ".$anyo.") AND (equipo_visitante = ".$equipo_id.")";

        switch ($ubicacion) {
            case "local": {
                $queryContra = $queryAllPuntuacionContraLocal;
                break;
            }
            case "visitante": {
                $queryContra = $queryAllPuntuacionContraVisitante;
                break;
            } 
            default: {
                $queryContra = $queryAllPuntuacionContra;
                break;
            }
        }                              
        
        if (!$db->getResult($queryContra)) {
            echo "<br /><br />No se puede lanzar la query: ".$queryContra."<br /><br />";
        }
        $resArrAllPuntuacionContra = $db->getResultArray($queryContra);
        return $resArrAllPuntuacionContra[0][0];
    }

    // Función que devuelve los partidos con menos de un determinado número de goles en una mitad determinada
    function getAllPuntuacionDescanso($especialidade_id, $anyo, $mitad, $goles, $comparacion="<") {
        
        global $db;
        $queryPuntuacionDescanso = "SELECT id, sum(resultado_".$mitad."_mitad_local + resultado_".$mitad."_mitad_visitante) suma 
                                    FROM apuestas.resultados 
                                    WHERE 
                                        (especialidade_id = ".$especialidade_id.") AND 
                                        (anyo = ".$anyo.") 
                                    GROUP BY id
                                    HAVING (suma ".$comparacion." ".$goles.")";

        $resArr = $db->getResultArray($queryPuntuacionDescanso);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++)
          	$arr[$i] = new Resultado($resArr[$i]['id']);
        
        return $arr;


    }
    
    function getAllEventosEspecialidadAnyo($especialidade_id, $anyo, $fecha_ini = 0, $fecha_fin = 0) {
        
        global $db;
        $queryEventosEspecialidadAnyo = "SELECT count(*)
                                                FROM apuestas.eventos
                                                WHERE (
                                                    (especialidade_id = ".$especialidade_id.")";
        // filtro por fecha inicial
        if ($fecha_ini != 0)
            $queryEventosEspecialidadAnyo.= " AND (fecha > ".$fecha_ini.")";
        // filtro por fecha final
        if ($fecha_fin != 0)
            $queryEventosEspecialidadAnyo.= " AND (fecha < ".$fecha_fin.")";
        $queryEventosEspecialidadAnyo.= ");";
        
        //echo "<br />".$queryEventosGanadosEspecialidadAnyo;
        if (!$db->getResult($queryEventosEspecialidadAnyo)) {
            echo "<br /><br />No se puede lanzar la query: ".$queryEventosEspecialidadAnyo."<br /><br />";
        }
        $resArrEventosEspecialidadAnyo = $db->getResultArray($queryEventosEspecialidadAnyo);
        return redondear_dos_decimal($resArrEventosEspecialidadAnyo[0][0]);
        
    }

    function getAllEventosGanadosEspecialidadAnyo($especialidade_id, $anyo, $fecha_ini = 0, $fecha_fin = 0) {
        
        global $db;
        $queryEventosGanadosEspecialidadAnyo = "SELECT sum(cantidad*ratio) - sum(cantidad) as suma, count(*) as cuenta
                                                FROM apuestas.eventos
                                                WHERE (
                                                    (pronostico = resultado) AND
                                                    (especialidade_id = ".$especialidade_id.")";
        // filtro por fecha inicial
        if ($fecha_ini != 0)
            $queryEventosGanadosEspecialidadAnyo.= " AND (fecha > ".$fecha_ini.")";
        // filtro por fecha final
        if ($fecha_fin != 0)
            $queryEventosGanadosEspecialidadAnyo.= " AND (fecha < ".$fecha_fin.")";
        $queryEventosGanadosEspecialidadAnyo.= ");";
        
        //echo "<br />".$queryEventosGanadosEspecialidadAnyo;
        if (!$db->getResult($queryEventosGanadosEspecialidadAnyo)) {
            echo "<br /><br />No se puede lanzar la query: ".$queryEventosGanadosEspecialidadAnyo."<br /><br />";
        }
        $resArrEventosGanadosEspecialidadAnyo = $db->getResultArray($queryEventosGanadosEspecialidadAnyo);
        return $resArrEventosGanadosEspecialidadAnyo[0];
        
    }

    function getAllEventosPerdidosEspecialidadAnyo($especialidade_id, $anyo, $fecha_ini = 0, $fecha_fin = 0) {
        
        global $db;
        $queryEventosPerdidosEspecialidadAnyo = "SELECT sum(cantidad) as suma, count(*) as cuenta
                                                FROM apuestas.eventos
                                                WHERE (
                                                    (pronostico != resultado) AND
                                                    (especialidade_id = ".$especialidade_id.")";
        // filtro por fecha inicial
        if ($fecha_ini != 0)
            $queryEventosPerdidosEspecialidadAnyo.= " AND (fecha > ".$fecha_ini.")";
        // filtro por fecha final
        if ($fecha_fin != 0)
            $queryEventosPerdidosEspecialidadAnyo.= " AND (fecha < ".$fecha_fin.")";
        $queryEventosPerdidosEspecialidadAnyo.= ");";

        //echo "<br />".$queryEventosPerdidosEspecialidadAnyo;
        if (!$db->getResult($queryEventosPerdidosEspecialidadAnyo)) {
            echo "<br /><br />No se puede lanzar la query: ".$queryEventosPerdidosEspecialidadAnyo."<br /><br />";
        }
        $resArrEventosPerdidosEspecialidadAnyo = $db->getResultArray($queryEventosPerdidosEspecialidadAnyo);
        return $resArrEventosPerdidosEspecialidadAnyo[0];
        
    }
    
    // Función que devuelve todos los resultados de todas las especialidades para el tiempo completo
    function getAllResultadosEspecialidad($especialidades, $fecha_ini = 0, $fecha_fin = 0) {
    
        global $db;
        
        $arr_result = array();
        foreach ($especialidades as $esp) {     
            $eventos_ganados = getAllEventosGanadosEspecialidadAnyo($esp->getAt("id"), 2013, $fecha_ini, $fecha_fin);
            $eventos_perdidos = getAllEventosPerdidosEspecialidadAnyo($esp->getAt("id"), 2013, $fecha_ini, $fecha_fin);
            $arr_result[$esp->getAt("id")] = redondear_dos_decimal($eventos_ganados["suma"] - $eventos_perdidos["suma"]);
        }
        return $arr_result;
    }
    
    // Función que devuelve un array con una fila si el equipo dado ha participado en la especialidad y anyo dados.
    function getAllEquipoParticipoEspecialidadAnyo($equipo_id, $especialidade_id, $anyo) {
        
        global $db;
        
        $queryEquipoParticipoEspecialidadAnyo = "SELECT id
                                                  FROM apuestas.especialidadanyos
                                                  WHERE (especialidade_id = ".$especialidade_id.")
                                                        AND (anyo = ".$anyo.")
                                                        AND (equipo_id = ".$equipo_id.");";
        if (!$db->getResult($queryEquipoParticipoEspecialidadAnyo))
            echo "Error.";
        
        $resArr = $db->getResultArray($queryEquipoParticipoEspecialidadAnyo);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        //echo "<br />".$queryEquipoParticipoEspecialidadAnyo;
        
        //return (count($resArr) > 0);
        return $resArr;    
    }
    
    // 
    function getResultadosPorCumplimiento($resultado, $especialidade_id, $anyo) {
        
        global $db;
        $queryStr = "SELECT * FROM "._TABLE_PREFIX_."resultados WHERE (resultado = '".$resultado."') AND (especialidade_id = ".$especialidade_id.") AND (anyo = ".$anyo.");";
        if (!$db->getResult($queryStr))
            echo "Error.";
        
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++)
          	$arr[$i] = new Resultado($resArr[$i]['id']);
        
        return $arr;
        
    }

    /**
     * Función que devuelve la media de los ratios que se han cumplido para un determinado resultado en una especialidad y en un anyo
     * STORED PROCEDURE
     * - mediaresultadosporcumplimiento (IN param_resultado CHAR(1), IN param_especialidad INT, IN param_anyo INT)          
     */         
    function getMediaResultadosPorCumplimiento($resultado, $especialidade_id, $anyo) {

        global $db;
        $queryStr = "SELECT count(*) 
                      FROM "._TABLE_PREFIX_."resultados 
                      WHERE (resultado = '".$resultado."') 
                            AND (especialidade_id = ".$especialidade_id.") 
                            AND (anyo = ".$anyo.");";
        if (!$db->getResult($queryStr))
            echo "Error.";
        
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        return $resArr[0][0];
        
    }
    
    function getAllRepostajes() {

        global $db;
        $queryStr = "SELECT id FROM "._TABLE_PREFIX_."repostajes ORDER BY fecha ASC";
        if (!$db->getResult($queryStr))
            echo "Error.";
        
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++)
          	$arr[$i] = new Repostaje($resArr[$i]['id']);
        
        return $arr;
    }
    
    function getAllEspecialidadesSeguidas() {
    
        global $db;
        $queryStr = "SELECT idespecialidad FROM especialidades_seguidas;";
        if (!$db->getResult($queryStr))
            echo "Error.";
        
        $resArr = $db->getResultArray($queryStr);
        if (is_bool($resArr) && $resArr == false)
          	return false;
        
        $arr = array();
        
        for ($i = 0; $i < count($resArr); $i++)
          	$arr[$i] = new Especialidade($resArr[$i]['idespecialidad']);
        
        return $arr;
    
    }

    function getAllAjustaNombresEquipos($arr, $nombre_equipo, $especialidade_id, $anyo) {
        //$res = array();
        $nombre_equipo = strtolower($nombre_equipo);
        if ($arr == false) {
            // si estoy en las ligas alemanas
            if (($especialidade_id == 11) || ($especialidade_id == 12)) {
                $res = new Equipo(1353);
            }
            // si estoy en las ligas noruegas

            // si estoy en las ligas suecas
            if (($especialidade_id == 16) || ($especialidade_id == 30)) {
                if (strpos($nombre_equipo, "jurg") != false) {
                    $res = new Equipo(218);
                }
            }
            // si estoy en las ligas finlandesas
            if (($especialidade_id == 17) || ($especialidade_id == 31)) {
                if (strpos($nombre_equipo, "jy") != false) {
                    $res = new Equipo(223);
                }
            }
        }

//        $handle = fopen("C:\\wamp\\www\\apuestas\\inc\\cron\\trazas.cron\\traza_tarea_programada_arr_nombreequipo.txt", "w");
//        fwrite($handle, print_r($res, true)." -- ".$nombre_equipo." -- ".strpos($nombre_equipo, "Djurg"));

        return $res;
    }

    
?>