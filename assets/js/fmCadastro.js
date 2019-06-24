$(document).ready(function () { 

    var table = $('#rowselect').DataTable();

    $('#edt').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var table = button.data('table');
        var idP = button.data('idp');
        var cp = button.data('cp');
        var modal = $(this);
        $.ajax({
            url: base_url + "Dashboard/Cadastro/getFormulario/"+table+"/"+cp+"/"+idP,
            success: function(data){
                modal.find('#form_html').html(data);
            },
            error: function(data){
                console.log("3");
                modal.find('#form_html').html(data);
            }
        });
    });

    $('#cad').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var table = button.data('table');
        var modal = $(this);
        $.ajax({
            url: base_url + "Dashboard/Cadastro/getFormulario/"+table,
            success: function(data){
                modal.find('#form_html').html(data);
            },
            error: function(data){
                modal.find('#form_html').html(data);
            }
        });
    });

    $(document).on("click", "#btnCadSalvar", function(){
        $.ajax({
            type: "POST",
            url: $("#formCadastro").attr("action"),
            data: $("#formCadastro").serialize(),
            success: function(data){
                data = JSON.parse(data);
                if(data.code == '1'){
                    if (data.event == "edt") {
                        $("#edt").modal('hide');
                    } else if (data.event == "cad") {
                        $("#cad").modal(false);
                    }
                    $("#alert-message").text(data.message);
                    $("#alert-modal").modal();
                    setInterval(function(){ $("#alert-modal").modal("hide"); }, 2000);
                } else {
                    $("#alert-message").text(data.message);
                    $("#alert-modal").modal();
                    setInterval(function(){ $("#alert-modal").modal("hide"); }, 2000);
                }
            },
            error: function(data) {
                console.log("erro");
                console.log(data);
                $("#alert-message").text("data.message");
                $("#alert-modal").alert();
                setInterval(function(){ $("#alert-modal").alert("close"); }, 3000);
            }
        });

        //event.preventDefault();
        //return false;
    });

});