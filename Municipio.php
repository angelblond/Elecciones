<?php 

include_once "conectorBD.php";
//include "CentroVotacion.php";

class Municipio{

	private $nombre;
	private $estado;
	private $listaCentros;
	
	public function Municipio($elNombre, $elEstado){
		$this->nombre = $elNombre;
		$this->estado = $elEstado;
		$this->listaCentros = array();
	}
	
	//Getter Maestro
    public function get($atributo) {
        return $this->$atributo;
    }

    //Setter maestro
    public function set($atributo, $valor){
        $this->$atributo = $valor;
    }
	
	public function getAtributos(){
		$resultado = array();
		array_push($resultado, "nombre");
		array_push($resultado, "estado");
		return $resultado;
	}
	
	public function listarCentros(){
		return $this->listaCentros();
	}
	
	public function agregarCentro($centro){
		array_push($this->listaCentros, $centro);
	}
	
	public function agregarMunicipio(){
		$resultado = 1;
		if($this->nombre!=NULL and $this->estado!=NULL){
			$conecta = conectorBD::getInstance();
			$resultado = $conecta->insertarMunicipio($this);
		}
		return $resultado;
	}
	
	public function modificarMunicipio($oldNombre, $oldEstado){
		$resultado = 1;
		if($this->nombre!=NULL and $this->estado!=NULL){
			$conecta = conectorBD::getInstance();
			$resultado = $conecta->modificarMunicipio($this, $oldNombre, $oldEstado);
		}
		return $resultado;
	}

	public function eliminarMunicipio(){
		$resultado = 1;
		if($this->nombre!=NULL and $this->estado!=NULL){
			$conecta = conectorBD::getInstance();
			$resultado = $conecta->eliminarMunicipio($this);
		}
		return $resultado;
	}

}
/*
echo "Hola mundo!";

$unMunicipio = new Municipio("Libertador", "Distrito Capital");
$unCentro = new CentroVotacion("Fermin Toro", "El Silencio", $unMunicipio);
echo $unCentro->get("municipio")->get("estado");
*/

/*
$unMunicipio = new Municipio("Racampun Chon","Zulia");
$res = $unMunicipio->agregarMunicipio();
if($res == 0){
	echo "Exito";
}
else{
	echo "Fracaso";
}
*/

/*
$unMunicipio = new Municipio("Libertador", "Distrito Capital");
$res = $unMunicipio->eliminarMunicipio();
if($res == 0){
	echo "Exito";
}
else{
	echo "Fracaso";
}
*/

/*
$unMunicipio = new Municipio("Libertador", "Distrito Capital");
$unMunicipio->set("nombre", "Bolivariano Libertador");
$res = $unMunicipio->modificarMunicipio("Libertador", "Distrito Capital");
if($res == 0){
	echo "Exito";
}
else{
	echo "Fracaso";
}
*/
?>