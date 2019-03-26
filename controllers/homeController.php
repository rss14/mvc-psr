<?php
class homeController extends controller {

	private $user;

	public function __construct(){

		$this->user = new Users();

		if(!$this->user->isLogged()){

			header("Location: ".BASE_URL."login");
			exit;

		}

	}

	public function index() {

		$dados = array();
		// define qual menu o usuário está para ativar o menu como ativo

		$_GET['ac'] = "h";

		

				
		$u = new Users();
		
		$dados['usuario'] = $u->getInfo($this->user->getId());
		
		
		$this->loadTemplate('home', $dados);
		
	}

	
}