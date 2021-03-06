<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadastro_model extends CI_Model {

    public function  __construct() {
        parent::__construct();
    }

    public function getTabela($id_tabela){
    	$query = $this->db->get_where('tabela', ['id_tabela' => $id_tabela]);
    	$row = $query->row();
    	if(!empty($row)){
			$row->colunas = $this->getColunas($row->id_tabela);
			//$row->tabela_filha = $this->getRelacional($row->id_tabela);
		}
    	return $row;
    }

    public function getTabelaByUrl($url){
    	$query = $this->db->get_where('tabela', ['url' => $url]);
    	$row = $query->row();
    	if(!empty($row)){
			$row->colunas = $this->getColunas($row->id_tabela);
			//$row->tabela_filha = $this->getRelacional($row->id_tabela);
		}
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
				inner join tbl_coluna c on (c.id_coluna = r.id_coluna_pai and c.id_tabela = r.id_tabela_pai)
				INNER JOIN tbl_tabela tf ON (tf.id_tabela = r.id_tabela_filha)
				inner join tbl_coluna cf on (cf.id_coluna = r.id_coluna_filha and cf.id_tabela = r.id_tabela_filha)
				where r.id_tabela_pai = $id_tabela";
		$query = $this->db->query($sql);
    	$rows = $query->result();
    	return $rows;
    }

    public function getConsulta($tabela, $where = array(), $limit = -1){
    	foreach ($tabela->colunas as $coluna) {
    		if($coluna->primary == '1')
    			$colPrimary = $coluna->coluna;
    	}
		if(!empty($tabela)){
			$query = $this->db->order_by($colPrimary, 'DESC')->get_where(str_replace("tbl_", "", $tabela->tabela), $where);
			return empty($where) ? $query->result() : $query->row();
		}
		return null;
	}
	
	public function alterar($tabela, $post){
		$data = [];
		foreach ($tabela->colunas as $key => $coluna) {
			if(isset($post[$coluna->coluna]))
				$data[$coluna->coluna] = $post[$coluna->coluna];
			if ($coluna->primary == '1'){
				$where = [$coluna->coluna => $post[$coluna->coluna]];
			}
		}
		return $this->db->update(str_replace("tbl_", "", $tabela->tabela), $data, $where);
	}

	public function inserir($tabela, $post){
		$data = [];
		foreach ($tabela->colunas as $key => $coluna) {
			if(isset($post[$coluna->coluna]))
				$data[$coluna->coluna] = $post[$coluna->coluna];
		}
		$this->db->insert(str_replace("tbl_", "", $tabela->tabela), $data);
		return $this->db->insert_id();
	}

	public function deletar($tabela, $post){
		$where = [$post['cp'] => $post['idp']];
		return $this->db->delete(str_replace("tbl_", "", $tabela->tabela), $where);
	}
}