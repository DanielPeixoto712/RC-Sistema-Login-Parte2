<?php


session_start();

if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if ($_SESSION['login']=="correto" && isset($_SESSION['login'])) {
	//aqui colocamos o conteudo



if($_SERVER['REQUEST_METHOD']=="GET"){


	if (!isset($_GET['realizador']) || !is_numeric($_GET['realizador'])) {
		echo '<script>alert("Erro ao abrir livro");</script>';
		echo 'Aguarde um momento. A reencaminhar página';
		header("refresh:5; url=index.php");
		exit();

	}
	$idFilme=$_GET['realizador'];
	$con=new mysqli("localhost", "root", "","projeto-filmes");

	if($con->connect_errno!=0){
		echo "Ocorreu um erro no acesso á base de dados.<br>" .$con->connect_error;
		exit;
	}
	else{
		$sql='select * from realizadores where id_realizador = ?';
		$stm = $con->prepare ($sql);
		if ($stm!=false) {
			$stm->bind_param("i", $idRealizador);
			$stm->execute();
			$res=$stm->get_result();
			$realizador = $res->fetch_assoc();
			$stm->close();
		}
		else{
			echo "<br>";
			echo ($con->error);
			echo "<br>";
			echo "Aguarde um momento. A reencaminhar página";
			echo "<br>";
			header("refresh:5;url=index.php");
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Detalhes</title>
</head>
<body>
	<h1>Detalhes do realizador</h1>

<?php
if (isset($realizador)) {
	echo"<br>";
	echo utf8_encode( $realizador["nome"]);
	echo "<br>";
	echo $nacionalidade["nacionalidade"];
	echo "<br>";

}
else{
	echo "<h2>Parece que o realizador selecionado não existe.<br>Confirme a sua seleção</h2>";
}
?>
</body>
</html>

<?php

}//login
else{
	echo 'Para entrar nesta página necessita de efetuar <a href="login.php">login</a>';
	header('refresh:2;url=login.php');
}

?>



