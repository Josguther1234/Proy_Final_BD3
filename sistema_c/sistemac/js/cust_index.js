$(document).ready(function()
{
    $("#divFrm").hide();
    $("input").each(function()
    {
        $(this).val("");
    });
    $("#btnLi").click(function()
    {
        $("#divFrm").show("slow");
//        $("#divTtl").hide();
        $("#divBtnLi").hide();
    });
    $("#btnClr").click(function()
    {
        $("input").each(function()
        {
            $(this).val("");
        });
    });
    $("#btnGo").click(function()
    {
        console.log("CLICKED");
        $.post("app/prologin.php",
            {l:$("#txtct").val(),w:$("#txtp").val()},
            function(data)
            {
                if (data.response===1) {
                    console.log("n:  "+data.elno);
                    window.location.replace("./app/mainw.php");
                } else {
                    alert("ERROR!!  No se pudo iniciar Sesión\n"+data.descrip);
                    window.location.reload(false);
                }
            },"json");
    });
});