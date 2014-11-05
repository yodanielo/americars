function focusitem(){
    $(this).css("background","#efefef");
}
function unfocusitem(){
    $(this).css("background","#FFFFFF");
}
function cargatab(tab, mlink){
    guardar=$("#mostrar").attr("title");
    if(guardar)
        $("#"+guardar).html($("#mostrar").html());
    $("#mostrar").attr("title",tab);
    $("#mostrar").html($("#"+tab).html());
    if(mlink=="fic1"){
        $("#fic2_selected").attr("id", "fic2");
        $("#fic1").attr("id","fic1_selected");
    }
    else{
        $("#fic1_selected").attr("id", "fic1");
        $("#fic2").attr("id","fic2_selected");
        if($.browser.msie)
            $(".fotgrande").css("margin-right",142)
    }
}
function ajustatab(){
    h1=$("#personales").height();
    h2=$("#fotos").height();
    if(h1>h2)
        h3=h1;
    else
        h3=h2;
    $("#mostrar").height(h3);
    if($.browser.msie){
        $("#mostrar").width(730)
    }
}
function cargagrande(img){
    nuevo=$(img).attr("src");
    nuevo=nuevo.split("images/cars/p").join("images/cars/g");
    $(".fotgrande").css("background","url("+nuevo+") no-repeat top left");
    antiguo=$(".fotgrande img").attr("src");
    $(".fotgrande img").animate({
        "opacity":0
    },400,"linear",function(){
        $(".fotgrande img").attr("src",nuevo);
        $(".fotgrande img").css("opacity",1);
    });
    ajustatab();
}
window.onload=function(){
    $(document).pngFix();
    $(".caritem").hover(focusitem, unfocusitem);
}