<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div class="page-header-image" style="background-image:url(<?= base_url('assets/templateV3/img/header.jpg') ?>)"></div>
    <!-- container -->
    <div class="container">
      <!-- Titulo -->
      <div class="col-md-12 content-center">
        <img class="d-block mx-auto mb-4" src="<?= base_url('assets/templateV3/img/avatar.png') ?>" alt="" width="72" height="72">
        <h2>Mister Web!</h2>
        <hr class='mb-3 mt-1'>
        <p class="lead"><?= $usuario->Values['nome']; ?> Agradecemos o seu Cadastro!</p>
        <p class="lead">Só tem mais um passo! <br/> Enviamos um e-mail de Ativação da sua conta, nele contém instruções de como proceder.</p>
        <p class="lead">Obrigado!</p>
        <a class="btn btn-warning btn-lg" href="<?= base_url(""); ?>" role="button">Voltar ao Inicio</a>
      </div>
      <!-- fim do Titulo -->
    </div>
    <!-- fim do container -->