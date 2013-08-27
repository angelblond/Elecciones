<?php 

include_once "conectorBD.php";
include "Candidato.php";

class Voto{

	private $codigo;
	private $candidato;
	private $partido;
	private $mesa;
	
	public function Voto($elCodigo = NULL, $elCandidato = NULL, $elPartido = NULL, $laMesa = NULL){
		if ($elCodigo != NULL){
			$this->codigo = $elCodigo;
			$this->candidato = $elCandidato;
			$this->partido = $elPartido;
			$this->mesa = $laMesa;
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
	
	public function realizarVotacion(){
		$conecta = conectorBD::getInstance();
		return $conecta->insertarVoto($this);
	}

}
/*
$miCandidato = new Candidato();
$miCandidato->ensamblar(15544684);
$miPartido = new Partido();
$miPartido->ensamblar("Copei");
$num = $miCandidato->inscribirRespaldoPartido($miPartido);
if ($num == 0){
	echo "Exito";
}
else{
	echo "Fracaso";
}
$unCentro = new CentroVotacion();
$unCentro->ensamblar2("CA1");
$mesita = $unCentro->get("listaMesas")[0];
$elVoto = new Voto("Voto1",$miCandidato,$miPartido,$mesita);
$elVoto->realizarVotacion();
*/
?>