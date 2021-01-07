<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {
	$nome="";
	$nacionalidade="";

	


	if (isset($_POST['nome'])) {
		$nome=$_POST['nome'];
	}
	else{
		echo '<script>alert("É obrigatório o preenchimento do nome.");</script>';
	}
	if (isset($_POST['nacionalidade'])) {
		$sinopse=$_POST["nacionalidade"];
	}
	

	$con=new mysqli("localhost","root", "","projeto-filmes");

	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados. <br>".$con->connect_error;
		exit;
	}
	else{
		$sql="update into realizadores (nome, nacionalidade) values (?,?)";
		$stm=$con->prepare($sql);

			
			if ($stm!=false) {
				$stm->bind_param("ssssi", $nome, $nacionalidade);
				$stm->execute();
				$stm->close();
				echo '<script>alert("Realizador alterado com sucesso!!")</script>';
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
