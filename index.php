<?php
$con=new mysqli("localhost","root", "","projeto-filmes");
if($con->connect_errno!=0){
	echo "Ocorreu um erro no acesso á base de dados".$con->connect_error;
	exit;
}
else {
	?>
	<!DOCTYPE html>
	<html style="background-color:#A4A4A4">
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
			echo '<a href="filmes_edit.php?filme='.$resultado['id_filme'].'"><li>Editar</li></a>';
			echo "<br>";
		}
		$stm->close();
		?>
	
	<a  href="filmes_create.php" ><h4>Adicionar Filme</h4></a>
	


	<h1>Lista de Atores</h1>
		<?php
		$stm=$con->prepare('select * from atores');
		if ($stm!=false) {
			$stm->execute();
		$res=$stm->get_result();
		while($resultado = $res->fetch_assoc()){
			echo '<a href="atores_show.php?ator='.$resultado['id_ator'].'">';
			echo $resultado["nome"];
			echo "</a>";
			echo '<a href="atores_edit.php?ator='.$resultado['id_ator'].'"><li>Editar</li></a>';
			echo "<br>";

					}
		$stm->close();
		}
		?>
		<a  href="atores_create.php" ><h4>Adicionar Ator</h4></a>


		<h1>Lista de Realizadores</h1>
		<?php
		$stm=$con->prepare('select * from realizadores');
		if ($stm!=false) {
			$stm->execute();
		$res=$stm->get_result();
		while($resultado = $res->fetch_assoc()){
			echo '<a href="realizadores_show.php?realizador='.$resultado['id_realizador'].'">';
			echo $resultado["nome"];
			echo "</a>";
			echo '<a href="realizadores_edit.php?realizador='.$resultado['id_realizador'].'"><li>Editar</li></a>';
			echo "<br>";

					}
		$stm->close();
		}
		?>
		<a  href="realizadores_create.php" ><h4>Adicionar Realizador</h4></a>



	</body>
	</html>
	

	<?php
}//end if - if($con->connect_errno!=0)
?>