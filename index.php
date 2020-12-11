<?php
$con=new mysqli("localhost","root", "","projeto-filmes");
if($con->connect_errno!=0){
	echo "Ocorreu um erro no acesso á base de dados".$con->connect_error;
	exit;
}
else {
	?>
	<!DOCTYPE html>
	<html>
	<head>
	<meta charset="ISO-8859-1">
	<title>filmes</title>
	</head>
	<body>
		<h1>Lista de Filmes</h1>
		<?php
		$stm=$con->prepare('select * from filmes');
		$stm->execute();
		$res=$stm->get_result();
		while($resultado = $res->fetch_assoc()){
			echo '<a href="filmes_show.php?filme='.$resultado['id_filme'].'">';
			echo $resultado["titulo"];
			echo "</a>";
			echo "<br>";
		}
		$stm->close();
		?>

	<br>
	<a href="filmes_create.php" >Adicionar Filme</a>
	</body>
	</html>
	

	<?php
}//end if - if($con->connect_errno!=0)
?>