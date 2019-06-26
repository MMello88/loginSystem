<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends MY_Controller {
	
	public function __construct() {
		
		parent::__construct();

		
		$this->js[] = base_url("assets/template/assets/js/lib/datatable/datatables.min.js");
		$this->js[] = base_url("assets/template/assets/js/lib/datatable/DataTables-1.10.18/js/jquery.dataTables.min.js");
		$this->js[] = base_url("assets/template/assets/js/lib/datatable/DataTables-1.10.18/js/dataTables.bootstrap4.min.js");

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

	public function getFormulario($id_tabela, $cp = '', $id = ''){
		if(!$this->input->is_ajax_request()){
			redirect("");
		}

		$tabela = $this->cadastro->getTabela($id_tabela);

		if(!empty($id)) {
			$consulta = $this->cadastro->getConsulta($tabela, [$cp => $id]);
			echo my_modal($tabela, $consulta);			
		} else {
			echo my_modal($tabela);
		}
	}

	public function editar(){
		if(!$this->input->is_ajax_request()){
			redirect("");
		}

		$tabela = $this->cadastro->getTabelaByUrl($this->input->post('_url'));
		foreach ($tabela->colunas as  $coluna) {
			if ($coluna->obrigatorio == '1'){
				$this->form_validation->set_rules($coluna->coluna, $coluna->input_label, 'trim|required');
			}
		}

		if ($this->form_validation->run() == TRUE) {
			$this->cadastro->alterar($tabela, $this->input->post());
			echo json_encode(["event" => "edt", "code" => "1", "message" => "Alteração realizada com sucesso!"]);
			return;
		} else {
			echo json_encode(["event" => "edt", "code" => "0", "message" => validation_errors(null,null)]);
			return;
		}
	}

	public function cadastrar(){
		if(!$this->input->is_ajax_request()){
			redirect("");
		}

		$tabela = $this->cadastro->getTabelaByUrl($this->input->post('_url'));
		foreach ($tabela->colunas as  $coluna) {
			if ($coluna->obrigatorio == '1' && $coluna->primary == '0'){
				$this->form_validation->set_rules($coluna->coluna, $coluna->input_label, 'trim|required');
			}
		}

		if ($this->form_validation->run() == TRUE) {
			$id = $this->cadastro->inserir($tabela, $this->input->post());
			echo json_encode(["event" => "cad", "code" => "1", "message" => "Cadastro realizado com sucesso!", "idp" => $id]);
			return;
		} else {
			echo json_encode(["event" => "cad", "code" => "0", "message" => validation_errors(null,null)]);
			return;
		}
	}

	public function remover(){
		if(!$this->input->is_ajax_request()){
			redirect("");
		}

		$tabela = $this->cadastro->getTabelaByUrl($this->input->post('_url'));

		$this->form_validation->set_rules('cp', 'Campo', 'trim|required');
		$this->form_validation->set_rules('idp', 'Valor', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$this->cadastro->deletar($tabela, $this->input->post());
			echo json_encode(["event" => "del", "code" => "1", "message" => "Delete do registro realizado com sucesso!"]);
			return;
		} else {
			echo json_encode(["event" => "del", "code" => "0", "message" => validation_errors(null,null)]);
			return;
		}
	}
}