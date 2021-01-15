
<?php


session_start();

if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if ($_SESSION['login']=="correto" && isset($_SESSION['login'])) {
	//aqui colocamos o conteudo




	if ($_SERVER['REQUEST_METHOD']=="POST") {
	$titulo="";
	$sinopse="";
	$idioma="";
	$data_lancamento="";
	$qauntidade=0;

	if (isset($_POST['titulo'])) {
		$titulo=$_POST['titulo'];
	}
	else{
		echo '<script>alert("É obrigatório o preenchimento do título.");</script>';
	}
	if (isset($_POST['sinopse'])) {
		$sinopse=$_POST["sinopse"];
	}
	if (isset($_POST['qauntidade'])&& is_numeric($_POST['quantidade'])) {
		$qauntidade=$_POST['quantidade'];
	}
	if (isset($_POST['idioma'])) {
		$idioma=$_POST['idioma'];
	}

	if (isset($_POST['data_lancamento'])) {
		$data_lancamento=$_POST['data_lancamento'];
	}
	$con=new mysqli("localhost", "root", "", "projeto-filmes");

	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados. <br>".$con->connect_error;
		exit;
	}
	else{
		$sql="insert into filmes (titulo, sinopse, idioma, quantidade, data_lancamento) values (?,?,?,?,?)";
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			
			$stm->bind_param('sssis', $titulo, $sinopse, $idioma, $quantidade, $data_lancamento);
			$stm->execute();
			$stm->close();

			echo '<script>alert("Livro adicionado com sucesso")</script>';
			echo "Aguarde um momento. A reencaminhar página";
			header ("refresh:5;url=index.php");
		}
		else{
			echo ($con->error);
			echo "Aguarde um momento. A reencaminhar página";
			header ("refresh:5; url=index.php");
		}
	}
}
else{
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Adicionar Filmes</title>
	</head>
	<body>
		<h1>Adicionar Filmes</h1>
		<form action="filmes_create.php" method="POST">
		<label>Titulo</label><input type="text" name="titulo" required><br>
		<label>Sinopse</label><input type="text" name="sinopse"><br>
		<label>Quantidade</label><input type="text" name="quantidade"><br>
		<label>Idioma</label><input type="text" name="idioma"><br>
		<label>Data Lançamento</label><input type="text" name="data_lancamento"><br>
        <input type="submit" name="enviar">
	</form>
	</body>
	</html>
<?php
}


}//login
else{
	echo 'Para entrar nesta página necessita de efetuar <a href="login.php">login</a>';
	header('refresh:2;url=login.php');
}


?>