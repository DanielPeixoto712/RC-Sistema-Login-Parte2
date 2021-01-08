<?php
session_start();
if ($_SERVER['REQUEST_METHOD']=="POST") {
	
	if ($_POST['user_name'])&& isset($_POST['password'])) {
		$utilizador=$_POST['user_name'];
		$password=$_POST['password'];

			$con=new mysqli("localhost", "root", "","projeto-filmes");

			if ($con->connect_erno!=0) {
			echo "Ocorreu um erro no acesso á base de dados.<br>" .$con->connect_error;
			exit;
			}
			else{
				$sql="Select * from utilizadores where user_name=? and password=?";
				$stm=$con->prepare($sql):
				if ($stm!=false) {
					$stm->bind_param("ss"$utilizador,$password);
					$stm->execute();
					$res=$stm->get_result();
					if ($res->num_rows==!) {
						$_SESION['login']="Correto";
					}
					else{
						$_SESION['login']="incorreto";
					}
					header("refresh:5;url=index.php");
					}
					else{
						echo "Ocorreu um erro no acesso ábase de dados.<br> STM:".$con->connect_error;
						exit;
					}
				}
			}
	}
}