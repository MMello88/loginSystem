<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $data = [];
	
	public $logged = false;

	/* Variável $account 
	 * 
	 * Sem vai exisit em seu conteúdo os valores do usuário
	 *
	 * Object of account ["Logado", "Email", "CadastroCompleto"]
	 *
	 */
	public $account;

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
				$this->session->set_userdata("account",["Email" => $usuario->email, "CadastroCompleto" => $usuario->cadastro_completo, "cookie" => True]);
				$this->account = (object)$this->session->userdata("account");
				return true;
			}
		}
		return false;
	}
}