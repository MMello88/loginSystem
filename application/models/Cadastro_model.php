<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadastro_model extends CI_Model {

    public function  __construct() {
        parent::__construct();
    }

    public function getTabela($url){
    	return $this->getTabelaByUrl($url);
    }

    public function getTabelaByUrl($url){
    	$query = $this->db->get_where('tabela', ['url' => $url]);
    	$row = $query->row();
    	
		$row->colunas = $this->getColunas($row->id_tabela);
		$row->tabela_filha = $this->getRelacional($row->id_tabela);
    	
    	return $row;
    }

    public function getColunas($id_tabela, $id_coluna = ''){
    	if (empty($id_coluna))
    		$query = $this->db->get_where('coluna', ['id_tabela' => $id_tabela]);
    	else
    		$query = $this->db->get_where('coluna', ['id_tabela' => $id_tabela, 'id_coluna' => $id_coluna]);
    	$rows = $query->result();
    	return $rows;
    }

    public function getRelacional($id_tabela){
    	$sql = "select r.id_relacional, 
				       r.id_tabela_pai, 
				       r.id_tabela_filha, 
				       r.pai_filha, 
				       t.tabela as tabela_pai, 
				       t.label as label_pai, 
				       t.url as url_pai,
				       tf.tabela as tabela_filha, 
				       tf.label as label_filha,
				       tf.url as url_filha
				 from tbl_relacional r
				inner join tbl_tabela t on (t.id_tabela = r.id_tabela_pai) 
				INNER JOIN tbl_tabela tf ON (tf.id_tabela = r.id_tabela_filha)
				where r.id_tabela_pai = $id_tabela";
		$query = $this->db->query($sql);
    	$rows = $query->result();	
    	$rows = $query->result();
    	foreach ($rows as $key => $row) {
    		$rows[$key]->coluna_pai_filha = $this->getRelColunas($row->id_relacional, $row->id_tabela_pai, $row->id_tabela_filha);
    	}
    	return $rows;
    }

    public function getRelColunas($id_relacional, $id_tabela_pai, $id_tabela_filha){
    	$query = $this->db->get_where('relacional_coluna', ['id_relacional' => $id_relacional]);
    	$rows = $query->result();
    	foreach ($rows as $key => $row) {
    		$rows[$key]->coluna_pai = $this->getColunas($id_tabela_pai, $row->id_coluna_pai);
    		$rows[$key]->coluna_flha = $this->getColunas($id_tabela_filha, $row->id_coluna_filha);
    	}
    	return $rows;
    }

    public function getConsulta($tabela = array(), $limit = -1){
    	$query = $this->db->get_where($tabela->tabela);
    	return $query->result();
    }
}