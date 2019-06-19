document.querySelector('#edt').onclick = function(){
    $.ajax({
        url: base_url + "Dashboard/Cadastro/getFormulario/"+this.dataset.table+"/"+this.dataset.id_primary,
        success: function(data){
            console.log(data);
            swal({
                title: "Sweet ajax request !!",
                text: data,
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            },
            function(){
                setTimeout(function(){
                    swal("Hey, your ajax request finished !!");
                }, 2000);
            });
        },
        error: function(data) {
            swal({
                title: "Sweet ajax request !!",
                text: data,
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            });
        }
    });

    
};