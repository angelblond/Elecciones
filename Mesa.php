<?php 

include_once "conectorBD.php";

class Mesa{

	private $centro;
	private $numero;
	private $ubicacion;
	private $listaVotos;
	
	public function Mesa($elCentro = NULL, $elNumero = NULL, $laUbicacion = NULL, $laLista = NULL){
		if($elCentro != NULL){
			$this->centro = $elCentro;
			$this->numero = $elNumero;
			$this->ubicacion = $laUbicacion;
			$this->listaVotos = $laLista;
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
		array_push($resultado, "centro");
		array_push($resultado, "numero");
		array_push($resultado, "ubicacion");
		array_push($resultado, "listaVotos");
		return $resultado;
	}
	
	public function agregarMesa(){
		$resultado = 1;
		if($this->centro!=NULL and $this->numero!=NULL){
			$conecta = conectorBD::getInstance();
			$resultado = $conecta->insertarMesa($this);
		}
		return $resultado;
	}
	
	public function modificarMesa($oldCodigoCentro, $oldNumero){
		$resultado = 1;
		if($this->centro!=NULL and $this->numero!=NULL){
			$conecta = conectorBD::getInstance();
			$resultado = $conecta->modificarMesa($this, $oldCodigoCentro, $oldNumero);
		}
		return $resultado;
	}

	public function eliminarMesa(){
		$resultado = 1;
		if($this->centro!=NULL and $this->numero!=NULL){
			$conecta = conectorBD::getInstance();
			$resultado = $conecta->eliminarMesa($this);
		}
		return $resultado;
	}

}

?>