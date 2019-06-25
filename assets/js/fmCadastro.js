

    var table = $('#rowselect').DataTable();

    $('#edt').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var table  = button.data('table');
        var idP    = button.data('idp');
        var cp     = button.data('cp');
        var modal  = $(this);
        $.ajax({
            url: base_url + "Dashboard/Cadastro/getFormulario/"+table+"/"+cp+"/"+idP,
            success: function(data){
                modal.find('#form_html').html(data);
            },
            error: function(data){
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

    $('#del').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var table  = button.data('table');
        var cp     = button.data('cp');
        var idp    = button.data('idp');
		var url    = button.data('url');
        var modal  = $(this);
        modal.find("#del_table").val(table);
        modal.find("#del_cp"   ).val(cp);
        modal.find("#del_idp"  ).val(idp);
		modal.find("#del_url"  ).val(url);
    });

    $(document).on("click", "#btnCadSalvar", function(e){
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
                        $("#cad").modal('hide');
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

    $("#btnCadDeletar").on("click", function(e){
		console.log($("#formRemover").attr("action"));
		console.log($("#formRemover").serialize());
        $.ajax({
            type: "POST",
            url: $("#formRemover").attr("action"),
            data: $("#formRemover").serialize(),
            success: function(data){
				console.log(data);
                data = JSON.parse(data);
				$("#del").modal('hide');
                if(data.code == '1'){
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