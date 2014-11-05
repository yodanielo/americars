<?php
ini_set('session.use_trans_sid', 0);
ini_set('session.use_cookies', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.gc_maxlifetime', 172800);
session_cache_limiter('private,must-revalidate');
session_start();
header("Cache-control: private");

if(mosgetparam($_POST,"content","")=="")
    $path="./";
else
    $path="../";
include ($path.'config.php');
$protects = array('_REQUEST', '_GET', '_POST', '_COOKIE', '_FILES', '_SERVER', '_ENV', 'GLOBALS', '_SESSION');
foreach ($protects as $protect) {
    if ( in_array($protect , array_keys($_REQUEST)) ||
            in_array($protect , array_keys($_GET)) ||
            in_array($protect , array_keys($_POST)) ||
            in_array($protect , array_keys($_COOKIE)) ||
            in_array($protect , array_keys($_FILES))) {
        die("Invalid Request.");
    }
}

/**
 * used to leave the input element without trim it
 */
define( "_MOS_NOTRIM", 0x0001 );
/**
 * used to leave the input element with all HTML tags
 */
define( "_MOS_ALLOWHTML", 0x0002 );
/**
 * used to leave the input element without convert it to numeric
 */
define( "_MOS_ALLOWRAW", 0x0004 );
/**
 * used to leave the input element without slashes
 */
define( "_MOS_NOMAGIC", 0x0008 );

function mosgetparam( &$arr, $name, $def=null, $mask=0 ) {
    if (isset( $arr[$name] )) {
        if (is_array($arr[$name])) foreach ($arr[$name] as $key=>$element) $result[$key] = mosGetParam ($arr[$name], $key, $def, $mask);
        else {
            $result = $arr[$name];
            if (!($mask&_MOS_NOTRIM)) $result = trim($result);
            if (!is_numeric( $result)) {
                if (!($mask&_MOS_ALLOWHTML)) $result = strip_tags($result);
                if (!($mask&_MOS_ALLOWRAW)) {
                    if (is_numeric($def)) $result = intval($result);
                }
            }
            if (!get_magic_quotes_gpc()) {
                $result = addslashes( $result );
            }
        }
        return $result;
    } else {
        return $def;
    }
}
require_once ($path.'includes/database.php');
require_once ($path.'includes/helpers.php');

$db=new database($config_host,$config_user,$config_password,$config_db,$config_dbprefix);
?>

<?php
/**
 * el que inicializa el ajax
 */
if($_POST["content"]) {
    $funcionesprimarias=array();
    if(in_array(mosgetparam($_POST,"content","noexiste"),$funcionesprimarias)) {
        $funcion=mosgetparam($_POST,"content","noexiste");
        if(function_exists($funcion)) {
            echo $funcion();
        }
    }
}
/**
 * funciones de contenido
 */
function contenido() {
    $funciones=array("inicio","vehiculos","busqueda_avanzada","ficha","contacto","login");
    if(in_array(mosgetparam($_GET,"opc","vehiculos"),$funciones)) {
        if(function_exists(mosgetparam($_GET,"opc","vehiculos"))) {
            $funcion=mosgetparam($_GET,"opc","vehiculos");
            echo $funcion();
        }
        else {
            echo "El contenido no est&aacute; disponible";
        }
    }
    else {
        echo "El contenido que desea no existe";
    }
}
?>
<?php
function vehiculos() {
    global $db;
    $sql="select a.id, a.imagenes, a.marca, a.modelo, a.version, a.precio, a.kilometraje, a.matriculacion as inserted, a.potencia, a.potenciakw, a.detalles, a.resumen, a.pvp,a.pve, ame_marcas.marca as marcanombre,tipodecoche from ame_vehiculos as a inner join ame_marcas on a.marca=ame_marcas.id where a.estado=1 order by pve";
    $pag=mosgetparam($_GET, "pag","1");
    $numpags=0;
    $res=sacar_paginacion($db, $sql, 10,$pag , $numpags);
    $ira="index.php?opc=vehiculos";
    include("pags/listado.php");
}
function busqueda_avanzada() {
    global $db;
    //saco colores
    $sql="select id,nombre from ame_colores order by nombre";
    $db->setQuery($sql);
    $colores=$db->loadObjectList();
    //saco marcas
    $sql="select id,marca from ame_marcas order by marca";
    $db->setQuery($sql);
    $marcas=$db->loadObjectList();
    //saco maximo pvp
    $sql="select max(pvp) from ame_vehiculos";
    $db->setQuery($sql);
    $maxpvp=$db->loadResult();
    //saco maximo potencia
    $sql="select max(potencia) from ame_vehiculos";
    $db->setQuery($sql);
    $maxpotencia=$db->loadResult();
    //proceso la busqueda
    $sql="select ame_vehiculos.id, imagenes, ame_vehiculos.marca, modelo, version, precio, kilometraje, ame_vehiculos.matriculacion as inserted, potencia, potenciakw, detalles, resumen, pvp,pve,ame_marcas.marca as marcanombre,tipodecoche from ame_vehiculos inner join ame_marcas on ame_vehiculos.marca=ame_marcas.id where ame_vehiculos.estado=1";
    if(mosgetparam($_GET,"marca","")!="") $sql.=" and ame_vehiculos.marca='".mosgetparam($_GET,"marca","")."'";
    if(mosgetparam($_GET,"version","")!="") $sql.=" and version like '%".mosgetparam($_GET,"version","")."%'";
    if(mosgetparam($_GET,"modelo","")!="") $sql.=" and modelo like '%".mosgetparam($_GET,"modelo","")."%'";
    if(mosgetparam($_GET,"combustible","")!="") $sql.=" and combustible='".mosgetparam($_GET,"combustible","")."'";
    if(mosgetparam($_GET,"transmision","")!="")$sql.=" and transmision like '".mosgetparam($_GET,"transmision","%")."'";
    /*año*/$sql.=" and anio between ".mosgetparam($_GET,"anio1",date('Y'))." and ".mosgetparam($_GET,"anio2",'Y');
    /*kilometraje*/$sql.=" and kilometraje between ".mosgetparam($_GET,"kilometraje1","0")." and ".mosgetparam($_GET,"kilometraje2","3000");
    /*potencia*/$sql.=" and potencia between ".mosgetparam($_GET,"potencia1","0")." and ".mosgetparam($_GET,"potencia2","350");
    /*pvp*/$sql.=" and pvp between ".mosgetparam($_GET,"pvp1","0")." and ".mosgetparam($_GET,"pvp2","5000");
    /*color*/if(count(mosgetparam($_GET,"color"))>0 && implode(",",mosgetparam($_GET,"color"))!="") $sql.=" and colorexterior in (".implode(",",mosgetparam($_GET,"color")).")";
    $pag=mosgetparam($_GET,"pag","1");
    $numpags=0;
    $sql.=" order by pve";
    $res=sacar_paginacion($db,$sql,10,$pag,$numpags);
    $ira="index.php?";
    if(count($_GET)>0)
        foreach($_GET as $k=>$g) {
            if($k!="pag") {
                if($k!="color")
                    $ira.="&".$k."=".$g;
                else
                    $ira.="&color[]=".implode("&color[]=",$g);
            }
        }
    include("pags/busqueda_avanzada.php");
    if(count($res)>0 || !$res) {
        echo '<div id="cuerpolistado1" style="background:none">&nbsp;</div>';
    }
    include("pags/listado.php");
}
function ficha() {
    global $db;
    $sql="select ame_vehiculos.*,ame_marcas.marca as nombremarca, ame_colores.nombre as nombrecolor from ame_vehiculos inner join ame_colores on ame_vehiculos.colorexterior=ame_colores.id inner join ame_marcas on ame_vehiculos.marca=ame_marcas.id where ame_vehiculos.id=".mosgetparam($_GET,"car","");
    $db->setQuery($sql);
    $res=$db->loadObjectList();
    if(count($res)==1) {
        $r=$res[0];
        $img=explode(",",$res[0]->imagenes);
    }
    include("pags/ficha.php");
}
function contacto() {
    global $db;
    if($_POST["correo"]) {
        $a_email="prueba09@edmultimedia.net";
        $eol="\r\n";
        $now = mktime().".".md5(rand(1000,9999));
        $headers = "From:".$a_email.$eol."To:".$a_email.$eol;
        $headers .= 'Return-Path: '.$a_email.'<'.$a_email.'>'.$eol;
        $headers .= "Message-ID: <".$now." TheSystem@".$_SERVER['SERVER_NAME'].">".$eol;
        $headers .= "X-Mailer: PHP v".phpversion().$eol;
        $headers .= "Content-Type: text/html; charset=iso-8859-1".$eol;
        $mensaje = "";
        $mensaje .= '<table align="left">'.$eol;
        $mensaje .= '	<tr><td align="left" colspan="2">'.utf8_decode(mosgetparam($_POST,"nombre","")).' desea comunicarse con usted</td></tr>'.$eol;
        $mensaje .= '	<tr><th align="left">Nombre:</th><td>'.utf8_decode(mosgetparam($_POST,"nombre","")).'</td></tr>'.$eol;
        $mensaje .= '	<tr><th align="left">Correo electr&oacute;nico:</th><td align="left">'.utf8_decode(mosgetparam($_POST,"correo","")).'</td></tr>'.$eol;
        $mensaje .= '	<tr><th align="left">Asunto:</th><td align="left">'.utf8_decode(mosgetparam($_POST,"asunto","")).'</td></tr>'.$eol;
        $mensaje .= '	<tr><th align="left">Mensaje:</th><td align="left">'.utf8_decode(mosgetparam($_POST,"mensaje","")).'</td></tr>'.$eol;
        $mensaje .= '</table>'.$eol;
        $resultado=mail($a_email, "CONTACTO", $mensaje, $headers);
        //echo $resultado;
    }
    include("pags/contacto.php");
}
function login() {
    global $db;
    if($_GET["logout"])
        unset($_SESSION["usuarioFE"]);
    if($_POST["usuario"]) {
        $sql="select * from ame_registro where usuario='".mosgetparam($_POST, "usuario")."' and password=md5('".mosgetparam($_POST, "password")."') and estado=1";
        $db->setQuery($sql);
        $res=$db->loadObjectList();
        if(count($res)==1) {
            foreach($res as $r) {
                $_SESSION["usuarioFE"]=array(
                        'id'=>$r->id,
                        'nomusuario'=>$r->usuario
                );
            }
        }
    }
}
?>
