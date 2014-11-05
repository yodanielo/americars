<?php
if(!$_GET["opc"])
    $_GET["opc"]="vehiculos";
include("includes/contenido.php")
    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html charset=utf-8" />
        <title><?php echo $config_sitename ?></title>
        <meta name="Description" content="<?php echo $config_MetaDesc ?>" />
        <meta name="Keywords" content="<?php echo $config_MetaKeys ?>" />
        <meta name="author" content="<?php echo $config_author ?>" />
        <meta name="owner" content="<?php echo $config_sitename ?>" />
        <meta name="robots" content="index, follow" />
        <meta HTTP-EQUIV="Expires" CONTENT="Tue, 01 Jan 1980 1:00:00 GMT"/>
        <meta HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE"/>
        <meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache"/>
        <link rel="stylesheet" type="text/css" href="css/nav.css" />
        <!--[if IE ]>
	<link rel="stylesheet" type="text/css" href="css/ie.css" />
        <![endif]-->
        <!--[if lte IE 7]>
	<link rel="stylesheet" type="text/css" href="css/ie7.css" />
        <![endif]-->
        <!--[if lte IE 6]>
	<link rel="stylesheet" type="text/css" href="css/ie6.css" />
        <![endif]-->
        <script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.pngFix.pack.js"></script>
        <script type="text/javascript" src="js/generales.js"></script>
    </head>
    <body>
        <?php
        if(!isset($_GET["opc"]))
            include("pags/inicio.html");
        else
            include("pags/contenido.php");
        ?>
        <?php //echo contenido(); ?>
    </body>
</html>
