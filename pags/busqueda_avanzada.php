<form action="index.php" name="frmavanzada">
    <div class="bustitle">
        B&uacute;squeda Avanzada
    </div>
    <div class="buscampo1">
        <label for="marca">Marca (ej.:AUDI)</label>
        <select class="select3" name="marca">
            <?php
            echo '<option value="">Cualquiera</option>';
            foreach ($marcas as $m) {
                if($m->id==$_GET["marca"])
                    echo '<option selected=selected value="'.$m->id.'">'.$m->marca.'</option>'."\n";
                else
                    echo '<option value="'.$m->id.'">'.$m->marca.'</option>'."\n";
            }
            ?>
        </select>
    </div>
    <div class="buscampo2">
        <label for="modelo">Modelo (ej.:A5)</label>
        <input class="select3" type="text" name="modelo" id="modelo" value="<?=mosgetparam($_GET,"modelo","") ?>"/>
    </div>
    <div class="buscampo3">
        <label for="version">Versi&oacute;n (ej.:Sportback)</label>
        <input class="select3" type="text" name="version" id="version" value="<?=mosgetparam($_GET,"version","") ?>"/>
    </div>
    <div class="buscampo1">
        <label for="combustible">Combustible </label>
        <select class="select3" name="combustible">
            <?php
            $a='';
            $a.='<option value="">Cualquiera</option>';
            $a.='<option value="Diesel">Diesel</option>';
            $a.='<option value="Gasolina">Gasolina</option>';
            $a.='<option value="H&iacute;brido">H&iacute;brido</option>';
            echo str_replace('value="'.mosgetparam($_GET,"combustible","").'"','selected=selected value="'.mosgetparam($_GET,"combustible","").'"',$a);
            ?>
        </select>
    </div>
    <div class="buscampo2">
        <label >A&ntilde;o</label>
        <?php
        $a='';
        $b='';
        $anio=(int)date("Y");
        $j=$anio;
        for($i=1950;$i<$anio;$i++,$j--) {
            $b.='<option value="'.$j.'">'.$j.'</option>';
            $a.='<option value="'.$i.'">'.$i.'</option>';
            //$j--;
        }
        ?>
        <select class="select1" name="anio1" id="anio1">
            <?php echo str_replace('value="'.mosgetparam($_GET,"anio1","950"),'selected=selected value="'.mosgetparam($_GET,"anio1","950"),$a); ?>
        </select>
        <select class="select2" name="anio2" id="anio2">
            <?php echo str_replace('value="'.mosgetparam($_GET,"anio2",$anio),'selected=selected value="'.mosgetparam($_GET,"anio2",$anio),$b); ?>
        </select>
    </div>
    <div class="buscampo3">
        <label >Kilometraje</label>
        <?php
        $a='';
        $b='';
        $j=109999;
        $b.='<option value="200001">200001</option>';
        $b.='<option value="150000">150001</option>';
        $b.='<option value="125001">125001</option>';
        for($i=0;$i<=100000;$i+=10000,$j-=10000) {
            $a.='<option value="'.$i.'">'.$i.'</option>';
            $b.='<option value="'.$j.'">'.$j.'</option>';
        }
        $a.='<option value="125000">125000</option>';
        $a.='<option value="150000">150000</option>';
        $a.='<option value="200001">200000</option>';
        ?>
        <select class="select1" name="kilometraje1" id="kilometraje1">
            <?php echo str_replace('value="'.mosgetparam($_GET,"kilometraje1","0"),'selected=selected value="'.mosgetparam($_GET,"kilometraje1","0"),$a); ?>
        </select>
        <select class="select2" name="kilometraje2" id="kilometraje2">
            <?php echo str_replace('value="'.mosgetparam($_GET,"kilometraje2","20999"),'selected=selected value="'.mosgetparam($_GET,"kilometraje2","20999"),$b); ?>
        </select>
    </div>
    <div class="buscampo1">
        <label >Potencia</label>
        <?php
        $a='';
        for($i=0;$i<=350;$i+=50) {
            $a.='<option value="'.$i.'">'.$i.' CV</option>';
        }
        if($maxpotencia>350) {
            $a.='<option value="'.$maxpotencia.'">'.$maxpotencia.' CV</option>';
            $b.='<option value="'.($maxpotencia+1).'">'.($maxpotencia+1).' CV</option>';
        }
        else {
            $maxpotencia=350;
        }
        ?>
        <select class="select1" name="potencia1">
            <?php echo str_replace('value="'.mosgetparam($_GET,"potencia1","0"),'selected=selected value="'.mosgetparam($_GET,"potencia1","0"),$a); ?>
        </select>
        <select class="select2" name="potencia2">
            <?php echo str_replace('value="'.mosgetparam($_GET,"potencia2",$maxpotencia),'selected=selected value="'.mosgetparam($_GET,"potencia2",$maxpotencia),$a); ?>
        </select>

    </div>
    <div class="buscampo2">
        <label for="Cambios">Transmisi&oacute;n</label>
        <select class="select3" name="transmision">
            <?php
            $a='<option value="">Cualquiera</option>
            <option value="Automatica">Automático</option>
            <option value="Manual">Manual</option>';
            echo str_replace('value="'.mosgetparam($_GET,"transmision","").'"','selected=selected value="'.mosgetparam($_GET,"transmision","").'"',$a);
            ?>
        </select>
    </div>
    <div class="buscampo3">
        <label for="">P.V.P.</label>
        <?php
        $a='';
        $b='';
        $j=499;
        for($i=0;$i<=4500;$i+=500,$j+=500) {
            $a.='<option value="'.$i.'">'.$i.' &euro;</option>';
            $b.='<option value="'.$j.'">'.$j.' &euro;</option>';
        }
        if($maxpvp>4999) {
            $a.='<option value="'.$maxpvp.'">'.$maxpvp.' &euro;</option>';
            $b.='<option value="'.($maxpvp+1).'">'.($maxpvp+1).' &euro;</option>';
        }
        else {
            $maxpvp=4998;
        }
        ?>
        <select class="select1" name="pvp1">
            <?php echo str_replace('value="'.mosgetparam($_GET,"pvp1","0"),'selected=selected value="'.mosgetparam($_GET,"pvp1","0"),$a); ?>
        </select>
        <select class="select2" name="pvp2">
            <?php echo str_replace('value="'.mosgetparam($_GET,"pvp2",(string)($maxpvp+1)),'selected=selected value="'.mosgetparam($_GET,"pvp2",(string)($maxpvp+1)),$b); ?>
        </select>
    </div>
    <div class="bussubtitle">Color y Caracter&iacute;sticas Exteriores</div>
    <div id="colores">
        <?php
        $cad="";
        if(count($_GET["color"])>0)
            $cad.= '<div class="color"><label><input class="tcolores1" type="checkbox" name="color[]" value="" />&nbsp;Cualquiera</label></div>'."\n";
        else
            $cad.= '<div class="color"><label><input class="tcolores1" checked=checked type="checkbox" name="color[]" value="" />&nbsp;Cualquiera</label></div>'."\n";
        foreach($colores as $color) {
            if(count($_GET["color"])>0) {
                if(in_array($color->id, $_GET["color"])) {
                    $cad.= '<div class="color"><label><input class="tcolores" checked=checked type="checkbox" name="color[]" value="'.$color->id.'" />&nbsp;'.$color->nombre.'</label></div>'."\n";
                }
                else
                    $cad.= '<div class="color"><label><input class="tcolores" type="checkbox" name="color[]" value="'.$color->id.'" />&nbsp;'.$color->nombre.'</label></div>'."\n";
            }
            else {
                $cad.= '<div class="color"><label><input class="tcolores" type="checkbox" name="color[]" value="'.$color->id.'" />&nbsp;'.$color->nombre.'</label></div>'."\n";
            }
        }
        echo $cad;
        ?>
    </div>
    <div class="bussubmit">
        <input type="image" src="images/busqueda-avanzada.jpg" />
    </div>
    <input type="hidden" name="opc" value="busqueda_avanzada" />
</form>
<script type="text/javascript">
    $(".tcolores").change(function(){
        hay=false;
        $(".tcolores").each(function(){
            if($(this).attr("checked")==true)
                hay=true;
        });
        if(hay==true)
            $(".tcolores1").attr("checked","");
        else
            $(".tcolores1").attr("checked","checked");
    });
    $(".tcolores").change();
    $(".tcolores1").change(function(){
        hay=$(this).attr("checked");
        if(hay==true)
            $(".tcolores").attr("checked","");
        else
            $(".tcolores").attr("checked","checked");
    });
    $("[name*='potencia1'],[name*='potencia2'],[name*='pvp1'],[name*='pvp2']").change(function(){
        nombre=$(this).attr("name");
        nombre=nombre.substr(0,nombre.length-1);
        if(parseInt($("[name*='"+nombre+"2']").attr("value"))<parseInt($("[name*='"+nombre+"1']").attr("value"))){
            $("[name*='"+nombre+"2']").attr("selectedIndex",$("[name*='"+nombre+"1']").attr("selectedIndex"));
        }
    });
    $("[name*='anio1'],[name*='anio2'],[name*='kilometraje1'],[name*='kilometraje2']").change(function(){
        nombre=$(this).attr("name");
        nombre=nombre.substr(0,nombre.length-1);
        if(parseInt($("[name*='"+nombre+"2']").attr("value"))<parseInt($("[name*='"+nombre+"1']").attr("value"))){
            $("[name*='"+nombre+"2']").attr("selectedIndex",$("[name*='"+nombre+"1']").attr("length")-1-$("[name*='"+nombre+"1']").attr("selectedIndex"));
        }
    });
</script>