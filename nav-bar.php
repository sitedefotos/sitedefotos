<nav class="navbar navbar-expand-md navbar-dark bg-dark esconder-nav">
	<!-- logo -->
	<a href="index.php">
	<img href="index.php" src="imagens/logo.png" height="50px"/>
	</a>
	
	<!-- botão -->
    <button class="navbar-toggler" data-toggle="collapse" 
    data-target="#navegacao">
        <span class="navbar-toggler-icon"></span>
    </button>
	<!-- navegação -->
	<div class="collapse navbar-collapse" id="navegacao">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<audio style="width: 250px; height: 40px" id="audio" controls></audio>
			</li>
			<li class="nav-item">
				<a href="index.php" class="nav-link">home</a>
			</li>
			<li class="nav-item">
				<a href="casamento.php" class="nav-link">casamento</a>
			</li>
			<li class="nav-item">
				<a href="sensual.php" class="nav-link">sensual</a>
			</li>
			<li class="nav-item">
				<a href="pin-up.php" class="nav-link">pin-up</a>
			</li>
			<li class="nav-item">
				<a href="15-anos.php" class="nav-link">15 anos</a>
			</li>
			<li class="nav-item">
				<a href="videos.php" class="nav-link">videos</a>
			</li>
		</ul>
	</div>
</nav>
<?php 

	include "conexao.php";

	//seleciona o nome mais alto (ultimo) das fotos do estilo escolhido
	$query = "select * from musicas order by id desc limit 1";
	try{
		$conexao = new PDO($dsn, $usuario, $senha);

		$stmt = $conexao->query($query);
		$ultimoId = $stmt->fetch(PDO::FETCH_ASSOC);

		$ultimoId= $ultimoId['id'];

	} catch(PDOException $e){
		echo 'Erro: '.$e->getCode().'<br>Mensagem: <p>' .$e->getMessage().'</p>';
	}
	//gambiarra para passar a quantidade de musicas do php para o JS
	echo "<div id='totalMusicas' hidden>".$ultimoId."</div>";
?>
<script type="text/javascript">

	var totalMusicas = document.getElementById("totalMusicas")
	totalMusicas = parseInt(totalMusicas.innerText)

	var audio = document.getElementById("audio");
	var indice = 0
	var lista = []
	//adiciona as musicas na lista de musicas
	for(var i = 0; i < totalMusicas; i++){
		lista.push("musicas/"+(i+1)+".mp3")
	}
	
	audio.volume = 0.2;

	function proximoAudio(){

		audio.src = lista[indice]
		indice++
		audio.play()	
		
		if(indice >= lista.length){
			indice = 0
		}
		audio.addEventListener("ended", proximoAudio)
	}

	proximoAudio()
</script>