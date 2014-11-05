<div id="contenidoinicio">
    4000 Ponce de Leon Blvd Miami FL 33146<br/>
    Madrid +34 620 443 798<br/>
    Madrid Fax +34 911 41 34 51<br/>
    Miami +1 305 484 7607<br/>
    Rio de Janeiro +55 21 3521 8210<br/>
    Honk Kong +852 8191 1790<br/>
    info@ameri-cars.es<br/>
    www.ameri-cars.es
</div>
<div id="fcontacto">
    <form id="fcon" name="fcon" method="post" onsubmit="return valida_cpontacto()" action="">
        <div class="confila">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="" />
        </div>
        <div class="confila">
            <label>E-mail:</label>
            <input type="text" name="correo" value="" />
        </div>
        <div class="confila">
            <label>Asunto:</label>
            <input type="text" name="asunto" value="" />
        </div>
        <div class="confila">
            <label>Mensaje:</label>
            <textarea name="mensaje"></textarea>
        </div>
        <div class="consubmit">
            <input type="submit" value="enviar" />
        </div>
    </form>
</div>
<script type="text/javascript">
    window.onload=function(){
        <?php
        if(isset($resultado))
            echo "alert('El mensaje fue enviado con '+String.fromCharCode(233)+'xito.');";
        ?>
    }
    function valida_cpontacto(){
        f=document.fcon;
        valido=true;
        if(f.nombre.value==""){
            valido=false;
            alert("Debe ingresar su nombre.");
            f.nombre.focus();
        }
        else{
            if(f.correo.value.indexOf("@")==-1 || f.correo.value.indexOf(".")==-1){
                valido=false;
                alert("Debe ingresar un e-mail válido.");
                f.correo.focus();
            }
            else{
                if(f.asunto.value==-1){
                    valido=false;
                    alert("Debe ingresar un asunto.");
                    f.asunto.focus();
                }
                else{
                    if(f.mensaje.value==-1){
                        valido=false;
                        alert("Debe ingresar un mensaje.");
                        f.mensaje.focus();
                    }
                }
            }
        }
        return valido;
    };
</script>