                <section id="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title">
                                    <h4><a class='' href='#' data-toggle='modal' data-target='#cad' data-table='<?= $tabela->id_tabela ?>'>Cadastrar</a></h4>
                                    
                                </div>
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <?= my_data_table($tabela, $consulta) ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /# card -->
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer">
                                <p>2018 © Admin Board. - <a href="#">example.com</a></p>
                                <div id="date-time"></div>
                            </div>
                        </div>
                    </div>
                </section>


                <div class="modal fade" id="edt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class='modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable' role='document' id="form_html">
                    </div>
                </div>

                <div class="modal fade" id="cad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class='modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable' role='document' id="form_html">
                    </div>
                </div>


                <!-- Modal Message -->
                <div class="modal fade" id="alert-modal" tabindex="-1" role="dialog" aria-labelledby="Modalmessage" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Mensagem</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p id="alert-message"></p>
                            </div>
                        </div>
                    </div>
                </div>