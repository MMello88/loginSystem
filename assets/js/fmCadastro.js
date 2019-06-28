    var datatable = $('#rowselect').DataTable();

    $('#cad').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
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

    $('#edt').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
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

    $('#del').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var cp     = button.data('cp');
        var idp    = button.data('idp');
        var modal  = $(this);
        modal.find("#del_cp"   ).val(cp);
        modal.find("#del_idp"  ).val(idp);
    });

    $(document).on("click", "#btnCadSalvar", function(e){
        $.ajax({
            type: "POST",
            url: $("#formCadastro").attr("action"),
            data: $("#formCadastro").serialize(),
            success: function(data){
                data = JSON.parse(data);
                if(data.code == '1'){
                    var fields = $("#formCadastro").serializeArray();
                    var html = "";

                    if (data.event == "edt") {
                        $("#edt").modal('hide');


                    } else if (data.event == "cad") {
                        $("#cad").modal('hide');

                        html += "<tr>";
                        $.each( fields, function( i, field ) {
                            html += "<td data-campo="+i+">"+field+"</td>";
                        });
                            html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
                            html += "<td>";
                            html += "    <div class='btn-group'>";
                            html += "       <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Action</button>";
                            html += "       <div class='dropdown-menu'>";
                            html += "           <a class='dropdown-item' href='#' data-toggle='modal' data-target='#edt' data-cp='{$arr_primary['campo']}' data-idp='{$arr_primary['valor']}'>Editar</a>";
                            html += "           <a class='dropdown-item' href='#' data-toggle='modal' data-target='#del' data-cp='{$arr_primary['campo']}' data-idp='{$arr_primary['valor']}'>Remover</a>";
                            html += "           <div class='dropdown-divider'></div>";
                            html += "           <a class='dropdown-item' href='#'>Registro Filho</a>";
                            html += "       </div>";
                            html += "   </div>";
                            html += "</td>";
                        
                        html += '</tr>';
                        $('#rowselect tbody').prepend(html);
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