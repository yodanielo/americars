<?php
include("cls_MantixBase20.php");

class registro extends MantixBase {
    var $id;
    var $nombres;
    var $apellidos;
    var $usuario;
    var $password;

    function __construct() {
        $this->ini_datos("ame_colores","id");
    }


    function lista() {
        $r = new MantixGrid();
        $r->atributos=array("tabla"=>"ame_colores","nropag"=>"20","ordenar"=>"id");
        $r->columnas=array(
                array("titulo"=>"Color","campo"=>"nombre"),
        );

        return $r->ver();
    }

    function formulario() {

        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Registro");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
                array("label"=>"Color:","campo"=>"nombre","obligatorio"=>"1"),
        );

        $res = $m_Form->ver();
        return  $res;
    }
    function pre_ins() {
        $this->datos->agregar("estado","1");
        $this->datos->agregar("nombre",strtoupper($_POST["nombre"]));
    }
    function pre_upd() {
        $this->datos->agregar("estado","1");
        $this->datos->agregar("nombre",strtoupper($_POST["nombre"]));
    }
    function pre_del() {
        if($_POST["cid"]) {
            for($i=0;$i<count($_POST["cid"]);$i++) {
                $this->eliminar($_POST["cid"][$i]);
            }
        }
        else {
            $this->eliminar($_POST["idobj"]);
        }
    }
    function eliminar($mid){
        $this->datos->ejecutar("delete from ame_vehiculos where colorexterior=".$mid." or colorinterior=".$mid);
    }
}
?>