<?php

include_once "conectorBD.php";
include "Votante.php";
include "Partido.php";


class Candidato extends Votante{

	private $partidosRespaldo;
	private $municipio;

	public function Candidato($elVotante = NULL, $losPartidos = NULL, $elMunicipio = NULL){
		if ($elVotante != NULL){
			$this->nombre = $elVotante->get("nombre");
			$this->cedula =  $elVotante->get("cedula");
			$this->fecha_nacimiento = $elVotante->get("fecha_nacimiento");
			$this->direccion = $elVotante->get("direccion");
			$this->telefono = $elVotante->get("telefono");
			$this->centro = $elVotante->get("centro");
			$this->municipio = $elMunicipio;
		}
		if ($losPartidos != NULL){
			$this->partidosRespaldo = $losPartidos;
		}
	}
	
	
	public function ensamblar($laCedula){
		$this->partidosRespaldo = array();
		$conecta = conectorBD::getInstance();
        $listaDatos = $conecta->consultarCandidato($laCedula);
		$listaAtributos = $this->getAtributos();
		for($i = 0; $i < 5; $i++){
			$suAtributo = $listaAtributos[$i];
			$this->set($suAtributo, $listaDatos[$i+3]);
		}
		$suMunicipio = new Municipio($listaDatos[1], $listaDatos[2]);
		$this->set("municipio", $suMunicipio);
		$suCentro = new CentroVotacion();
		$suCentro->ensamblar2($listaDatos[8]);
		$this->set("centro", $suCentro);
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
		array_push($resultado, "partidosRespaldo");
		return $resultado;
	}
	
	public function inscribirRespaldoPartido($elPartido){
		array_push($this->partidosRespaldo, $elPartido);
		$conecta = conectorBD::getInstance();
        $respuesta = $conecta->insertarCandPart($this, $elPartido);
        return $respuesta;
	}
	
	public function agregarCandidato(){
		$resultado = 1;
		if($this->nombre!=NULL and $this->cedula!=NULL){
			$conecta = conectorBD::getInstance();
			$resultado = $conecta->insertarCandidato($this);
		}
		return $resultado;
	}
	
	public function modificarCandidato($oldCedula){
		$resultado = 1;
		if($this->nombre!=NULL and $this->cedula!=NULL){
			$conecta = conectorBD::getInstance();
			$resultado = $conecta->modificarCandidato($this, $oldCedula);
		}
		return $resultado;
	}

	public function eliminarCandidato(){
		$resultado = 1;
		if($this->nombre!=NULL and $this->cedula!=NULL){
			$conecta = conectorBD::getInstance();
			$resultado = $conecta->eliminarCandidato($this);
		}
		return $resultado;
	}
	
}
/*
$original = new Votante("Rodrigo", "Perez", 4565811, "14/02/1974", "0212-1545651", "uncentro");
$partido1  = new Partido("PSUV", "Izquierda");
$partido2 = new Partido("PCV", "Izquierda");
$listaP = array($partido1, $partido2);
$elCandidato = new Candidato($original, $listaP);

echo $elCandidato->get("partidosRespaldo")[1]->get("nombre");
*/
/*
$elCandidato2 = new Candidato();
$elCandidato2->ensamblar(15544684);
echo $elCandidato2->get("nombre");
echo "<br/>";
echo $elCandidato2->get("cedula");
echo "<br/>";
echo $elCandidato2->get("direccion");
echo "<br/>";
echo $elCandidato2->get("fecha_nacimiento");
echo "<br/>";
echo $elCandidato2->get("municipio")->get("nombre");
echo "<br/>";
echo $elCandidato2->get("centro")->get("listaMesas")[1]->get("ubicacion");
*/

?>