<?php

class conectorBD {

    private static $instanciaBD;

    /*
        Parametros de entrada:
                                  NINGUNO
        Parametros de salida:
                                  Objeto del tipo conectorBD
        Descripcion:
                                  Patron singleton, solo crea un nuevo objeto conectorBD si ya no existe una instancia del mismo.
    */
    public static function getInstance(){
        if (!(self::$instanciaBD instanceof self)){
            self::$instanciaBD=new self();
        }
        return self::$instanciaBD;
    }

    /*
        Parametros de entrada:
                                  $id:       Variable del tipo string que representa el usuario
                                  $pass:     Variable del tipo string que representa la contraseña
        Parametros de salida:
                                  $conexion: Si la conexion es exitosa
                                  FALSE:     Si hay un error durante la conexion
								  
	    Descripcion:
		                          Crea la conexión a la base de datos.
								  
    */
    private static function conectar($id, $pass){
        $conexion = mysql_connect("localhost", $id, $pass);
        mysql_select_db("Elecciones", $conexion);
		mysql_query("SET NAMES 'utf8'");
        return $conexion;
    }

	/*
	    Descripcion:
		               Cierra la conexión a la base de datos.
    */	
    private static function desconectar($conexion){
        mysql_close($conexion);
    }
	
	/*
        Parametros de entrada:
                                  $query:      Variable del tipo string que contiene la consulta SQL a realizar
        Parametros de salida:
                                  $listaFinal: Lista que contiene los atributos solicitados (una sola fila)							  
	    Descripcion:
		                          Función genérica para centralizar las consultas a la BD, cuyo resultado es único.
    */
	public function consultaGlobal($query){
		$conexion = $this->conectar("root","");
		$laConsulta = $query;
		$resultado = mysql_query($laConsulta, $conexion);
		$listaFinal = mysql_fetch_row($resultado);
        $this->desconectar($conexion);
		return $listaFinal;
	}
	
	/*
        Parametros de entrada:
                                  $query:      Variable del tipo string que contiene la consulta SQL a realizar
        Parametros de salida:
                                  $listaFinal: Lista que contiene los atributos solicitados (varias filas)							  
	    Descripcion:
		                          Función genérica para centralizar las consultas a la BD, cuyo resultado entrega varias filas.
    */
	public function consultaGlobal2($query){
		$conexion = $this->conectar("root","");
		$laConsulta = $query;
		$resultado = mysql_query($laConsulta, $conexion);
		$listaFinal = array();
		while($fila = mysql_fetch_row($resultado)){
			$listaAuxiliar = array();
            foreach ($fila as $contador => $Valor){
				array_push($listaAuxiliar, $Valor);
            }
			array_push($listaFinal, $listaAuxiliar);
        }
        $this->desconectar($conexion);
		return $listaFinal;
	}
		
	
	public function acceso($unUsuario, $unaClave){
		$conexion = $this->conectar("root","");
		$laConsulta = "SELECT * FROM USUARIO WHERE NOMBRE = '$unUsuario' AND CLAVE = '$unaClave'";
		//echo $laConsulta;
		$resultado = mysql_query($laConsulta, $conexion);
		if($resultado == FALSE){
			$this->desconectar($conexion);
			return false;
		}
		else{
			if (mysql_num_rows($resultado) > 0){
				$this->desconectar($conexion);
				return mysql_fetch_row($resultado);
			}
			else{
				$this->desconectar($conexion);
				return false;
			}
		}
	}
	
	public function consultarVotante($unaCedula){
		$resultado = $this->consultaGlobal("SELECT * FROM VOTANTE WHERE CEDULA = $unaCedula");
		return $resultado;
	}
	
	public function consultarCandidato($unaCedula){
		$resultado = $this->consultaGlobal("SELECT * FROM CANDIDATO C INNER JOIN VOTANTE V ON C.CEDULA = V.CEDULA WHERE C.CEDULA = $unaCedula");
		return $resultado;
	}
	
	public function consultarCentro($unCodigo){
		$resultado = $this->consultaGlobal("SELECT * FROM CENTROVOTACION WHERE CODCENTRO = '$unCodigo'");
		return $resultado;
	}
	
	public function consultarMesas($unCentro){
		$resultado = $this->consultaGlobal2("SELECT * FROM MESA WHERE CENTRO = '$unCentro'");
		return $resultado;
	}
	
	public function consultarPartido($unNombre){
		$resultado = $this->consultaGlobal("SELECT * FROM PARTIDO WHERE NOMBRE = '$unNombre'");
		return $resultado;
	}
	
		
	public function consultarVotosMesa($unaMesa, $unCentro){
		$resultado = $this->consultaGlobal2("SELECT * FROM VOTO WHERE CENTRO = '$unCentro' AND MESA = $unaMesa");
		return $resultado;
	}
	
	public function consultarVotosPartidoCentroMesa($unPartido, $unCentro, $unaMesa){
		$resultado = $this->consultaGlobal2("SELECT * FROM VOTO WHERE MESA = $unaMesa AND CENTRO = '$unCentro' AND PARTIDO = '$unPartido'");
		return $resultado;
	}
	
	public function consultarVotosPartidoCentro($unPartido, $unCentro){
		$resultado = $this->consultaGlobal2("SELECT * FROM VOTO WHERE CENTRO = '$unCentro' AND PARTIDO = '$unPartido'");
		return $resultado;
	}
	
	public function consultarVotosPartidoTotales($unPartido){
		$resultado = $this->consultaGlobal2("SELECT * FROM VOTO WHERE PARTIDO = '$unPartido'");
		return $resultado;
	}
	
	public function consultarVotosCandidatoCentroMesa($unCandidato, $unCentro){
		$resultado = $this->consultaGlobal2("SELECT * FROM VOTO WHERE MESA = $unaMesa AND CENTRO = '$unCentro' AND CI_CANDIDATO = '$unCandidato'");
		return $resultado;
	}
	
	public function consultarVotosCandidatoCentro($unCandidato, $unCentro){
		$resultado = $this->consultaGlobal2("SELECT * FROM VOTO WHERE CENTRO = '$unCentro' AND CI_CANDIDATO = '$unCandidato'");
		return $resultado;
	}
	
	public function consultarVotosCandidatoTotales($unCandidato){
		$resultado = $this->consultaGlobal2("SELECT * FROM VOTO WHERE PARTIDO = '$unCandidato'");
		return $resultado;
	}
	
	public function listarUsuarios(){
		$resultado = $this->consultaGlobal2("SELECT NOMBRE FROM USUARIO");
		return $resultado;
	}
	
	public function listarMunicipios($unEstado){
		$resultado = $this->consultaGlobal2("SELECT * FROM MUNICIPIO WHERE ESTADO = '$unEstado'");
		return $resultado;
	}
	
	public function listarEstados(){
		$resultado = $this->consultaGlobal2("SELECT ESTADO FROM MUNICIPIO GROUP BY ESTADO");
		return $resultado;
	}
	
	public function listarCentrosVotacion($unEstado, $unMunicipio){
		$resultado = $this->consultaGlobal2("SELECT * FROM CENTROVOTACION WHERE ESTADO = '$unEstado' AND MUNICIPIO = '$unMunicipio'");
		return $resultado;
	}
	
	public function listarCandidatos($unEstado, $unMunicipio){
		$resultado = $this->consultaGlobal2("SELECT * FROM CENTROVOTACION WHERE ESTADO = '$unEstado' AND MUNICIPIO = '$unMunicipio'");
		return $resultado;
	}
	
	/*	Parametros de entrada:
			                    $nombreTabla: Nombre de la tabla a insertar
		Parametros de salida: 
				                0: Si la insercion del objeto fue exitosa
				                1: Si no se realizo la insercion del objeto
	    Descripcion:             
		                        Función genérica que permite insertar los valores de los atributos de un objeto en la tabla en la base de datos
	*/
	public function insertarGlobal($nombreTabla, $valores){	
		$conexion = $this->conectar("root","");
		$string = "insert into $nombreTabla values($valores)";
		$consulta = mysql_query($string,$conexion);
		if(!mysql_error()) {
			$this->desconectar($conexion);
			return(0);
		} 
		else {
			$this->desconectar($conexion);
			return(1);
		}
	}
	
	public function insertarPartido($unPartido){
		$suNombre = $unPartido->get("nombre");
		$suTendencia = $unPartido->get("tendencia");
		$resultado = $this->insertarGlobal("PARTIDO", "'$suNombre','$suTendencia'");
		return $resultado;
	}
	
	public function insertarCandidato($unCandidato){
		$suCedula = $unCandidato->get("cedula");
		$resultado = $this->insertarGlobal("CANDIDATO", "'$suCedula'");
		$unaListaPartidos = $unCandidato->get("partidosRespaldo");
		if($unaListaPartidos != NULL){
			for($i = 0; $i < sizeof(unaListaPartidos); $i++){
				$suPartido = $unaListaPartidos[$i]->get("nombre");
				$resultado = $this->insertarGlobal("APOYA", "'$suCedula','$suPartido'");
			}
		}
		return $resultado;
	}
	
	public function insertarMunicipio($unMunicipio){
		$suNombre = $unMunicipio->get("nombre");
		$suEstado = $unMunicipio->get("estado");
		$resultado = $this->insertarGlobal("MUNICIPIO", "'$suNombre','$suEstado'");
		return $resultado;
	}
	
	public function insertarCentroVotacion($unCentro){
		$suCodigo = $unCentro->get("codCentro");
		$suNombre = $unCentro->get("nombre");
		$suDireccion = $unCentro->get("direccion");
		$suMunicipio = $unCentro->get("municipio")->get("nombre");
		$suEstado = $unCentro->get("municipio")->get("estado");
		$resultado = $this->insertarGlobal("CENTROVOTACION", "'$suCodigo','$suNombre','$suDireccion','$suMunicipio','$suEstado'");
		return $resultado;
	}
	
	public function insertarMesa($unaMesa){
		$suCentro = $unaMesa->get("centro")->get("codCentro");
		$suNumero = $unaMesa->get("numero");
		$suUbicacion = $unaMesa->get("ubicacion");
		$resultado = $this->insertarGlobal("MESA", "'$suCentro',$suNumero,'$suUbicacion'");
		return $resultado;
	}
	
	public function insertarVotante($unVotante){
		$suNombre = $unVotante->get("nombre");
		$suCedula = $unVotante->get("cedula");
		$suFecha = $unVotante->get("fecha_nacimiento");
		$suDireccion = $unVotante->get("direccion");
		$suTelefono = $unVotante->get("telefono");
		$suCentro = $unVotante->get("centro")->get("codCentro");
		$resultado = $this->insertarGlobal("VOTANTE", "'$suNombre',$suCedula,'$suFecha','$suDireccion','$suTelefono','$suCentro'");
		return $resultado;
	}
	
	public function insertarVoto($unVoto){
		$suCodigo = $unVoto->get("codigo");
		$suCedula = $unVoto->get("candidato")->get("cedula");
		$suPartido = $unVoto->get("partido")->get("nombre");
		$suMesa = $unVoto->get("mesa")->get("numero");
		$suCentro = $unVoto->get("mesa")->get("centro")->get("codCentro");
		$resultado = $this->insertarGlobal("VOTO", "'$suCodigo',$suCedula,'$suPartido','$suMesa','$suCentro'");
		return $resultado;
	}
	
	public function insertarCandPart($unCandidato, $unPartido){
		$suCedula = $unCandidato->get("cedula");
		$suPartido = $unPartido->get("nombre");
		$resultado = $this->insertarGlobal("APOYA", "$suCedula,'$suPartido'");
		return $resultado;
	}
	
	/*	Parametros de entrada:
			                    $nombreTabla: nombre de la tabla a la cual se eliminará una o más tuplas
				                $parametro: Nombre del parametro clave para modificar la tabla
				                $simbolo : Variable del tipo string que representa el operador para comparar el parametro y el valor del atributo a eliminar
		Parametros de salida: 
				                0: Si se elimina el obj de forma exitosa de la tabla
				                1: Si no se eliminar el obj de la tabla
		Descripcion:
                     		    Metodo que permite eliminar la tupla de la tabla indicada
    */
	public function eliminarGlobal ($nombreTabla, $condicion) {
		$conexion = $this->conectar("root","");
		$sql = "DELETE FROM $nombreTabla where $condicion";
		$consulta =  mysql_query($sql,$conexion);
		if(!mysql_error()) {
			$this->desconectar($conexion);
			return(0);
		} 
		else {
			$this->desconectar($conexion);
			return(1);
		}
	}
	
	public function eliminarMunicipio($unMunicipio){
		$suNombre = $unMunicipio->get("nombre");
		$suEstado = $unMunicipio->get("estado");
		$resultado = $this->eliminarGlobal("MUNICIPIO", "NOMBRE = '$suNombre' AND ESTADO ='$suEstado'");
		return $resultado;
	}
	
	public function eliminarCentroVotacion($unCentro){
		$suCodigo = $unCentro->get("codCentro");
		$resultado = $this->eliminarGlobal("CENTROVOTACION", "CODCENTRO = '$suCodigo'");
		return $resultado;
	}
	
	public function eliminarMesa($unaMesa){
		$suNumero = $unaMesa->get("numero");
		$suCentro = $unaMesa->get("centro")->get("codCentro");
		$resultado = $this->eliminarGlobal("MESA", "CENTRO = '$suCodigo' AND NUMERO = $suNumero");
		return $resultado;
	}
	
	public function eliminarVotante($unVotante){
		$suCedula = $unVotante->get("cedula");
		$resultado = $this->eliminarGlobal("VOTANTE", "CEDULA = '$suCedula'");
		return $resultado;
	}
	
	public function eliminarCandidato($unCandidato){
		$suCedula = $unCandidato->get("cedula");
		$resultado = $this->eliminarGlobal("CANDIDATO", "CEDULA = '$suCedula'");
		return $resultado;
	}
	
	public function eliminarPartido($unPartido){
		$suNombre = $unPartido->get("nombre");
		$resultado = $this->eliminarGlobal("PARTIDO", "NOMBRE = '$suNombre'");
		return $resultado;
	}
	
	public function eliminarVoto($unVoto){
		$suCodigo = $unVoto->get("codigo");
		$resultado = $this->eliminarGlobal("VOTO", "CODIGO_VOTO = '$suCodigo'");
		return $resultado;
	}
	
	public function modificarGlobal($nombreTabla, $limite, $objeto, $condicion){
		$conexion = $this->conectar("root","");
		$consulta = "UPDATE $nombreTabla SET ";
		$losAtributos = $objeto->getAtributos();
		for($i = 0; $i < $limite; $i++){
			$elAtributo = $losAtributos[$i];
			$elValor = $objeto->get($elAtributo);
			if(is_numeric($elValor)){
				if($i < $limite-1){
					$consulta = $consulta.$elAtributo." = ".$elValor.", ";
				}
				else{
					$consulta = $consulta.$elAtributo." = ".$elValor;
				}
			}
			else{
				if($i < $limite-1){
					$consulta = $consulta.$elAtributo." = '".$elValor."', ";
				}
				else{
					$consulta = $consulta.$elAtributo." = '".$elValor."'";
				}
			}			
		}
		$consulta = $consulta." WHERE ".$condicion;
		$ejecucion =  mysql_query($consulta,$conexion);
		if(!mysql_error()) {
			$this->desconectar($conexion);
			return(0);
		} 
		else {
			$this->desconectar($conexion);
			return(1);
		}
	}
	
	public function modificarAlterno($nombreTabla, $atributo, $valor, $condicion){
		$conexion = $this->conectar("root","");
		$consulta = "UPDATE $nombreTabla SET $atributo = ";
		if(is_numeric($valor)){
			$consulta = $consulta.$valor;
		}
		else{
			$consulta = $consulta."'".$valor."'";
		}
		$consulta = $consulta." WHERE ".$condicion;
		$ejecucion =  mysql_query($consulta,$conexion);
		if(!mysql_error()) {
			$this->desconectar($conexion);
			return(0);
		} 
		else {
			$this->desconectar($conexion);
			return(1);
		}
	}
	
	public function modificarMunicipio($unMunicipio, $oldNombre, $oldEstado){
		$laCondicion = "NOMBRE = '$oldNombre' AND ESTADO = '$oldEstado'";
		$resultado = $this->modificarGlobal("MUNICIPIO", 2, $unMunicipio, $laCondicion);
		return $resultado;
	}
	
	public function modificarCentroVotacion($unCentro, $oldCodigo){
		$laCondicion = "CODCENTRO = '$oldCodigo'";
		$resultado = $this->modificarGlobal("CENTROVOTACION", 3, $unCentro, $laCondicion);
		$elMunicipio = $unCentro->get("municipio")->get("nombre");
		$elEstado = $unCentro->get("municipio")->get("estado");
		$resultado = $this->modificarAlterno("CENTROVOTACION", "municipio", $elMunicipio, $laCondicion);
		$resultado = $this->modificarAlterno("CENTROVOTACION", "estado", $elEstado, $laCondicion);
		return $resultado;
	}
	
	public function modificarMesa($unaMesa, $oldCentro, $oldNumero){
		$laCondicion = "CENTRO = '$oldCentro' AND NUMERO = $oldNumero";
		$suCentro = $unaMesa->get("centro")->get("codCentro");
		$suNumero = $unaMesa->get("numero");
		$suUbicacion = $unaMesa->get("ubicacion");
		$resultado = $this->modificarAlterno("MESA", "centro", $suCentro, $laCondicion);
		$laCondicion = "CENTRO = '$suCentro' AND NUMERO = $oldNumero";
		$resultado = $this->modificarAlterno("MESA", "numero", $suNumero, $laCondicion);
		$laCondicion = "CENTRO = '$suCentro' AND NUMERO = $suNumero";
		$resultado = $this->modificarAlterno("MESA", "ubicacion", $suUbicacion, $laCondicion);
		return $resultado;
	}
	
	public function modificarVotante($unVotante, $oldCedula){
		$laCondicion = "CEDULA = $oldCedula";
		$resultado = $this->modificarGlobal("VOTANTE", 5, $unVotante, $laCondicion);
		$suCentro = $unVotante->get("centro")->get("codCentro");
		$suCedula = $unVotante->get("cedula");
		$laCondicion = "CEDULA = $suCedula";
		$resultado = $this->modificarAlterno("VOTANTE", "centro", $suCentro, $laCondicion);
		return $resultado;
	}
	
	public function modificarPartido($unPartido, $oldNombre){
		$laCondicion = "NOMBRE = '$oldNombre'";
		$resultado = $this->modificarGlobal("PARTIDO", 2, $unPartido, $laCondicion);
		return $resultado;
	}
}

?>