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

        <script> 
            var base_url = '<?= base_url() ?>';
            var url = '<?= $tabela->url ?>';
            var table = '<?= $tabela->id_tabela ?>';
            var colunas = '<?= json_encode($tabela->colunas) ?>';
        </script>
        <!-- jquery vendor -->
        <script src="<?= base_url() ?>assets/template/assets/js/lib/jquery.min.js"></script>
        <script src="<?= base_url() ?>assets/template/assets/js/lib/jquery.nanoscroller.min.js"></script>
        <!-- nano scroller -->
        <script src="<?= base_url() ?>assets/template/assets/js/lib/menubar/sidebar.js"></script>
        <script src="<?= base_url() ?>assets/template/assets/js/lib/preloader/pace.min.js"></script>
        <!-- sidebar -->
        <script src="<?= base_url() ?>assets/template/assets/js/lib/popper/popper.min.js"></script>
        <!-- bootstrap -->
        <script src="<?= base_url() ?>assets/template/assets/js/lib/bootstrap.min.js"></script>

        <?php
        if (isset($js)){
            foreach ($js as $arq) {
                echo "<script src='$arq'></script>";
            }
        } ?>
    </body>

</html>
