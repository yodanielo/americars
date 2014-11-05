<?php
if(count($res)>0) {
    echo '<div id="cuerpolistado">';
    foreach($res as $r) {
        ?>
<div class="caritem">
    <?php $imgs=explode(",",$r->imagenes); ?>
    <div class="carimgmini">
    <img src="images/cars/p<?=$imgs[0]?>" border="0" /><br/>
    <a style="font-size:11px;" href="index.php?opc=ficha&car=<?=$r->id?>">Detalles</a>
    </div>
    <div class="cararriba">
        <div class="carcolarritemazul"><?=number_format($r->pvp, 2, ",", ".") ?> &euro;</div>
        <div class="carcolarritem"><?=$r->kilometraje ?> Km</div>
        <div class="carcolarritem"><?=$r->inserted ?></div>
        <div class="carcolarritem"><?=$r->potencia ?> CV</div>
    </div>
    
    <div class="cartitle">
        <a href="index.php?opc=ficha&car=<?=$r->id ?>"><?=$r->marcanombre." ".$r->modelo." ".$r->version ?></a>
    </div>
    <div class="cardetalles"><p><?=$r->resumen ?></p></div>
</div>
    <hr class="lineaitem" noshade />
        <?php
    }
    echo '</div>';
    if($numpags>1){
        echo '<div id="carpags">';
        if($pag<$numpags){
            echo '<a class="flechas" id="ultimo" href="'.$ira.'&pag='.$numpags.'"></a>';
            echo '<a class="flechas" id="adelante" href="'.$ira.'&pag='.($pag+1).'"></a>';
        }
        for($i=$numpags;$i>=1;$i--){
            if($pag==$i)
                echo '<strong>'.$i.'</strong>';
            else
                echo '<a href="'.$ira.'&pag='.$i.'">'.$i.'</a>';
        }
        if($pag>1){
            echo '<a class="flechas" id="atras" href="'.$ira.'&pag='.($pag-1).'"></a>';
            echo '<a class="flechas" id="primero" href="'.$ira.'&pag=1"></a>';
        }
        echo '</div>';
        ?>
    <div style="display:none">
    <img src="images/primero_1.gif">
    <img src="images/atras_1.gif">
    <img src="images/ultimo_1.gif">
    <img src="images/adelante_1.gif">
    </div>
        <?php
    }
}else{
    if(isset($_GET["marca"])){
        ?>
        <div class="nohaycarros">No hay veh&iacute;culos para mostrar.</div>
        <div id="cuerpolistado1" style="background:none">&nbsp;</div>
        <?php
    }
}
?>
