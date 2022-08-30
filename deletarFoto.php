<?php
	echo '<a href = administrador.php>voltar</a><br><br><br>';

	$estilo = $_POST['estilo'];

	$loop = 0;
	
	foreach($_POST['inputimg'] as $valor){	
		$loop = deletar($valor, $loop);
	}

	function deletar($valor, $loop){
		$valor = $valor - $loop;
		$loop++;
		$arquivo = "imagens/ensaios/".$_POST['estilo']."/".$valor.".jpg";
		
		include "conexao.php";

		if(file_exists($arquivo)){
			try{
				$conexao = new PDO($dsn, $usuario, $senha);

				//seleciona o id da foto
				$query = "select * from tb_fotos where estilo = '".$_POST['estilo']."' and nome = ".$valor;
				$stmt = $conexao->query($query);
				$id = $stmt->fetch(PDO::FETCH_ASSOC);
				$id = $id['nome'];

				//seleciona o ultimo id do estilo
				$query = "select * from tb_fotos where estilo = '".$_POST['estilo']."' order by nome desc limit 1";
				$stmt = $conexao->query($query);
				$ultimo = $stmt->fetch(PDO::FETCH_ASSOC);
				$ultimo = $ultimo['nome'];
				
				unlink($arquivo);
				
				for($i = $id + 1; $i <= $ultimo; $i++){
					$arquivoVelho = "imagens/ensaios/".$_POST['estilo']."/".$i.".jpg";
					$arquivoNovo = "imagens/ensaios/".$_POST['estilo']."/".($i-1).".jpg";
					//renomeia os arquivos
					rename($arquivoVelho, $arquivoNovo);
				}
				echo "imagem deletada com sucesso";

				$query = "delete from tb_fotos where estilo = '".$_POST['estilo']."' and nome = ".$valor.";update tb_fotos set nome = (nome-1) where estilo = '".$_POST['estilo']."' and nome > ".$id.";";
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
