<div class="container-fluid" style="position:absolute; height: 100%; background-image:url('<?= base_url('assets/images/pexels-photo-30732.jpg') ?>');  background-position: center; background-repeat: no-repeat; background-size: cover; z-index: -1;"></div>
<section id="register">
  <div class="container col-lg-7" style="padding-top:200px;">
    <div class="card " >
      <div class="card-header ">
        Registra-se
      </div>

      <div class="card-body border-0">
        <div class="alert alert-dismissible collapse" id="code">
          <strong>Ops!</strong><hr><p id="message"></p>
          <button type="button" class="close" id="close" data-toggle="collapse" data-target="#code" aria-expanded="true" aria-controls="code">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <?= form_open("register", array("class" => "form", "id" => "formRegisterAccount")) ?>
          <div class="form-group">
            <input type="nome" class="form-control"  id="nome" name="nome" placeholder="Nome">
          </div>
          <div class="form-group">
            <input type="email" class="form-control"  id="email" name="email" placeholder="Enter email">
          </div>

    			<div class="form-group form-group-no-border input-lg">
    				<div class="form-row">
              <div class="col-md-6">
    						<input type="password" class="input-lg form-control" id="senha" name="senha" placeholder="Senha" required>
    					</div>
    					<div class="col-md-6">
    						<input type="password" class="form-control" id="resenha" name="resenha" placeholder="Confirma a Senha" required>
    					</div>
    				</div>
    			</div>

    		  <input type="submit" class="btn btn-primary rounded-pill" value="Registrar">
        <?= form_close(); ?>

      </div>
    </div>
  </div>
</section>