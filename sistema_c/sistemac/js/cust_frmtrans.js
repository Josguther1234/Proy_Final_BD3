function validsession(fullexit)
{
    $.getJSON("../app/session.php",function(data){
        if (data === 0){ $.get("../app/prologout.php",function(){ window.top.location.href = '../index.php'; });
        } else {
            if (fullexit===0){ $("#nombreusuario").html("Usuario Activo:  "+data.nom); $("#txtID").val(data.idu);
            } else {
                window.top.location.href= "../index.php";
            } 
        }
    });
}
function clearForm()
{
    $(':input').val(""); 
    $("#divFrm").hide();
}
$(document).ready(function()
{
    validsession(0);
    clearForm();
//    refreshData();
    document.addEventListener('keydown',function(e)
    {
        if (e.altKey == true) {
            switch (e.keyCode){
                case 66: /*B*/ $("#btnQry").click(); break;
                case 80: /*P*/ $("#btnPay").click(); break;
                case 65: /*A*/ $("#btnAdd").click(); break;
                case 81: /*Q*/ $("#btnQuit").click(); break;
            } 
        } else {
            if (e.keyCode == 27) {
                if ($("#txtAct").val()!=="") $("#btnCancel").click();
            }
        }
    });
    $("#btnAdd").on("click",function()
    {
        validsession(0); clearForm();
        $("#divFrm").show(); 
        $("#txtAct").val("1");
        $("#txtDPI").focus();
    });
    $("#btnQry").on("click",function()
    { 
        validsession(0); clearForm();
        $("#divFrm").show();         
        $("#txtAct").val("0"); 
        $("#txtDPI").focus();
    });
    $("#btnPay").on("click",function()
    { 
        validsession(0); clearForm();
        $("#divFrm").show();         
        $("#txtAct").val("2"); 
        $("#txtDPI").focus();
    });
    $("#btnQuit").on("click",function()
    { parent.clearContents(); });
    $("input").focus(function()
    {  
        $(this).addClass("focusedinput"); 
        $(this).select(); 
    });
    $("input").focusout(function()
    { 
        $(this).removeClass("focusedinput"); 
    });
    $("input.txtimp").focusout(function()
    {   
        var tmptxt = $(this).val().toUpperCase(); 
        if (!$(this).hasClass("excp")) $(this).val(tmptxt); 
    });
    $("#txtDPI").keyup(function(event)
    { 
        event.preventDefault(); 
        if (event.keyCode===13) {
            if ($("#txtAct").val()=="2") {
                $.post("../wsservice.php",{a:$("#txtAct").val(), dpi:$("#txtDPI").val(), u:$("#txtID").val()},
                       function(data){  $("#txtStatus").val(data); }
                );
            } else {
                $.post("../wsservice.php",{a:$("#txtAct").val(), dpi:$("#txtDPI").val()},
                       function(data){  $("#txtStatus").val(data); }
                );
            }
        }
    });
});