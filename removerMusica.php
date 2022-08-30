<?php
	echo '<a href = administrador.php>voltar</a><br><br><br>';
	$numeroMusica = $_POST['numeroMusica'];
	$arquivo = "musicas/".$numeroMusica.".mp3";

	if(file_exists($arquivo)){
		
		include "conexao.php";

		try{
			$conexao = new PDO($dsn, $usuario, $senha);

			//seleciona a musica com id escolhido
			$query = "select * from musicas where id = ".$numeroMusica;
			$stmt = $conexao->query($query);
			$musica = $stmt->fetch(PDO::FETCH_ASSOC);
			$musica = $musica['nome'];

			$query = "select * from musicas order by id desc limit 1";
			$stmt = $conexao->query($query);
			$ultimo = $stmt->fetch(PDO::FETCH_ASSOC);
			$ultimo = $ultimo['id'];
			
			unlink($arquivo);
			
			for($i = $numeroMusica + 1; $i <= $ultimo; $i++){
				$arquivoVelho = "musicas/".$i.".mp3";
				$arquivoNovo = "musicas/".($i-1).".mp3";
				//renomeia os arquivos
				rename($arquivoVelho, $arquivoNovo);
			}
			echo "a musica (".$musica.") foi deletada com sucesso";

			$query = "delete from musicas where id = ".$numeroMusica.";update musicas set id = (id-1) where id > ".$numeroMusica.";";
			$stmt = $conexao->query($query);
		}
		catch(PDOException $e){
			echo 'Erro: '.$e->getCode().'<br>Mensagem: <p>' .$e->getMessage().'</p>';
			echo "erro ao deletar musica, arquivo existe mas não consta no banco de dados";
		}	
	}
	else{
		echo "arquivo não existe";
	}
?>