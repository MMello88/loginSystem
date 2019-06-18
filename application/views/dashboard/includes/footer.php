                </div>
            </div>
        </div>
        <div id="search">
            <button type="button" class="close">×</button>
            <form>
                <input type="search" value="" placeholder="type keyword(s) here" />
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <!-- jquery vendor -->
        <script src="<?= base_url() ?>assets/template/assets/js/lib/jquery.min.js"></script>
        <script src="<?= base_url() ?>assets/template/assets/js/lib/jquery.nanoscroller.min.js"></script>
        <!-- nano scroller -->
        <script src="<?= base_url() ?>assets/template/assets/js/lib/menubar/sidebar.js"></script>
        <script src="<?= base_url() ?>assets/template/assets/js/lib/preloader/pace.min.js"></script>
        <!-- sidebar -->
        <script src="<?= base_url() ?>assets/template/assets/js/lib/popper/popper.min.js"></script>
        <script src="<?= base_url() ?>assets/template/assets/js/lib/bootstrap.min.js"></script>
        

        <!-- bootstrap -->

        <?php
        if (isset($js)){
            foreach ($js as $arq) {
                echo "<script src='$arq'></script>";
            }
        } ?>

        <!-- scripit init-->

<script type="text/javascript">
    
    $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var recipient = button.data('whatever')
      console.log(recipient)
      var modal = $(this)
      modal.find('.modal-title').text('New message to ' + recipient)
      modal.find('.modal-body input').val(recipient)
    });


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

        
</script>

    </body>

</html>
