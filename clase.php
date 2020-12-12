<?php
//Attribute
class Partida{
    private $id;
    private $nivel;
    private $categorias;
    private $usuarios;
    private $preguntas;
/*
    public function __construct($niv,$catego,$users){
        $this->nivel=$niv;
        $this->categorias=$catego;
        $this->usuarios=$users;
        echo "que onda si entre al constructor\n";

    }*/

    public function __construct($input){
        $this->id=$input['id'];
        $this->nivel=$input['nivel'];
        $this->categorias=$input['categorias'];
        $this->usuarios=$input['usuarios'];
        $this->preguntas=$input['preguntas'];
    }

    public function getNivel(){
        return $this->nivel;
    }
    public function getCategorias(){
        return $this->categorias;
    }
    public function getUsusarios(){
        if($this->usuarios!=""){
            return $this->usuarios;
        }
        else {
            return "fuuuuuuck";
        }
    }
    public function expose() {
        echo "pos si";
        return get_object_vars($this);
    }
}
?>