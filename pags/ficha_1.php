<div id="menufichas">
    <div id="fic1_selected" class="ficha" onclick="cargatab('personales','fic1')"></div>
    <div id="fic2" class="ficha" onclick="cargatab('fotos','fic2')"></div>
</div>
<div id="mostrarsup"></div>
<div id="mostrar">

</div>
<div id="mostrarinf"></div>
<div id="personales">
    <div class="barratitulo" style="background:url(images/cars/p<?=$img[0] ?>) no-repeat left">
        <?=$r->nombremarca." - ".$r->modelo." - ".$r->nombrecolor ?>
    </div>
    <div id="descol1">
        <div class="desfila">
            <div class="deslabel">P.V.P.:</div>
            <div class="destexto">&euro; <?=$r->pvp?></div>
        </div>
        <div class="desfila">
            <div class="deslabel">Cambios:</div>
            <div class="destexto"><?=$r->cajadecambios?> marchas</div>
        </div>
        <div class="desfila">
            <div class="deslabel">Combustible:</div>
            <div class="destexto"><?=$r->combustible?></div>
        </div>
        <div class="desfila">
            <div class="deslabel">Año:</div>
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
            <div class="deslabel">Versión:</div>
            <div class="destexto"><?=$r->version?></div>
        </div>
        <div class="desdetalle">
            <div id="desdetalle1">
                <?=$r->resumen ?>
            </div>
            <div id="linkdetalle">Descripción detallada</div>
            <div id="desdetalle2">
                <?=$r->detalles?>
            </div>
        </div>
    </div>
    <div id="descol3">
        <img src="images/mostrar-imagenes.jpg" border="0" onclick="cargatab('fotos','fic2')" />
    </div>
    <div id="descol2">
        <img src="images/cars/g<?=$img[0] ?>" width="252" height="189" border="0" />
    </div>
</div>
<div id="fotos">
    <div style="background:url(images/cars/p<?=$img[0] ?>) no-repeat left" class="barratitulo">
        <?=$r->nombremarca." - ".$r->modelo ?>
    </div>
    <div class="fotminiaturas">
        <?php
        if(count($img)>0) {
            $maximos='<div style="display:none">'.'<img src="images/cars/g'.implode('" border="0" onclick="cargagrande(this)" /><img src="images/cars/g',$img).'" border="0" onclick="cargagrande(this)" />'.'</div';
            echo '<img src="images/cars/p'.implode('" border="0" onclick="cargagrande(this)" /><img src="images/cars/p',$img).'" border="0" onclick="cargagrande(this)" />';
            echo $maximos;
        }
        ?>
    </div>
    <div class="fotgrande">
        <img src="images/cars/g<?=$img[0] ?>" />
    </div>
</div>
<script type="text/javascript">
    cargatab("personales","fic1");
    $("#linkdetalle").click(function(){
        if($("#linkdetalle").html()=="Descripción detallada"){
            $("#desdetalle2").css({
                "height":"auto",
                "overflow":"visible"
            })
            $("#linkdetalle").html("Descripción reducida")
            $("#linkdetalle").css("background","url(images/colapse.gif) no-repeat")
        }
        else{
            $("#desdetalle2").css({
                "height":1,
                "overflow":"hidden"
            })
            $("#linkdetalle").html("Descripción detallada")
            $("#linkdetalle").css("background","url(images/expand.gif) no-repeat")
        }
    });
    ajustatab();
</script>
