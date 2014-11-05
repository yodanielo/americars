<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    function __construct() {
        $this->ini_datos("ame_marcas","id");
    }
    function lista() {
        $r = new MantixGrid();
        $r->atributos=array("tabla"=>"ame_marcas","nropag"=>"20","ordenar"=>"id","url_form"=>"marcas.php","url"=>"marcas.php");
        $r->columnas=array(
            array("titulo"=>"Marca", "campo"=>"marca"),
        );

        return $r->ver();
    }
    function formulario() {
        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Registro");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
            array("label"=>"Marca:","campo"=>"marca"),
        );
        return $m_Form->ver();
    }
    function pre_ins() {
        $this->datos->agregar("estado","1");
        $this->datos->agregar("marca",strtoupper($_POST["marca"]));
    }
    function pre_upd() {
        $this->datos->agregar("estado","1");
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
        $this->datos->ejecutar("delete from ame_vehiculos where marca='".$mid."'");
    }
}
?>
