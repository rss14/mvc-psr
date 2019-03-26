<?php
class loginController extends controller {

	
	public function index() {
		$array = array();


		$this->loadView('login', $array);
	}

	public function index_action(){

		

		if(!empty($_POST['email']) && !empty($_POST['password'])){
			
			$email = $_POST['email'];
			$password = $_POST['password'];

			$u = new Users();

			if($u->validateLogin($email, $password)){

				header("Location: ".BASE_URL);
				exit;

			}
		}

		header ("Location: ".BASE_URL."login");
		exit;

	}

	public function logout(){

		unset($_SESSION['token']);
		header("Location: ".BASE_URL);
		exit;

	}


}