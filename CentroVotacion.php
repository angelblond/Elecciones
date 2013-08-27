<?php 

include_once "conectorBD.php";
include "Municipio.php";
include "Mesa.php";

class CentroVotacion{

	private $codCentro;
	private $nombre;
	private $direccion;
	private $municipio;
	private $listaMesas;
	
	public function CentroVotacion($elCodigo = NULL, $elNombre = NULL, $laDireccion = NULL, $elMunicipio = NULL, $laListaM = NULL){
		if($elCodigo != NULL){
			$this->codCentro = $elCodigo;
			$this->nombre = $elNombre;
			$this->direccion = $laDireccion;
			$this->municipio = $elMunicipio;
			$this->listaMesas = $laListaM;
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
		array_push($resultado, "codCentro");
		array_push($resultado, "nombre");
		array_push($resultado, "direccion");
		array_push($resultado, "municipio");
		array_push($resultado, "listaMesas");
		return $resultado;
	}
	
	public function ensamblar($elCodigo){
		$conecta = conectorBD::getInstance();
        $listaDatos = $conecta->consultarCentro($elCodigo);
		$listaAtributos = $this->getAtributos();
		for($i = 0; $i < 2; $i++){
			$suAtributo = $listaAtributos[$i];
			$this->set($suAtributo, $listaDatos[$i]);
		}
		$suMunicipio = new Municipio($listaDatos[3], $listaDatos[4]);
		$this->set("municipio", $suMunicipio);		
	}
	
	public function ensamblar2($elCodigo){
		$this->ensamblar($elCodigo);
		$this->listaMesas = array();
		$conecta = conectorBD::getInstance();
        $lasMesas = $conecta->consultarMesas($elCodigo);
		for ($i = 0; $i < sizeof($lasMesas); $i++){
			$listaDatos = $lasMesas[$i];
			$mesaTemp = new Mesa($this, $listaDatos[1], $listaDatos[2]);
			array_push($this->listaMesas, $mesaTemp);
		}
	}
	
	public function agregarCentroVotacion(){
		$resultado = 1;
		if($this->codCentro!=NULL and $this->nombre!=NULL){
			$conecta = conectorBD::getInstance();
			$resultado = $conecta->insertarCentroVotacion($this);
		}
		return $resultado;
	}
	
	public function modificarCentroVotacion($oldCodigo){
		$resultado = 1;
		if($this->codCentro!=NULL and $this->nombre!=NULL){
			$conecta = conectorBD::getInstance();
			$resultado = $conecta->modificarCentroVotacion($this, $oldCodigo);
		}
		return $resultado;
	}

	public function eliminarCentroVotacion(){
		$resultado = 1;
		if($this->codCentro!=NULL and $this->nombre!=NULL){
			$conecta = conectorBD::getInstance();
			$resultado = $conecta->eliminarCentroVotacion($this);
		}
		return $resultado;
	}
	
}
/*
$miCentro = new CentroVotacion();
$miCentro->ensamblar2("CA1");
$miCentro->set("direccion", "Esq. Solis a Marcos Parra");
$num = $miCentro->modificarCentroVotacion("CA1");
if ($num == 0){
	echo "Exito";
}
else{
	echo "Fracaso";
}
*/
?>