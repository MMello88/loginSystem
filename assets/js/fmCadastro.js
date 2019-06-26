

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
                    var fields = $("#formCadastro").serializeArray();
                    var html = "";
                    $.each( fields, function( i, field ) {
                        if (field.name == '_url')
                            html += '<tr data-url='+field.name+'>';
                        //alert(field.name + " > " + field.value);
                    });
                    $.each( fields, function( i, field ) {
                        html += '<td contenteditable id="data1"></td>';
                        html += '<td contenteditable id="data2"></td>';
                        html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
                        html += "<td><div class='btn-group'><button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Action</button><div class='dropdown-menu'><a class='dropdown-item' href='#' data-toggle='modal' data-target='#edt' data-table='{$arr_primary['id_tabela']}' data-cp='{$arr_primary['campo']}' data-idp='{$arr_primary['valor']}'>Editar</a><a class='dropdown-item' href='#' data-toggle='modal' data-target='#del' data-url='{$arr_primary['url']}' data-table='{$arr_primary['id_tabela']}' data-cp='{$arr_primary['campo']}' data-idp='{$arr_primary['valor']}'>Remover</a><div class='dropdown-divider'></div><a class='dropdown-item' href='#'>Registro Filho</a></div></div></td>";
                    });
                    html += '</tr>';

                    $('#rowselect tbody').prepend(html);
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