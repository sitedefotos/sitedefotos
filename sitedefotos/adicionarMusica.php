<?php

	// verifica se foi enviado um arquivo
	echo '<a href = administrador.php>voltar</a><br><br><br>';
	$arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : false;

	for($i = 0; $i < count($arquivo['name']); $i++){	
		if ( isset( $arquivo[ 'name' ][$i] ) && $arquivo[ 'error' ][$i] == 0 ) {
		    $arquivo_tmp = $arquivo[ 'tmp_name' ][$i];
			$nome = $arquivo[ 'name' ][$i];

		    // Pega a extensão
		    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
		 
		    // Converte a extensão para minúsculo
		    $extensao = ".".strtolower ( $extensao );
		 
		    // Somente arquivo .mp3 será aceito
		    if ( strstr ( '.mp3', $extensao ) ) {

	 			include "conexao.php";

				//seleciona o ultimo id das musicas (quantidade de musicas)
				$query = "select * from musicas order by id desc limit 1";
				try{
					$conexao = new PDO($dsn, $usuario, $senha);

					$stmt = $conexao->query($query);
					$ultimoId = $stmt->fetch(PDO::FETCH_ASSOC);
					$ultimoId = $ultimoId['id'];
					
				} catch(PDOException $e){
					echo 'Erro: '.$e->getCode().'<br>Mensagem: <p>' .$e->getMessage().'</p>';
				}

		        $novoId = (intval($ultimoId)+1);
				
				// Concatena a pasta com o nome
		        $destino = 'musicas/'.$novoId.'.mp3';
		        // tenta mover o arquivo para o destino
		        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
		        	$query = '
			 		insert into musicas(id, nome) values('.$novoId.',"'.$arquivo[ 'name' ][$i].'");';
					$conexao->exec($query);

		            echo 'Arquivo salvo com sucesso em : <strong>' . $destino . '</strong><br />';
		            
			 		echo '<br>o novo id é:   '.$novoId;
			 		echo '<br>o nome é:   '.$arquivo[ 'name' ][$i];
			 		echo '<br><br><br>';
		        }
		        else
		            echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
		    }
		    else
		        echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
		}
		else
		    echo 'Você não enviou nenhum arquivo!';
	}
?>