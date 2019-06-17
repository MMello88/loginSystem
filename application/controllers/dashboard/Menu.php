<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller {

	public function index()
	{
		$this->setView('menu/listar');
	}

}