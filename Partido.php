<?php 

include_once "conectorBD.php";

class Partido{

	private $nombre;
	private $tendencia;
	private $listaCandidatos;

	public function Partido($elNombre = NULL, $laTendencia = NULL, $losCandidatos = NULL){
		if($elNombre != NULL){
			$this->nombre = $elNombre;
			$this->tendencia = $laTendencia;
			$this->listaCandidatos = $losCandidatos;
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
		array_push($resultado, "tendencia");
		array_push($resultado, "listaCandidatos");
		return $resultado;
	}
	
	
	public function ensamblar($elNombre){
		$conecta = conectorBD::getInstance();
        $listaDatos = $conecta->consultarPartido($elNombre);
		$listaAtributos = $this->getAtributos();
		for($i = 0; $i < 2; $i++){
			$suAtributo = $listaAtributos[$i];
			$this->set($suAtributo, $listaDatos[$i]);
		}
	}
	
	public function agregarPartido(){
		$resultado = 1;
		if($this->nombre!=NULL and $this->tendencia!=NULL){
			$conecta = conectorBD::getInstance();
			$resultado = $conecta->insertarPartido($this);
		}
		return $resultado;
	}
	
	public function modificarPartido($oldNombre){
		$resultado = 1;
		if($this->nombre!=NULL and $this->tendencia!=NULL){
			$conecta = conectorBD::getInstance();
			$resultado = $conecta->modificarPartido($this, $oldNombre);
		}
		return $resultado;
	}

	public function eliminarPartido(){
		$resultado = 1;
		if($this->nombre!=NULL and $this->tendencia!=NULL){
			$conecta = conectorBD::getInstance();
			$resultado = $conecta->eliminarPartido($this);
		}
		return $resultado;
	}
}

/*
$unPartido = new Partido();
$unPartido->ensamblar("PSUV");
echo $unPartido->get("tendencia");
*/
/*
$unPartido = new Partido("Unidad Popular", "Derecha");
$num = $unPartido->agregarPartido();
if ($num == 0){
	echo "Exito";
}
else{
	echo "Fracaso";
}
*/

/*
$unPartido = new Partido();
$unPartido->ensamblar("PSUV");
$num = $unPartido->eliminarPartido();
if ($num == 0){
	echo "Exito";
}
else{
	echo "Fracaso";
}
*/
?>