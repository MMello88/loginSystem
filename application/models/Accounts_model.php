<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts_model extends CI_Model {

    public function  __construct() {
        parent::__construct();
    }

    public function inserirUsuario(){
    	$data = [
    		'id_usuario' => '',
    		'nome' => $this->input->post('nome'),
    		'email' => $this->input->post('email'),
    		'senha' => md5($this->input->post('senha')),
    		'ativo' => '1',
    		'dt_cadastro' => date('Y-m-d H:i:s'),
            'cadastro_completo' => '0',
    	];

    	if ($this->db->insert('usuario', $data)) {
    		return $this->db->insert_id();
    	} else {
    		return ['code' => $this->db->error()['code'], 'message' => $this->db->error()['message']];
    	}
    }

    public function updateContinuacao(){
        $data = [
            'dt_nascimento' => $this->input->post('dt_nascimento'),
            'celular' => $this->input->post('celular'),
            'sexo' => $this->input->post('sexo'),
            'super_usuario' => $this->input->post('super_usuario'),
            'cadastro_completo' => '1',
        ];

        $condicao = [
            'email' => $this->session->userdata("account")["Email"],
        ];

        return $this->db->update('usuario', $data, $condicao);
    }

    public function getByEmail($email) {
        $query = $this->db->get_where('usuario', array('email' => $email));
        $result = $query->result_object();
        return empty($result) ? "" : $result[0];
    }

    public function getByHash($hash) {
        $query = $this->db->get_where('usuario', array('hash' => $hash));
        $result = $query->result_object();
        return empty($result) ? "" : $result[0];
    }

    public function changeHash($id_usuario, $hash = "", $date = ""){
        return $this->db->update('usuario', ['hash' => $hash, 'dt_hash_exp' => $date], ['id_usuario' => $id_usuario]);
    }

    public function changeSenha($id_usuario, $senha){
        return $this->db->update('usuario', ['senha' => $senha], ['id_usuario' => $id_usuario]);
    }

    public function setByCookie($hash_cookie, $email) {
        $data = [
            'code_cookie_hash' => $hash_cookie,
        ];

        $condicao = [
            'email' => $email,
        ];

        return $this->db->update('usuario', $data, $condicao);
    }

    public function getByCookie($hash) {
        $query = $this->db->get_where('usuario', array('code_cookie_hash' => $hash));
        $result = $query->result_object();
        return empty($result) ? "" : $result[0];
    }
}