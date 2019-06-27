                <section id="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title">
                                    <h4><a href='#' data-toggle='modal' data-target='#cad'>Cadastrar</a></h4>
                                    
                                </div>
                                <div class="bootstrap-data-table-panel" id="bootstrap-data-table-panel">
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
                    <div class='modal-dialog modal-xl modal-dialog-centered' role='document' id="form_html">
                    </div>
                </div>

                <div class="modal fade" id="cad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class='modal-dialog modal-xl modal-dialog-centered' role='document' id="form_html">
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

                <div class="modal fade" id="del" tabindex="-1" role="dialog" aria-labelledby="deletarModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Deletar</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<?= form_open("Dashboard/Cadastro/remover", ["id" => "formRemover"]) ?>
									<h5>Deseja deletar o Registro?</h5>

									<input type="hidden" name="cp"    value="" id="del_cp">
									<input type="hidden" name="idp"   value="" id="del_idp">
									<input type="hidden" name="_url"   value="" id="<?= $tabela->url ?>">
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
								<button type="button" class="btn btn-danger" id="btnCadDeletar">Deletar</button>
							</div>
                        </div>
                    </div>
                </div>