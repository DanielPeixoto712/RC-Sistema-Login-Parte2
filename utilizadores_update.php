<?php


session_start();

if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if ($_SESSION['login']=="correto" && isset($_SESSION['login'])) {
	//aqui colocamos o conteudo


if ($_SERVER['REQUEST_METHOD']=='POST') {
	$nome="";
	$user_name="";
	$email="";
	$password="";

	

if (isset($_POST['nome'])) {
		$nome=$_POST['nome'];
	}
	else{
		echo '<script>alert("É obrigatório o preenchimento do nome.");</script>';
	}
	if (isset($_POST['user_name'])) {
		$user_name=$_POST["user_name"];
	}
	if (isset($_POST['email'])) {
		$email=$_POST["email"];
	}
	if (isset($_POST['password'])) {
		$password=$_POST["password"];
	}


	$con=new mysqli("localhost","root", "","projeto-filmes");

	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados. <br>".$con->connect_error;
		exit;
	}
	else{
		$sql="update into utilizadores nome, user_name, email, password) values (?,?,?,?)";
		$stm=$con->prepare($sql);

			
			if ($stm!=false) {
				$stm->bind_param("sssss", $nome, $user_name, $email, $password);
				$stm->execute();
				$stm->close();
				echo '<script>alert("Utilizador alterado com sucesso!!")</script>';
				echo "Aguarde um momento. A reencaminhar página";
				header ('refresh:5, url=index.php');
			}
			else{

		}
	}
}
else{
	echo ("<h1>Houve um erro ao processar o seu pedido.<br> Dentro de segundos irá ser rencaminhado!</h1>");
				header ("refresh:5; url= index.php");
}



}//login
else{
	echo 'Para entrar nesta página necessita de efetuar <a href="login.php">login</a>';
	header('refresh:2;url=login.php');
}

?>