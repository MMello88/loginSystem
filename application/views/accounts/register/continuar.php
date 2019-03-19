<div class="container-fluid" style="position:absolute; height: 100%; background-image:url('<?= base_url('assets/images/pexels-photo-30732.jpg') ?>');  background-position: center; background-repeat: no-repeat; background-size: cover; z-index: -1;"></div>
<section id="register">
  <div class="container col-lg-7" style="padding-top:200px;">
    <div class="card " >
      <div class="card-header ">
        <h3>Olá, <?= $_usuario->nome ?></h3>
        <hr>
        <p>Preciso que continue a informar mais alguns dados.</p>
      </div>

      <div class="card-body border-0">
        <div class="alert alert-dismissible collapse" id="code">
          <strong>Ops!</strong><hr><p id="message"></p>
          <button type="button" class="close" id="close" data-toggle="collapse" data-target="#code" aria-expanded="true" aria-controls="code">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <?= form_open("validate_continuar", array("class" => "form", "id" => "formAccountContinue")) ?>
          <div class="form-group">
            <input type="date" class="form-control"  id="dt_nascimento" name="dt_nascimento" placeholder="Data de Nascimento" value="<?= date("Y-m-d",strtotime($_usuario->dt_nascimento)) ?>" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control"  id="celular" name="celular" placeholder="Número Celular" value="<?= $_usuario->celular?>" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control"  id="super_usuario" name="super_usuario" placeholder="@SUPER_USUARIO" value="<?= $_usuario->super_usuario?>" required>
          </div>

    	   <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline1" name="sexo" value="m" class="custom-control-input" <?= $_usuario->sexo == "m" ? "checked" : "" ?>>
            <label class="custom-control-label" for="customRadioInline1">Masculino</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline2" name="sexo" value="f" class="custom-control-input" <?= $_usuario->sexo == "f" ? "checked" : "" ?>>
            <label class="custom-control-label" for="customRadioInline2">Feminino</label>
          </div>

    		  <input type="submit" class="btn btn-primary rounded-pill float-right" value="Salvar">
        <?= form_close(); ?>

      </div>
    </div>
  </div>
</section>