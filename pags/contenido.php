<div id="paginainicio">
    <script type="text/javascript">
        $("#paginainicio").css("background","url(images/img_"+(Math.ceil(Math.random()*2)+1)+".jpg) no-repeat");
    </script>
    <div id="menuprincipalinicio">
        <a href="index.php?opc=vehiculos" id="vehiculos<?php if($_GET["opc"]=="vehiculos") echo '_selected' ?>" ></a>
        <a href="index.php?opc=busqueda_avanzada" id="busqueda_avanzada<?php if($_GET["opc"]=="busqueda_avanzada") echo '_selected' ?>" ></a>
        <a href="index.php?opc=contacto" id="contacto<?php if($_GET["opc"]=="contacto") echo '_selected' ?>" ></a>
    </div>
    <div id="cuerpo">
        <?php
        login();
        $cadhidden="";
        if(count($_GET)>0){
            foreach($_GET as $k=>$g){
                $cadhidden.=$k.'='.$g."&";
            }
            $cadhidden=str_replace("logout","l",$cadhidden);
        }
        if(isset($_SESSION["usuarioFE"])) {
        ?>
        <div id="cuadrologin2">
            USUARIO:&nbsp;<?=$_SESSION["usuarioFE"]["nomusuario"] ?>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
            <a id="lcerrarcesion" href="index.php?logout=1&opc=<?=$_GET["opc"]?>">Cerrar Sesi&oacute;n</a>&nbsp;&nbsp;
            <script type="text/javascript">
                h=window.location.href;
                if(window.location.href.indexOf("?")>-1)
                    $("#lcerrarcesion").attr("href",window.location.href+"&logout=1");
                else
                    $("#lcerrarcesion").attr("href",window.location.href+"?logout=1")
            </script>
        </div>
            <?php } else { ?>
        <div id="cuadrologin">
            <form name="login" action="index.php" method="post">
                <label for="usuario">Usuario:&nbsp;</label>
                <input type="text" name="usuario" value=""/>&nbsp;
                <label for="password">Password:&nbsp;</label>
                <input type="password" name="password" value=""/>
                <input type="submit" class="loginsubmit" value="Iniciar Sesi&oacute;n"/>
            </form>
            <script type="text/javascript">
                h=window.location.href.split("&logout=1").join("&logout=1").split("?logout=1").join("?");
                if(window.location.href.indexOf("?")>-1)
                    document.login.action=h;
                else
                    document.login.action=h;
            </script>
        </div>
            <?php } ?>
        <?php
        echo contenido();
        ?>
    </div>
    <div id="footer">
        <div class="foocoltodo">
            4000 Ponce de Le&oacute;n Blvd Miami FL 33146
        </div>
        <div id="foocol1">
            Miami<br/>
            Ph +1 305 484 7607
        </div>
        <div id="foocol2">
            Madrid<br/>
            Tel +34 620 443 798<br/>
            Fax +34 911 41 34 51
        </div>
        <div id="foocol3">
            Rio de Janeiro<br/>
            Tel +55 21 3521 8210
        </div>
        <div id="foocol4">
            Honk Kong<br/>
            Ph +852 8191 1790
        </div>
        <div class="foocoltodo">
            info@ameri-cars.es - www.ameri-cars.es
        </div>
    </div>
    <script type="text/javascript">
        $("#paginainicio").css("margin-left",($(document).width()-$("#paginainicio").width())/2);
    </script>

</div>

