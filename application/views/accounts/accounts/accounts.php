<div class="container-fluid" style="position:absolute; height: 100%; background-image:url('<?= base_url('assets/images/pexels-photo-30732.jpg') ?>');  background-position: center; background-repeat: no-repeat; background-size: cover; z-index: -1;"></div>

<section id="accounts">
	<div class="container col-lg-7" style="padding-top:100px;">
		<div class="card">
		    <div class="card-header">
			   Sua conta
		    </div>
		    
		    <div class="card-body">
		        <div class="alert alert-dismissible collapse" id="code">
		          <strong>Ops!</strong><hr><p id="message"></p>
		          <button type="button" class="close" id="close" data-toggle="collapse" data-target="#code" aria-expanded="true" aria-controls="code">
		          <span aria-hidden="true">&times;</span>
		          </button>
		        </div>
				
				<div class="container col-lg-5 offset-lg-1">
					<h3 class="pb-2">Entrar no MatiLab</h3>
					<?= form_open("accounts", array("class" => "form", "id" => "formAccounts")) ?>
						<div class="form-group">
							<!--<label for="inputEmail">Email address</label>-->
							<input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp" autocomplete="current-password" placeholder="Enter email">
						</div>
						
						<div class="form-group">
							<!--<label for="inputPassword">Password</label>-->
							<input type="password" class="form-control" id="inputPassword" name="senha" autocomplete="current-password" placeholder="Password">
						</div>

						<input type="submit" id="enterAccount" class="btn btn-primary rounded-pill" value="Entrar">
						<div class="form-group form-check pt-3 pb-0">
							<input type="checkbox" class="form-check-input" name="lembrar" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Lembre me - </label>
							<a href="<?= base_url('forgot') ?>" class="link">Esqueceu sua senha?</a>
						</div>
						<!--<div class="pull-left">
							<h6>
								<a href="<?= base_url('register') ?>" class="link">Inscreva-se agora</a>
							</h6>
						</div>
						<div class="pull-right">
							<h6>
								
							</h6>
						</div> -->
					</form>
					
				</div>
			
		    </div>
			<div class="card-footer text-muted">
				<div class="container col-lg-5 offset-lg-1">
					<p>Novo no MatiLab? <a href="<?= base_url('accounts/register') ?>" class="link">Inscreva-se agora</a></p>
				</div>
			</div>
		</div>

		
	</div>
</section>