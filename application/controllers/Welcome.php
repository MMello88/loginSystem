<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function index()
	{
		if ($this->logged){
			$this->data["email"] = $this->account->email;
			if ($this->account->CadastroCompleto == "0"){
				redirect("accounts/continue");
			}

			$this->setView('index');
		} else {

			$this->setView('welcome_message');
		}
		
	}

}
