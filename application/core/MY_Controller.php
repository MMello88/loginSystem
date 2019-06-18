<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $data = [];
	
	public $logged = false;

	/* Variável $account 
	 * 
	 * Sem vai exisit em seu conteúdo os valores do usuário
	 *
	 * Object of account ["Logado", "Email", "CadastroCompleto", "id_tipo_usuario"]
	 *
	 */
	public $account;

	public $css = [];

	public $js = [];

	public function __construct() {
		
		parent::__construct();
		
		if (!$this->isLogged()){
			$this->logged = false;
		} else {
			$this->logged = true;
		}
		
		if (!$this->logged){
			$this->logged = $this->hasCookie();
		}

		if($this->logged){
			$this->get_menu();
			$this->data['account'] =  $this->account;
		}
	}

	public function isLogged(){

		if ($this->session->userdata("account")){

			$this->account = (object)$this->session->userdata("account");
			return true;
		}
		return false;
	}


	public function hasCookie(){
		$hash = $this->input->cookie('ci_session');
		if ($hash){
			$usuario = $this->accounts->getByCookie($hash);
			if (empty($usuario)){
				return false;
			} else {
				$this->session->set_userdata("account",["email" => $usuario->email, "nome" => $usuario->nome, "CadastroCompleto" => $usuario->cadastro_completo, "cookie" => True, "id_tipo_usuario" => $_usuario->id_tipo_usuario]);
				$this->account = (object)$this->session->userdata("account");
				return true;
			}
		}
		return false;
	}

	public function setView($view){
		if($this->logged){
			$this->load->view("dashboard/includes/header", $this->data);
			$this->load->view("dashboard/$view", $this->data);
			$this->load->view("dashboard/includes/footer", $this->data);
		} else {
			$this->load->view($view, $this->data);
		}
	}

	private function get_menu(){
		$this->data['main_menu'] = $this->menu->Menu($this->account->id_tipo_usuario);
	}
}