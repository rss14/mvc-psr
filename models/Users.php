<?php
class Users extends model {

	private $uid;


	public function getInfo($id) {

		// Pega as informações do usuário logado.

		$array = array();

		$sql = "SELECT * FROM users WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	
	public function isLogged() {

		// Verifica se existe sessão ativa e invalida toda vez que houver mais que um login ativo.

		if(!empty($_SESSION['token'])){

			$token = $_SESSION['token'];
			$sql = "SELECT id FROM users WHERE token = :token";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':token', $token);
			$sql->execute();


			if($sql->rowCount() > 0){

				$data = $sql->fetch();
				$this->uid = $data['id'];

				return true;

			}

		}
		

		return false;

	}

	// valida login.
	public function validateLogin($email, $password){

		$sql = "SELECT id FROM users WHERE email= :email AND password = :password AND admin = 1";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':email', $email);
		$sql->bindValue(':password', md5($password));
		$sql->execute();

		if($sql->rowCount() > 0 ){
			
			$data = $sql->fetch();

			// gera um novo token a cada vez que é efetuado login, isto permite manter apenas um login por usuário.
			$token = md5(rand(0,9995).$data['id']);
			

			// atualiza com o novo token para o usuário
			$sql = "UPDATE users SET token = :token WHERE id = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':token', $token);
			$sql->bindValue(':id', $data['id']);
			$sql->execute();

			$_SESSION['token'] = $token;

			return true;

		}

		return false;
	}

	public function getId(){

		// Pega o id do usuario logado.

		return $this->uid;

	}


}