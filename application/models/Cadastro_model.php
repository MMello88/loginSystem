<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadastro_model extends CI_Model {

    public function  __construct() {
        parent::__construct();
    }

    public function get($url){
    	return $this->getTabela($url);
    }

    public function getTabela($url){
    	$query = $this->db->get_where('tabela', ['url' => $url]);
    	$rows = $query->result();
    	foreach ($rows as $key => $row) {
    		$rows[$key]->colunas = $this->getColunas($row->id_tabela);
    		$rows[$key]->relacional = $this->getRelacional($row->url);
    	}
    	return $rows;
    }

    public function getColunas($id_tabela, $id_coluna = ''){
    	if (empty($id_coluna))
    		$query = $this->db->get_where('coluna', ['id_tabela' => $id_tabela]);
    	else
    		$query = $this->db->get_where('coluna', ['id_tabela' => $id_tabela, 'id_coluna' => $id_coluna]);
    	$rows = $query->result();
    	return $rows;
    }

    public function getRelacional($url){
    	$sql = "select r.id_relacional, 
				       r.id_tabela_pai, 
				       r.id_tabela_filha, 
				       r.pai_filha, 
				       t.tabela as tabela_pai, 
				       t.label as label_pai, 
				       tf.tabela as tabela_filha, 
				       tf.label as label_filha
				 from tbl_relacional r
				inner join tbl_tabela t on (t.id_tabela = r.id_tabela_pai) 
				INNER JOIN tbl_tabela tf ON (tf.id_tabela = r.id_tabela_filha)
				where t.url = $url";
		$query = $this->db->query($sql);
    	$rows = $query->result();	
    	$rows = $query->result();
    	foreach ($rows as $key => $row) {
    		$rows[$key]->colunas_pai = $this->getRelColunas($row->id_tabela_pai);
    		$rows[$key]->tabela_filha = $this->getRelColunas($row->id_tabela_filha);
    	}
    	return $rows;
    }

    public function getRelColunas($id_relacional, $id_tabela_pai){
    	$query = $this->db->get_where('relacional_coluna', ['id_relacional' => $id_relacional]);
    	$rows = $query->result();
    	foreach ($rows as $key => $row) {
    		$rows[$key]->coluna_pai = $this->getColunas($id_tabela_pai, $row->id_coluna_pai);
    	}
    	return $rows;
    }
}