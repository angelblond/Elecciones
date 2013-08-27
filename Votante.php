<?php

include_once "conectorBD.php";
include "CentroVotacion.php";

class Votante{
	
	private $nombre;
	private $cedula;
	private $fecha_nacimiento;
	private $direccion;
	private $telefono;
	private $centro;
	
	public function Votante($elNombre = NULL, $laCedula = NULL, $laFecha = NULL, $laDireccion = NULL, $elTelefono = NULL, $elCentro = NULL){
		if($elNombre != NULL){
			$this->nombre = $elNombre;
			$this->cedula = $laCedula;
			$this->fecha_nacimiento = $laFecha;
			$this->direccion = $laDireccion;
			$this->telefono = $elTelefono;
			$this->centro = $elCentro;
		}
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
		array_push($resultado, "cedula");
		array_push($resultado, "fecha_nacimiento");
		array_push($resultado, "direccion");
		array_push($resultado, "telefono");
		array_push($resultado, "centro");
		return $resultado;
	}
	
	public function ensamblar($laCedula){
		$conecta = conectorBD::getInstance();
        $listaDatos = $conecta->consultarVotante($laCedula);
		$listaAtributos = $this->getAtributos();
		for($i = 0; $i < 5; $i++){
			$suAtributo = $listaAtributos[$i];
			$this->set($suAtributo, $listaDatos[$i]);
		}
		$suCentro = new CentroVotacion();
		$suCentro->ensamblar2($listaDatos[5]);
		$this->set("centro", $suCentro);
	}
	
	public function inscribirVotante($centro){
		$conn = conectorBD::getInstance();
		$respuesta = $conn->insertarVotante($this, $centro);
		return $respuesta;
	}
	
	public function modificarVotante($oldCedula){
		$resultado = 1;
		if($this->nombre!=NULL and $this->cedula!=NULL){
			$conecta = conectorBD::getInstance();
			$resultado = $conecta->modificarVotante($this, $oldCedula);
		}
		return $resultado;
	}
	
	public function eliminarVotante(){
		$resultado = 1;
		if($this->nombre!=NULL and $this->cedula!=NULL){
			$conecta = conectorBD::getInstance();
			$resultado = $conecta->eliminarVotante($this);
		}
		return $resultado;
	}
	
}
/*
$elVotante2 = new Votante();
$elVotante2->ensamblar(15585441);
echo $elVotante2->get("nombre");
echo "<br/>";
echo $elVotante2->get("cedula");
echo "<br/>";
echo $elVotante2->get("direccion");
echo "<br/>";
echo $elVotante2->get("fecha_nacimiento");
echo "<br/>";
echo $elVotante2->get("telefono");
echo "<br/>";
echo $elVotante2->get("centro")->get("listaMesas")[1]->get("ubicacion");
echo "<br/>";
echo $elVotante2->get("centro")->get("codCentro");
*/

/*
$elVotante2 = new Votante();
$elVotante2->ensamblar(15585441);
$elVotante2->set("direccion", "En algun lugar de la mancha");
$elVotante2->modificarVotante(15585441);
*/
?>