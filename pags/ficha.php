<?php/**/?>
<div id="menufichas">
    <div id="fic1_selected" class="ficha" onclick="cargatab('personales','fic1')"></div>
    <div id="fic2" class="ficha" onclick="cargatab('fotos','fic2')"></div>
    <div id="fic3" class="back" onclick="btnvolver()">&lt;&nbsp;<strong style="text-decoration:underline">volver</strong></div>
</div>
<div id="mostrarsup"></div>
<div id="mostrar">

</div>
<div id="mostrarinf"></div>
<div id="personales">
    <div class="barratitulo" style="background:url(images/cars/p<?=$img[0] ?>) no-repeat top left">
        <?=$r->nombremarca." - ".$r->modelo." - ".$r->nombrecolor ?>
    </div>
    <div id="descol1">
        <div class="desfila">
            <div class="deslabel">P.V.P.:</div>
            <div class="destexto"><?=number_format($r->pvp, 2, ",", ".") ?> &euro;</div>
        </div>
        <?php /*<div class="desfila">
            <div class="deslabel">Cambios:</div>
            <div class="destexto"><?=$r->cajadecambios?> marchas</div>
        </div>*/?>
        <div class="desfila">
            <div class="deslabel">Combustible:</div>
            <div class="destexto"><?=$r->combustible?></div>
        </div>
        <div class="desfila">
            <div class="deslabel">A&ntilde;o:</div>
            <div class="destexto"><?=$r->anio?></div>
        </div>
        <div class="desfila">
            <div class="deslabel">Kilometraje:</div>
            <div class="destexto"><?=$r->kilometraje?> Km</div>
        </div>
        <div class="desfila">
            <div class="deslabel">Potencia:</div>
            <div class="destexto"><?=$r->potencia?></div>
        </div>
        <div class="desfila">
            <div class="deslabel">Versi&oacute;n:</div>
            <div class="destexto"><?=$r->version?></div>
        </div>
        <div class="desfila">
            <div class="deslabel">Transmisi&oacute;n:</div>
            <div class="destexto"><?php
                $x=array("Manual"=>"Manual","Automatica"=>"Autom&aacute;tica");
                echo $x[$r->transmision];
                ?></div>
        </div>
        <div class="desdetalle">
            <div class="ficdettitle">CARACTERISTICAS:</div>
            <div id="desdetalle1">
                <?=$r->resumen ?>
            </div>
        </div>
    </div>
    <div id="descol3">
        <img src="images/mostrar-imagenes.jpg" border="0" onclick="cargatab('fotos','fic2')" />
    </div>
    <div id="descol2">
        <img src="images/cars/m<?=$img[0] ?>" width="252" height="189" border="0" />
    </div>
    <?php if(isset($_SESSION["usuarioFE"])) {?>
    <div id="desdetalle2">
        <div class="ficdettitle">CARACTERISTICAS PARA PROFESIONALES DEL AUTOMOVIL:</div>
            <?php echo $r->detalles ?>
    </div>
        <?php } ?>
</div>
<div id="fotos">
    <div style="background:url(images/cars/p<?=$img[0] ?>) no-repeat left top" class="barratitulo">
        <?=$r->nombremarca." - ".$r->modelo ?>
    </div>
    <div class="fotminiaturas">
        <?php
        if(count($img)>0) {
            $maximos='<div style="display:none">'.'<img src="images/cars/g'.implode('" border="0" onclick="cargagrande(this)" /><img src="images/cars/g',$img).'" border="0" onclick="cargagrande(this)" />'.'</div>';
            echo '<img src="images/cars/p'.implode('" border="0" width="61" height="45" onclick="cargagrande(this)" /><img src="images/cars/p',$img).'" border="0" width="61" height="45" onclick="cargagrande(this)" />';
            echo $maximos;
        }
        ?>
    </div>
    <div class="fotgrande">
        <img src="images/cars/g<?=$img[0] ?>"/>
    </div>
</div>
<script type="text/javascript">
    cargatab("fotos","fic2");
    cargatab("personales","fic1");
    ajustatab();
    function btnvolver(){
        ldir="<?=$_SERVER['HTTP_REFERER']?>";
        if(ldir==window.location.href)
            window.location.href=ldir;
        else{
            history.go(-1);
        }
    }
</script>
<?php/**/?>