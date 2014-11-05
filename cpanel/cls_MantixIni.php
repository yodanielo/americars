<?php
include("cls_MantixMenu.php");
$menu =new MantixMenu();
$menu->opciones = array(
	array("titulo"=>"Administradores" ,"url"=>"usuarios.php","id"=>"usuarios"),
	array("titulo"=>"Usuarios" ,"url"=>"registro.php","id"=>"usuarios"),
        array("titulo"=>"Veh&iacute;culos" ,"url"=>"vehiculos.php","id"=>"usuarios"),
        array("titulo"=>"Colores" ,"url"=>"colores.php","id"=>"usuarios"),
        array("titulo"=>"Marcas" ,"url"=>"marcas.php","id"=>"usuarios"),
);
$img_top="bg-top.jpg";
$usuario="";
?>