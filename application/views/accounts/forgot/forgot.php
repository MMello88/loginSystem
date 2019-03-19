<div class="container-fluid" style="position:absolute; height: 100%; background-image:url('<?= base_url('assets/images/img_parallax.jpg') ?>');  background-position: center; background-repeat: no-repeat; background-size: cover; z-index: -1;"></div>
<section id="accounts">
    <div class="container col-lg-7" style="padding-top:300px;">
        <div class="card border-0 bg-transparent" >
            <div class="card-header border-0 bg-transparent">
               Recuperar Senha
            </div>
            <div class="card-body border-0">
                <div class="alert alert-dismissible collapse <?= !isset($hash_msg) ? "" : "alert-info show" ?>" id="code">
                  <strong>Ops!</strong><hr><p id="message"><?= !isset($hash_msg) ? "" : $hash_msg ?></p>
                  <button type="button" class="close" id="close" data-toggle="collapse" data-target="#code" aria-expanded="true" aria-controls="code">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <?php if (empty($hash)) : ?>
                    <?= form_open("forgot", array("class" => "form-inline", "id" => "formForgot")) ?>
                        <div class="form-group w-75">
                            <input type="email" class="form-control w-100" id="email" name="email" placeholder="Enter email">
                        </div>
                        <input type="submit" class="btn btn-primary rounded-pill ml-3" value="Recuperar">
                    <?= form_close() ?>
                <?php else : ?>
                    <?= form_open("forgot/$hash", array("class" => "form-inline", "id" => "formForgot")) ?>
                        <div class="form-group w-75">
                            <input type="hidden" class="form-control w-100" id="hash" name="hash" value="<?= $hash ?>">
                            <input type="password" class="form-control w-100" id="senha" name="senha"  placeholder="Informe a nova Senha">
                        </div>
                        <input type="submit" class="btn btn-primary rounded-pill ml-3" value="Recuperar">
                    <?= form_close() ?>
                <?php endif; ?>

            </div>
        </div>
</section>