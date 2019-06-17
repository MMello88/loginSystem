<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model {

    public function  __construct() {
        parent::__construct();
    }

    public function Menu($id_tipo_usuario){
    	$rows = $this->getTitulo($id_tipo_usuario);
    	foreach ($rows as $key => $row) {
			$rows[$key]->menus = $this->getMenu($id_tipo_usuario, $row->id_titulo);
		}
		return $rows;
    }

    public function getMenu($id_tipo_usuario, $id_titulo){
    	$sql = "SELECT m.id_menu, m.menu, m.ordem, m.url, m.icone
				  FROM tbl_menu_usuario mu
				 INNER JOIN tbl_menu m ON (mu.id_menu = m.id_menu)
				 INNER JOIN tbl_menu_titulo mt ON (mt.id_menu = m.id_menu)
				 WHERE mu.id_tipo_menu = $id_tipo_usuario
				   AND m.status = 'a'
				   AND mt.id_titulo = $id_titulo
				 ORDER BY m.ordem";
		$result = $this->db->query($sql);
		$rows = $result->result();
		foreach ($rows as $key => $row) {
			$rows[$key]->submenus = $this->getSubmenu($row->id_menu);
		}
		return $rows;
    }

    public function getSubmenu($id_menu){
    	$result = $this->db->get_where('submenu', ['id_menu' => $id_menu]);
    	return $result->result();
    }

    public function getTitulo($id_tipo_usuario){
    	$sql = "SELECT t.id_titulo, t.titulo
				  FROM tbl_menu_titulo mt
				 INNER JOIN tbl_titulo t ON (t.id_titulo = mt.id_titulo)
				 INNER JOIN tbl_menu m ON (m.id_menu = mt.id_menu)
				 INNER JOIN tbl_menu_usuario mu ON (mu.id_menu = m.id_menu)
				 WHERE m.status = 'a'
				   AND mu.id_tipo_menu = $id_tipo_usuario
				 ORDER BY t.id_titulo";
		$result = $this->db->query($sql);
		return $result->result();
    }

}