<?php
	echo '<a href = administrador.php>voltar</a><br><br><br>';
	
	$loop = 0;
	
	foreach($_POST['inputimg'] as $valor){	
		$loop = deletar($valor, $loop);
	}

	function deletar($valor, $loop){
		$valor = $valor - $loop;
		$loop++;
		$arquivo = "imagens/ensaios/videos/".$valor.".mp4";

		include "conexao.php";

		if(file_exists($arquivo)){
			try{
				$conexao = new PDO($dsn, $usuario, $senha);

				//seleciona o id da foto
				$query = "select * from tb_fotos where estilo = 'video' and nome = ".$valor;
				$stmt = $conexao->query($query);
				$id = $stmt->fetch(PDO::FETCH_ASSOC);
				$id = $id['nome'];

				//seleciona o ultimo id do estilo
				$query = "select * from tb_fotos where estilo = 'video' order by nome desc limit 1";
				$stmt = $conexao->query($query);
				$ultimo = $stmt->fetch(PDO::FETCH_ASSOC);
				$ultimo = $ultimo['nome'];
				
				unlink($arquivo);
				
				for($i = $id + 1; $i <= $ultimo; $i++){
					$arquivoVelho = "imagens/ensaios/videos/".$i.".mp4";
					$arquivoNovo = "imagens/ensaios/videos/".($i-1).".mp4";
					//renomeia os arquivos
					rename($arquivoVelho, $arquivoNovo);
				}
				echo "imagem deletada com sucesso";

				$query = "delete from tb_fotos where estilo = 'video' and nome = ".$valor.";update tb_fotos set nome = (nome-1) where estilo = 'video' and nome > ".$id.";";
				$stmt = $conexao->query($query);

				return $loop;
			}
			
			catch(PDOException $e){
				echo 'Erro: '.$e->getCode().'<br>Mensagem: <p>' .$e->getMessage().'</p>';
				echo "erro ao deletar musica, arquivo existe mas não consta no banco de dados";
			}	
		}
		else{
			echo "arquivo ".$arquivo." não existe <br>";
		}
	}
?>