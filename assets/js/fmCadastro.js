document.querySelector('#add').onclick = function(){
    var recipient = this.dataset.whatever;
    swal({
            title: "Sweet ajax request !!",
            text: "Submit to run ajax request !! " + recipient,
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
};