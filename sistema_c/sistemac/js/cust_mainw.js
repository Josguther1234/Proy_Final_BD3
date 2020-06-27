function validsession(fullexit){
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
function clearContents()
{
    $("#insideContent").attr("src","");
    $("#insideContent").hide();
    $("#imgbg").show();
}
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });
    $(".destiny").on('click',function()
    {
        if ($(this).data('dst')==='logout') {
            $.post("../app/prologout.php");
            document.location.replace('../index.php');
        } else {
            $("#insideContent").attr("src","../app/frm"+$(this).data("dst")+".html");
            $("#imgbg").hide("fast");
            $("#insideContent").show();
        }
    });
    validsession(0);
    clearContents();
});