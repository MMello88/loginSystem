<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends MY_Controller {
	
	public function __construct() {
		
		parent::__construct();

		$this->css[] = base_url("assets/template/assets/css/lib/sweetalert/sweetalert.css");		
		$this->js[] = base_url("assets/template/assets/js/lib/sweetalert/sweetalert.min.js");
		$this->js[] = base_url("assets/js/fmCadastro.js");

		$this->data['css'] = $this->css;
		$this->data['js'] = $this->js;
	}

	public function index($url)
	{
		$this->data['tabela'] = $this->cadastro->getTabelaByUrl($url);
		$this->data['consulta'] = $this->cadastro->getConsulta($this->data['tabela']);
		$this->setView('cadastro/viewCadastro');
	}

	public function getFormulario($id_tabela, $id_primary){
		$this->data['tabela'] = $this->cadastro->getTabelaByUrl($id_tabela);
	}
}