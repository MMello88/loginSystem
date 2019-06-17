<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends MY_Controller {

	public function index($url)
	{
		$this->data['tabela'] = $this->cadastro->getTabela($url);
		$this->data['consulta'] = $this->cadastro->getConsulta($this->data['tabela']);
		$this->setView('cadastro/listar');
	}
}