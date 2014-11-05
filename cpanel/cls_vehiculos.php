<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    var $mipvp;
    var $mipve;
    function __construct() {
        $this->ini_datos("ame_vehiculos","id");
        if($_POST["accion"]==20) {
            $res=$this->datos->ejecutar("select pvp, pve from ame_vehiculos where id=".$_POST["idobj"]);
            $r=mysql_fetch_object($res);
            $this->mipve=$r->pve;
            $this->mipvp=$r->pvp;
        }
        else {
            $this->mipve=$this->dectonorm($_POST["pve"]);
            $this->mipvp=$this->dectonorm($_POST["pvp"]);
        }
    }
    function get_tipodecoche() {
        $r='';
        $r.='<option value="NUEVO">NUEVO</option>';
        $r.='<option value="USADO">USADO</option>';
        return $r;
    }
    function get_procedente() {
        $r='';
        $r.='<option value="Particulares y  Profesionales">Particulares y  Profesionales</option>';
        $r.='<option value="Estudiantes">Estudiantes</option>';
        $r.='<option value="Empresas">Empresas</option>';
        return $r;
    }
    function get_combustible() {
        $a='';
        $a.='<option value="Diesel">Diesel</option>';
        $a.='<option value="Gasolina">Gasolina</option>';
        $a.='<option value="Híbrido">Híbrido</option>';
        return $a;
    }
    function get_transmision() {
        $r='';
        $r.='<option value="Manual">Manual</option>';
        $r.='<option value="Automatica">Automatica</option>';
        return $r;
    }
    function get_anio() {
        $r='';
        $anio=(int)date("Y");
        for($i=$anio;$i>1950;$i--) {
            $r.='<option value="'.$i.'">'.$i.'</option>';
        }
        return $r;
    }
    function get_cajadecambios() {
        $r='';
        $r.='<option value="3">3 Marchas</option>';
        $r.='<option value="5">5 Marchas</option>';
        $r.='<option value="6">6 Marchas</option>';
        return $r;
    }
    function lista() {
        $r = new MantixGrid();
        $sql="select a.*,replace(replace(replace(format(pvp,2),',','x'),'.',','),'x','.') as pvp2, b.nombre as color2, c.marca as marca2 from ame_vehiculos as a inner join ame_colores as b on a.colorexterior=b.id inner join ame_marcas as c on a.marca=c.id";
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"id","url_form"=>"vehiculos.php","url"=>"vehiculos.php");
        $r->columnas=array(
                array("titulo"=>"Marca", "campo"=>"marca2"),
                array("titulo"=>"Modelo", "campo"=>"modelo"),
                array("titulo"=>"Kilómetros", "campo"=>"kilometraje"),
                array("titulo"=>"Combustible", "campo"=>"combustible"),
                array("titulo"=>"Transmisión", "campo"=>"transmision"),
                array("titulo"=>"Color exterior", "campo"=>"color2"),
                array("titulo"=>"P.V.P.", "campo"=>"pvp2"),
        );

        return $r->ver();
    }
    function formulario() {
        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Registro");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
                array("label"=>"Tipo de coche:","campo"=>"tipodecoche","tipo"=>"select","opciones"=>$this->get_tipodecoche(),"obligatorio"=>"1"),
                array("label"=>"Marca:","campo"=>"marca","tipo"=>"select","tabla_asoc"=>"ame_marcas","campo_asoc"=>"marca","id_asoc"=>"id"),
                //array("label"=>"Vehículo destacado:","campo"=>"destacado","tipo"=>"checkbox"),
                array("label"=>"Modelo:","campo"=>"modelo","tipo"=>"text","obligatorio"=>"1"),
                array("label"=>"Versión:","campo"=>"version","tipo"=>"text"),
                //array("label"=>"Procedente de:","campo"=>"procedentede","tipo"=>"select","opciones"=>$this->get_procedente()),
                array("label"=>"Combustible:","campo"=>"combustible","tipo"=>"select","opciones"=>$this->get_combustible()),
                array("label"=>"Transmisión:","campo"=>"transmision","tipo"=>"select","opciones"=>$this->get_transmision()),
                //array("label"=>"Año:","campo"=>"anio","tipo"=>"select","opciones"=>$this->get_anio()),
                array("label"=>"Kilometraje:","campo"=>"kilometraje","tipo"=>"text","obligatorio"=>"1","validacion"=>"2"),
                array("label"=>"Matriculación:","campo"=>"matriculacion","tipo"=>"fecha"),
                array("label"=>"Color interior:","campo"=>"colorinterior","tipo"=>"select","tabla_asoc"=>"ame_colores","campo_asoc"=>"nombre","id_asoc"=>"id"),
                array("label"=>"Color exterior:","campo"=>"colorexterior","tipo"=>"select","tabla_asoc"=>"ame_colores","campo_asoc"=>"nombre","id_asoc"=>"id"),
                array("label"=>"Potencia:","campo"=>"potencia","tipo"=>"text","obligatorio"=>"1","validacion"=>"2"),
                //array("label"=>"Potencia en Kw:","campo"=>"potenciakw","tipo"=>"text"),
                //array("label"=>"Caja de cambios:","campo"=>"cajadecambios","tipo"=>"select","opciones"=>$this->get_cajadecambios()),
                array("label"=>"P.V.P.:","campo"=>"pvp","tipo"=>"text","obligatorio"=>"1","validacion"=>"6","valor"=>$this->normtodec_ini($this->mipvp)),
                array("label"=>"P.V.E.:","campo"=>"pve","tipo"=>"text","obligatorio"=>"1","validacion"=>"6","valor"=>$this->normtodec_ini($this->mipve)),
                //array("label"=>"IVA Deducible:","campo"=>"iva","tipo"=>"checkbox"),
                array("label"=>"Detalles:","campo"=>"resumen","tipo"=>"area"),
                array("label"=>"Detalles Técnicos:","campo"=>"detalles","tipo"=>"area"),
                array("label"=>"Imágenes:","campo"=>"imagenes","tipo"=>"selcadena"),
        );
        return $m_Form->ver();
    }
    function pre_ins() {
        $a=explode("/",$_POST["matriculacion"]);
        $this->datos->agregar("pvp",$this->dectonorm($_POST["pvp"]));
        $this->datos->agregar("pve",$this->dectonorm($_POST["pve"]));
        $this->datos->agregar("anio",$a[2]);
        $this->datos->agregar("estado","1");
        if($_POST["scadenaimagenes"]!="")
            $this->datos->agregar("imagenes",implode(",",$_POST["scadenaimagenes"]));
        $this->enviaremail("Inserci&oacute;n");
    }
    function pre_upd() {
        $a=explode("/",$_POST["matriculacion"]);
        $this->datos->agregar("pvp",$this->dectonorm($_POST["pvp"]));
        $this->datos->agregar("pve",$this->dectonorm($_POST["pve"]));
        $this->datos->agregar("anio",$a[2]);
        $this->datos->agregar("estado","1");
        if($_POST["scadenaimagenes"]!="")
            $this->datos->agregar("imagenes",implode(",",$_POST["scadenaimagenes"]));
        $this->enviaremail("Actualizaci&oacute;n");
    }
    function pre_del() {
        if($_POST["cid"]) {
            for($i=0;$i<count($_POST["cid"]);$i++) {
                $res=$this->datos->ejecutar("select * from ame_vehiculos where id=".$_POST["cid"][$i]);
                while($r=mysql_fetch_object($res)) {
                    $_POST["marca"]=$r->marca;
                    $_POST["modelo"]=$r->modelo;
                    $_POST["imagenes"]=$r->imagenes;
                    $_POST["idobj"]=$r->id;
                    $this->eliminarfotos();
                    $this->enviaremail("Eliminaci&oacute;n");
                }
            }
        }
        else {
            $res=$this->datos->ejecutar("select * from ame_vehiculos where id=".$_POST["idobj"]);
            while($r=mysql_fetch_object($res)) {
                    $_POST["marca"]=$r->marca;
                    $_POST["modelo"]=$r->modelo;
                    $_POST["imagenes"]=$r->imagenes;
                    $_POST["idobj"]=$r->id;
                    $this->eliminarfotos();
                    $this->enviaremail("Eliminaci&oacute;n");
            }
        }

    }
    function dectonorm($n) {
        $n=str_replace(".","",$n);
        $n=str_replace(",",".",$n);
        return $n;
    }
    function normtodec_ini($x) {
        $r=$this->normtodec($x);
        $x=explode(",", $r);
        return strrev($x[0]).",".$x[1];
    }
    function normtodec($x) {
        if($x!="") {
            $num=explode(".",$x);
            $ent=$num[0];
            $dec=($num[1]?$num[1]:0);
            $cont=1;
            $cadent="";
            for($i=strlen($ent)-1;$i>=0;$i--) {
                $cadent.=$ent[$i];
                if($cont==3 && $i>0 && $i<strlen($ent)-1) {
                    $cadent.=".";
                    $cont=0;
                }
                $cont++;
            }
            $minum=$cadent.",".$dec;
            return $minum;
        }
        else {
            return $x;
        }
    }
    function validar_pv() {
        if(strpos($_POST["pvp"],',')) {
            $pvp=str_replace(".","",$_POST["pvp"]);
            $pvp=str_replace(",",".",$pvp);
        }
        else
            $pvp=$_POST["pvp"];
        if(strpos($_POST["pve"],',')) {
            $pve=str_replace(".","",$_POST["pve"]);
            $pve=str_replace(",",".",$pve);
        }
        else
            $pve=$_POST["pve"];
        if(preg_match("/^[0-9]{1,9}[.,']{0,1}[0-9]{0,9}$/",$pvp)==0) {
            $this->mensaje_error="Error: El PVP debe ser numérico";
        }
        else
        if(preg_match("/^[0-9]{1,9}[.,']{0,1}[0-9]{0,9}$/",$pve)==0) {
            $this->mensaje_error="Error: El PVE debe ser numérico";
        }
        $this->datos->agregar("pvp",$pvp);
        $this->datos->agregar("pve",$pve);
        //break;
    }
    function enviaremail($operacion) {
        $direccion_de_destino="danichalay@yahoo.es";
        $permitir_enviar_email=false;
        if($permitir_enviar_email) {
            $from="danichalay@yahoo.es";
            $to=$direccion_de_destino;
            $url="http://www.ameri-cars.com";
            $eol="\r\n";
            $now = mktime().".".md5(rand(1000,9999));
            $headers = "From:".$from.$eol."To:".$to.$eol;
            $headers .= 'Return-Path: '.$to.'<'.$to.'>'.$eol;
            $headers .= "Message-ID: <".$now." TheSystem@".$_SERVER['SERVER_NAME'].">".$eol;
            $headers .= "X-Mailer: PHP v".phpversion().$eol;
            $headers .= "Content-Type: text/html; charset=utf-8".$eol;

            $mensaje = "<style type=\"text/css\">.titulo { font-family: Verdana, arial, sanserif; font-size:16px; font-weight:bold; color:#0097C9 } \n .label { font-family: tahoma, arial, sanserif; font-size:12px; color:#0097C9 } \n .datos { font-family: tahoma, arial, sanserif; font-size:12px; color:#000000; background-color:#F4F3F0; }</style>";
            $mensaje.= '<table>';
            $mensaje.= '    <tr><td class="label">Dominio:</td><td class="datos">'.$url.'</td></tr>';
            $mensaje.= '    <tr><td class="label">Usuario:</td><td class="datos">'.$_SESSION["user"]["nombre"].'</td></tr>';
            $mensaje.= '    <tr><td class="label">Operaci&oacute;n realizada:</td><td class="datos">'.$operacion.'</td></tr>';
            $mensaje.= '    <tr><td class="label">Coche afectado:</td><td class="datos">'.$_POST["marca"].' - '.$_POST["modelo"].'</td></tr>';
            $mensaje.= '    <tr><td class="label">Nro del registro:</td><td class="datos">'.$_POST["idobj"].'</td></tr>';
            $mensaje.= '    <tr><td class="label">Fecha y hora:</td><td class="datos">'.date("d/m/Y h:i:s a").'</td></tr>';
            $mensaje.= '</table>';
            $resultado=mail($to, "Ameri-cars", $mensaje, $headers);
        }
    }
    function eliminarfotos() {
        if($_POST["imagenes"]!=""){
            $res=explode(",",$_POST["imagenes"]);
            foreach($res as $r){
                unlink("../images/cars/p".$r);
                unlink("../images/cars/g".$r);
                unlink("../images/cars/m".$r);
            }
        }
    }
}
?>
