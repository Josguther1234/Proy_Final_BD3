function validsession(fullexit)
{
    $.getJSON("../app/session.php",function(data){
        if (data === 0){ $.get("../app/prologout.php",function(){ window.top.location.href = '../index.php'; });
        } else {
            if (fullexit===0){ $("#nombreusuario").html("Usuario Activo:  "+data.nom);
            } else {
                window.top.location.href= "../index.php";
            } 
        }
    });
}
function prepareButtons(how)
{
    how===1?$("#btnSave").hide():$("#btnSave").show();
    how===1?$("#btnCancel").hide():$("#btnCancel").show();
    how===1?$("#btnDel").hide():$("#btnDel").show();
    how===1?$("#btnAdd").show():$("#btnAdd").hide();
}
function refreshData()
{
    $.get("../app/proconfig_usr.php", {a:0}, function(data) { $("#tabData tbody").html(data); });
}
function clearForm()
{
    $(':input').val(""); 
    refreshData();
    $("#divData").show();
    $("#divFrm").hide();
    $("#divFrmPwd").hide();
    $("#divAdditional").hide();
    prepareButtons(1);
}
function addRow()
{
    $.post(
        "../app/proconfig_usr.php",
        {
            a:1,acct:$("#txtCta").val(),fnm:$("#txtNom").val(),role:$("#txtRol").val()
        },
        function(data)
        {
            if (data.resp==1) {
                clearForm();
            } else {
                alert("ERROR: No se pudo Grabar el registro.\n"+data.reason);
            }
        }, "json"
    );    
}
function modRow()
{
    $.post(
        "../app/proconfig_usr.php",
        {
            a:2,idu:$("#txtID").val(),nom:$("#txtNom").val(),tip:$("#txtRol").val()
        },
        function(data)
        {
            if (data.resp==1) {
                clearForm();
            } else {
                alert("ERROR: No se pudo Grabar el registro.\n"+data.reason);
            }
        }, "json"
    );    
}
function delRow()
{
    $.post(
        "../app/proconfig_usr.php",
        { a:3,ids:$("#txtID").val() },
        function(data)
        {
            if (data.resp==1) {
                clearForm();
            } else {
                alert("ERROR: No se pudo Eliminar el registro.\n"+data.reason);
            }
        }, "json"
    );    
}
$(document).ready(function()
{
    validsession(0);
    prepareButtons(1);
    clearForm();
//    refreshData();
    document.addEventListener('keydown',function(e)
    {
        if (e.altKey == true) {
            switch (e.keyCode){
                case 65: /*A*/ if ($("#txtAct").val()!=="1") $("#btnAdd").click(); break;
                case 71: /*G*/ if ($("#txtAct").val()!=="") $("#btnSave").click(); break;
                case 77: /*M*/ if ($("#txtAct").val()!=="") $("#btnDel").click(); break;
                case 76: /*L*/ $("#btnList").click(); break;
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
        validsession(0); clearForm(); prepareButtons(0);
        $("#divData").hide(); 
        $("#divFrm").show(); 
        $("#txtAct").val("1");
        $("#txtID").focus();
    });
    $("#btnSave").on("click",function()
    { 
        if ($("#txtAct").val()==="1") { 
            $("#divFrmPwd").show();
//            addRow(); 
        } else { 
            modRow(); 
        } 
        $("#txtAct").val(""); 
    });
    $("#btnCancel").on("click",function()
    { 
        clearForm();  
        prepareButtons(1); 
        $("#txtAct").val(""); 
    });
    $("#btnDel").on("click",function()
    { 
        delRow(); 
        $("#txtAct").val(""); 
    });
    $("#btnList").on("click",function()
    {

    });
    $("#btnQuit").on("click",function()
    { parent.clearContents(); });
    $("#btnPwd").on("click",function()
    {
        $("#divFrmPwd").show();
        $("#txtPwd").focus();
    });
    $("#btnPwdOk").on("click",function()
    {
        var isok = 0;
        if ($("#txtPwd").val().length>3) {
            if ($("#txtPwd").val()===$("#txtConf").val()) {
                isok = 1;
            } else {
                alert("Clave y Confirmación no son iguales !!");
                $("#txtPwd").val("");
                $("#txtConf").val("");
                $("#txtConf").focus();
                isok = 0;
            }
        } else {
            alert("Clave demasiado corta ... al menos debe tener 3 caracteres!!");
            $("#txtPwd").val("");
            $("#txtConf").val("");
            $("#txtPwd").focus();
            isok = 0;
        }
        if (isok === 1) {
            if ($("#txtAct").val()==="1") {
                addRow();
            } else {
                $.post("../app/proconfig_usr.php",
                    {a:7, idu: $("#txtID").val(), w:$("#txtPwd").val()},
                    function(data)
                    {
                        if (data.resp !== "1") {
                            alert("ERROR: No se pudo actualizar !!\n"+data.reason);
                        } else {
                            $("#btnPwdOut").click();
                        }
                    },"json"
                );
            }
        }
    });
    $("#btnPwdOut").on("click",function()
    {
        $("#txtPwd").val(""); 
        $("#txtConf").val(""); 
        $("#divFrmPwd").hide();
    });
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
    $("#txtCta").keyup(function(event)
    { 
        event.preventDefault(); 
        if (event.keyCode===13) $("#txtNom").focus(); 
    });
    $("#txtNom").keyup(function(event)
    {   
        event.preventDefault(); 
        if (event.keyCode===13) $("#txtDir").focus(); 
    });
});
$(document).on("click",".datarow",function(e)
{
    validsession(0);
    $("#txtAct").val("2");    
    $("#txtID").val($(this).find(".idu").html());
    $("#txtCta").val($(this).find(".cta").html());
    $("#txtNom").val($(this).find(".nom").html());
    $("#txtRol").val($(this).data("tip"));
    $("#divFrm").show(250);
    $("#divData").hide(250);
    prepareButtons(0);
    $("#divAdditional").show();
});