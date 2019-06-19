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

	public function getFormulario($id_tabela, $id_primary = ''){
		//if(!$this->input->is_ajax_request()){
		//	redirect("");
		//}

		$tabela = $this->cadastro->getTabela($id_tabela);

		if(!empty($id_primary)){
			foreach($tabela->colunas as $coluna){
				if ($coluna->primary)
					$consulta = $this->cadastro->getConsulta($tabela, [$coluna->coluna, $id_primary]);
			}
			echo my_form($tabela, $consulta);			
		} else {
			echo my_form($tabela);
		}
	}
}