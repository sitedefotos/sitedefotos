<?php
	echo '<a href = administrador.php>voltar</a><br><br><br>';
	if($_POST["novaSenha"] != ""){
		
		include "conexao.php";

		try{
			$conexao = new PDO($dsn, $usuario, $senha);

			$query= "update senha set senha='".$_POST["novaSenha"]."'";
			$stmt = $conexao->query($query);
			echo "nova senha definida como:  ".$_POST["novaSenha"];
		}
		catch(PDOException $e){
			echo 'Erro: '.$e->getCode().'<br>Mensagem: <p>' .$e->getMessage().'</p>';
			echo "erro ao deletar musica, arquivo existe mas não consta no banco de dados";
		}	
	}
	else{
		echo "erro ao mudar a senha";
	}

?>