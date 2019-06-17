<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends MY_Controller {
	
	public function __construct(){
		
		parent::__construct();

		$this->data['js'] = "<script src=\"".base_url("assets/js/accounts.js")."\" ></script>";
	}

	public function validate_session_account(){
		if ($this->logged)
			echo json_encode(["code" => "1", "message" => "true"]);
		else
			echo json_encode(["code" => "3", "message" => "false"]);
	}
	
	public function validate_accounts(){

		$this->form_validation->set_rules('email', 'Usuário', 'trim|required|valid_email');
		$this->form_validation->set_rules('senha', 'Password', 'trim|required|min_length[6]');
		
		if ($this->form_validation->run() == TRUE) {
			$_usuario = $this->accounts->getByEmail($this->input->post('email'));
			if (!empty($_usuario)){
				if($this->input->post('email') == $_usuario->email){
					if(md5($this->input->post('senha')) == $_usuario->senha){
						$this->accounts->changeHash($_usuario->id_usuario);
						$this->session->set_userdata("account",["email" => $_POST['email'], "nome" => $_usuario->nome, "CadastroCompleto" => $_usuario->cadastro_completo, "cookie" => $this->input->post('lembrar') == 'on' ? True : False, "id_tipo_usuario" => $_usuario->id_tipo_usuario]);
						if ($this->input->post('lembrar') == 'on'){
							$this->accounts->setByCookie($this->input->cookie("ci_session"), $_POST['email']);
						}
						echo json_encode(["code" => "1", "message" => "Usuário e Senha estão corretas"]);
					} else {
						echo json_encode(["code" => "2", "message" => "Senha inválida"]);
					}
				} else {
					echo json_encode(["code" => "2", "message" => "Usuário não foi encontrado."]);
				}
			} else {
				echo json_encode(["code" => "2", "message" => "Usuário não foi encontrado."]);
			}
		} else {
			echo json_encode(["code" => "2", "message" => validation_errors(null,null)]);
		}
	}

	public function register_account(){
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tbl_usuario.email]');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('resenha', 'Confirmar Senha', 'required|min_length[6]|matches[senha]');
		
		if ($this->form_validation->run() === TRUE){
			$return_id = $this->accounts->inserirUsuario();
			if(is_integer($return_id)){
				$this->session->set_userdata("account",["email" => $this->input->post('email'), "nome" => $this->input->post('nome'), "CadastroCompleto" => "0", "cookie" => False, "id_tipo_usuario" => "2"]);
				echo json_encode(["code" => "1", "message" => "Cadastro realizado com sucesso!"]);
			} else {
				echo $return_id;
			}
		} else {
			echo json_encode(["code" => "2", "message" => validation_errors(null,null)]);
		}
	}
	
	public function validate_continue(){
		$this->form_validation->set_rules('dt_nascimento', 'Data Nascimento', 'trim|required');
		$this->form_validation->set_rules('celular', 'Número Celular', 'trim|required');
		$this->form_validation->set_rules('sexo', 'Sexo', 'trim|required');
		$this->form_validation->set_rules('super_usuario', 'Super Usuário', 'trim|required|is_unique[tbl_usuario.super_usuario]');
		if ($this->form_validation->run() === TRUE){
			if($this->accounts->updateContinuacao()){
				$this->session->set_userdata("account",["email" => $this->account->email, "nome" => $this->account->nome, "CadastroCompleto" => "1", "cookie" => False, "id_tipo_usuario" => $this->account->id_tipo_usuario]);
				echo json_encode(["code" => "1", "message" => "Muito obrigado. Seja bem vindo ao Matilab. Vai se surpreender com poder de uma agenda! <br> Você será redirecionado para pagina princial..."]);
			} else {
				echo json_encode(["code" => "2", "message" => "Tente novamente em alguns instantes. Obrigado!"]);
			}
		} else {
			echo json_encode(["code" => "2", "message" => validation_errors(null,null)]);
		}		
	}
	
	public function validate_forgot(){
		if (!$this->input->post('hash')) {
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

			if ($this->form_validation->run() === TRUE) {
				$_usuario = $this->accounts->getByEmail($this->input->post('email'));
				if(!empty($_usuario)){
					$hash = md5(date('Y-m-d H:i:s'));
					$this->accounts->changeHash($_usuario->id_usuario, $hash, date_format(date_add(new DateTime("now"), date_interval_create_from_date_string('3 days')), 'Y-m-d'));
					$this->sendemail->enviarEmailRecuperarSenha($_usuario->nome, $_usuario->email, $hash);
					echo json_encode(["code" => "1", "message" => "Link de Recuperar a Senha foi enviado em seu E-mail."]);
				} else {
					echo json_encode(["code" => "2", "message" => "Usuário não foi encontrado."]);
				}
			} else {
				echo json_encode(["code" => "2", "message" => validation_errors(null,null)]);
			}
		} else {
			$this->form_validation->set_rules('hash', '', 'required');
			$this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]');			

			if ($this->form_validation->run() === TRUE) {
				$_usuario = $this->accounts->getByHash($this->input->post('hash'));
				if(!empty($_usuario)){
					$this->accounts->changeHash($_usuario->id_usuario);
					$this->accounts->changeSenha($_usuario->id_usuario, md5($this->input->post('senha')));
					echo json_encode(["code" => "1", "message" => "Sua senha foi recuperada com sucesso!"]);
				} else {
					echo json_encode(["code" => "2", "message" => "Usuário não foi encontrado."]);
				}
			} else {
				echo json_encode(["code" => "2", "message" => validation_errors(null,null)]);
			}
		}
	}

	public function logout_account(){
		$this->session->sess_destroy();
		$this->account = null;
	}
	
	public function accounts()
	{
		$this->load->view('accounts/includes/header');
		$this->load->view('accounts/accounts/accounts');
		$this->load->view('accounts/includes/footer', $this->data);
	}

	public function logout()
	{
		$this->logout_account();
		$this->load->view('accounts/includes/header');
		$this->load->view('accounts/logout/logout_success');
		$this->load->view('accounts/includes/footer', $this->data);
	}

	public function forgot($hash = '')
	{
		if(!empty($hash)){
			$_usuario = $this->accounts->getByHash($hash);

			if(!empty($_usuario)){
				if ($_usuario->dt_hash_exp < date("Y-m-d")){
					$this->data['hash_msg'] = 'Sua solicitação para recuperar a senha expirou. <br/> Solicite novamente!';
					$hash = '';
				}
			} else {
				$this->data['hash_msg'] = 'Não existe solicitação para recuperar senha.';
				$hash = '';
			}
		}
		
		$this->data['hash'] = $hash;
		$this->load->view('accounts/includes/header');
		$this->load->view('accounts/forgot/forgot', $this->data);
		$this->load->view('accounts/includes/footer', $this->data);
	}

	public function register()
	{
		$this->load->view('accounts/includes/header');
		$this->load->view('accounts/register/register');
		$this->load->view('accounts/includes/footer', $this->data);
	}

	public function register_ativado()
	{
		$this->load->view('accounts/includes/header');
		$this->load->view('accounts/register/register_ativado');
		$this->load->view('accounts/includes/footer', $this->data);
	}

	public function continuar()
	{
		if ($this->logged){
			if ($this->account->CadastroCompleto == "0"){
				$_usuario = $this->accounts->getByEmail($this->account->Email);
				$this->data['_usuario'] = $_usuario;
				$this->load->view('accounts/includes/header');
				$this->load->view('accounts/register/continuar', $this->data);
				$this->load->view('accounts/includes/footer', $this->data);
			}
		} else redirect();
	}

}
