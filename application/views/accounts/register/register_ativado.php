<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div class="page-header-image" style="background-image:url(<?= base_url('assets/templateV3/img/header.jpg') ?>)"></div>
    <!-- container -->
    <div class="container">
      <!-- Titulo -->
      <div class="col-md-12 content-center">
        <img class="d-block mx-auto mb-4" src="<?= base_url('assets/templateV3/img/avatar.png') ?>" alt="" width="72" height="72">
        <h2>Mister Web!</h2>
        <hr class='mb-3 mt-1'>
		<p class="lead"><?= $usuario->nome; ?> Seja Bem Vindo!</p>
		<p class="lead">Faça já sua conta e começe a facilitar sua vida financeira!</p>
		<a class="btn btn-warning btn-lg" href="<?= base_url("accounts"); ?>" role="button">Sua conta</a>
      </div>
      <!-- fim do Titulo -->
    </div>
    <!-- fim do container -->