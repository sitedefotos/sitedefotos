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
		 
		    // Somente imagens, .jpg;.jpeg;.gif;.png
		    // Aqui eu enfileiro as extensões permitidas e separo por ';'
		    // Isso serve apenas para eu poder pesquisar dentro desta String
		    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {

		 		$tamanho = $arquivo['size'][$i];
		 		$estilo = $_POST['estilo'];

	 			include "conexao.php";

				//seleciona o nome mais alto (ultimo) das fotos do estilo escolhido
				$query = "select * from tb_fotos where estilo = '".$estilo."' order by nome desc limit 1";
				try{
					$conexao = new PDO($dsn, $usuario, $senha);

					$stmt = $conexao->query($query);
					$ultimoNome = $stmt->fetch(PDO::FETCH_ASSOC);

					$ultimoNome = $ultimoNome['nome'];

				} catch(PDOException $e){
					echo 'Erro: '.$e->getCode().'<br>Mensagem: <p>' .$e->getMessage().'</p>';
				}

		        $novoNome = (intval($ultimoNome)+1);
				
				// Concatena a pasta com o nome
		        $destino = 'imagens/ensaios/'.$_POST['estilo'].'/'.$novoNome.$extensao;
		        // tenta mover o arquivo para o destino
		        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
		        	$query = '
			 		insert into tb_fotos(nome, extensao, tamanho, estilo) values('.$novoNome.',"'.$extensao.'",'.$tamanho.',"'.$estilo.'");';
					$conexao->exec($query);
					
		            echo '<br>Arquivo salvo com sucesso em : <strong>' . $destino . '</strong><br />';
		            echo ' < img src = "' . $destino . '" />';

			 		echo '<br>o novo nome da foto é:   '.$novoNome;
			 		echo '<br>o tamanho da foto é:   '.($tamanho/1000).'Kb';
			 		echo '<br>a extensao da foto é:   '.$extensao;
			 		echo '<br>o estilo da foto é:   '.$estilo;
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