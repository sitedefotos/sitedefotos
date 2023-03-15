<?php

	//verifica se foi enviado um arquivo
	$arquivo = isset($_FILES['mudarBackground']) ? $_FILES['mudarBackground'] : false;
	
	if ( isset( $arquivo[ 'name' ]) && $arquivo[ 'error' ] == 0 ) {
	    $arquivo_tmp = $arquivo[ 'tmp_name' ];
	   
	    //Pega a extensão
	    $extensao = pathinfo ( $arquivo[ 'name' ], PATHINFO_EXTENSION);
	 
	    //Converte a extensão para minúsculo
	    $extensao = strtolower ( $extensao );
	 
	    //Somente imagens, .jpg;.jpeg;.gif;.png
	    //Aqui eu enfileiro as extensões permitidas e separo por ';'
	    //Isso serve apenas para eu poder pesquisar dentro desta String
	    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {

	        //o caminho até a pasta imagens com nome background concatenado a extensao
	        $destino = 'imagens/background.jpg';

			unlink('imagens/background.jpg');
	        //tenta mover o arquivo para o destino
			 @move_uploaded_file ( $arquivo_tmp, $destino );
	    }
	    else
	        echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
	}
	else
	    echo 'Você não enviou nenhum arquivo!';
	header('location: administrador.php');
?>