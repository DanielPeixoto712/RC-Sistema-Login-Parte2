<?php
if($_SERVER['REQUEST_METHOD']=="GET"){


	if (!isset($_GET['ator']) || !is_numeric($_GET['ator'])) {
		echo '<script>alert("Erro ao abrir livro");</script>';
		echo 'Aguarde um momento. A reencaminhar página';
		header("refresh:5; url=index.php");
		exit();

	}
	$idFilme=$_GET['ator'];
	$con=new mysqli("localhost", "root", "","projeto-filmes");

	if($con->connect_errno!=0){
		echo "Ocorreu um erro no acesso á base de dados.<br>" .$con->connect_error;
		exit;
	}
	else{
		$sql='select * from filmes where id_ator = ?';
		$stm = $con->prepare ($sql);
		if ($stm!=false) {
			$stm->bind_param("i", $idAtor);
			$stm->execute();
			$res=$stm->get_result();
			$ator = $res->fetch_assoc();
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
	<h1>Detalhes do ator</h1>

<?php
if (isset($ator)) {
	echo"<br>";
	echo utf8_encode( $ator["nome"]);
	echo "<br>";
	echo utf8_encode( $ator["data_nascimento"]);
	echo "<br>";
	echo $nacionalidade["nacionalidade"];
	echo "<br>";

}
else{
	echo "<h2>Parece que o filme selecionado não existe.<br>Confirme a sua seleção</h2>";
}
?>
</body>
</html>