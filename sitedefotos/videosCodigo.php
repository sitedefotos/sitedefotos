<div id="mural" class="d-flex justify-content-center">
	<!-- seta -->
	<div class="d-flex flex-column justify-content-center setaEsquerda">
		<button id="setaEsquerda">
			<img src="imagens/esquerda.png" onclick="imagensAnteriores()">
		</button>
	</div>
	<!-- fotos -->
	<div class="d-flex flex-column justify-content-center h-100">
		<div id="mural-de-fotos" class="d-flex flex-wrap justify-content-center h-100">
			<div id="div1" class="div-foto">
				<video id="img1" src="" controls class="foto" type="video/mp4"></video>
			</div>
			<div id="div2" class="div-foto">
				<video id="img2" src="" controls class="foto" type="video/mp4"></video>
			</div>
			<div id="div3" class="div-foto">
				<video id="img3" src="" controls class="foto" type="video/mp4"></video>
			</div>
			<div id="div4" class="div-foto">
				<video id="img4" src="" controls class="foto" type="video/mp4"></video>
			</div>
			<div id="div5" class="div-foto">
				<video id="img5" src="" controls class="foto" type="video/mp4"></video>
			</div>
			<div id="div6" class="div-foto">
				<video id="img6" src="" controls class="foto" type="video/mp4"></video>
			</div>
		</div>
	</div>
	<div id="div-expandida" class="esconder" onclick="retrair()">
		<div class="fundo"></div>
		<img id="img-expandida" onclick="retrair()">
	</div>
	<!-- seta -->
	<div class="d-flex flex-column justify-content-center setaDireita">
		<button class="seta" id="setaDireita">
			<img src="imagens/direita.png" onclick="imagensSeguintes()">
		</button>
	</div>
</div>
<!-- navegação de fotos -->
<form class="w-100 navegacao">
	<div class="d-flex justify-content-center">
		<input id="pagina" required type="number" name="idFoto" placeholder="numero da foto">
		<div class="div-pular bg-dark rounded" onclick="mudarPagina(parseInt(document.getElementById('pagina').value))">
			<p class="centralizar">pular para</p>
		</div>
	</div>
</form>

<audio id="flash" class="esconder"></audio>


<script type="text/javascript">

	var totalFotos = 1

	//quantidade de imagens usada para passar as imagens
	var quantImagens
	var imagem = [""]

	//verifica se a primeira imagem -1 e a ultima imagem +1, caso não existam ela esconde a seta
	function esconderSeta(){
		//string do endereço da imagem
		var strFoto = document.getElementById("img1").getAttribute("src")
		//posição do ponto
		var indicePonto = strFoto.indexOf(".") //30
		//posição da ultima barra
		var indiceBarra = strFoto.lastIndexOf("/") //26
		//substring com o numero da primeira foto da pagina
		var numeroFoto = parseInt(strFoto.substr((indiceBarra+1), (indicePonto - indiceBarra-1)))

		if(numeroFoto >= totalFotos){
			document.getElementById("setaEsquerda").className = "seta esconder"
		}
		else{
			document.getElementById("setaEsquerda").className = "seta"
		}
		
		if(numeroFoto - quantImagens >= 1){
			document.getElementById("setaDireita").className = "seta"
		}
		else{
			document.getElementById("setaDireita").className = "seta esconder"
		}
		esconderImagens()
	}
	//ajusta a quantidade, tamanho e posição das imagens para varias telas
	function ajustarImagens(){
		if(window.innerWidth >= 920){
			document.getElementById("mural").className = "d-flex flex-column flex-wrap justify-content-around mural-largo"
		}
		else{
			document.getElementById("mural").className = "d-flex flex-column flex-wrap justify-content-around mural-fino"
		}

		//tela alta possui 2 linhas de fotos
		if(window.innerHeight >= 880){
			
			if(window.innerWidth >= 1600){
				//3 colunas de fotos
				quantImagens = 6

				document.getElementById("div1").className ="div-foto"
				document.getElementById("div2").className ="div-foto"
				document.getElementById("div3").className ="div-foto"
				document.getElementById("div4").className ="div-foto"
				document.getElementById("div5").className ="div-foto"
				document.getElementById("div6").className ="div-foto"
			}
			else if(window.innerWidth >= 1117){
				//2 colunas de fotos
				quantImagens = 4

				document.getElementById("div1").className ="div-foto"
				document.getElementById("div2").className ="div-foto"
				document.getElementById("div3").className ="div-foto"
				document.getElementById("div4").className ="div-foto"
				document.getElementById("div5").className ="div-foto esconder"
				document.getElementById("div6").className ="div-foto esconder"
			}
			else if(window.innerWidth >= 680){
				//1 coluna de fotos
				quantImagens = 2

				document.getElementById("div1").className ="div-foto"
				document.getElementById("div2").className ="div-foto"
				document.getElementById("div3").className ="div-foto esconder"
				document.getElementById("div4").className ="div-foto esconder"
				document.getElementById("div5").className ="div-foto esconder"
				document.getElementById("div6").className ="div-foto esconder"
			}
			else{
				//1 coluna de foto com tamanho menor
				quantImagens = 2

				document.getElementById("div1").className ="div-foto-menor"
				document.getElementById("div2").className ="div-foto-menor"
				document.getElementById("div3").className ="div-foto esconder"
				document.getElementById("div4").className ="div-foto esconder"
				document.getElementById("div5").className ="div-foto esconder"
				document.getElementById("div6").className ="div-foto esconder"
			}
		}

		//tela baixa, possui uma linha de fotos
		else if(window.innerHeight >= 520){
			
			if(window.innerWidth >= 1600){
				//3 colunas de fotos
				quantImagens = 3

				document.getElementById("div1").className ="div-foto"
				document.getElementById("div2").className ="div-foto"
				document.getElementById("div3").className ="div-foto"
				document.getElementById("div4").className ="div-foto esconder"
				document.getElementById("div5").className ="div-foto esconder"
				document.getElementById("div6").className ="div-foto esconder"
			}
			else if(window.innerWidth >= 1116){
				//2 colunas de fotos
				quantImagens = 2

				document.getElementById("div1").className ="div-foto"
				document.getElementById("div2").className ="div-foto"
				document.getElementById("div3").className ="div-foto esconder"
				document.getElementById("div4").className ="div-foto esconder"
				document.getElementById("div5").className ="div-foto esconder"
				document.getElementById("div6").className ="div-foto esconder"
			}
			else if(window.innerWidth >= 680){
				//1 coluna de fotos
				quantImagens = 1

				document.getElementById("div1").className ="div-foto"
				document.getElementById("div2").className ="div-foto esconder"
				document.getElementById("div3").className ="div-foto esconder"
				document.getElementById("div4").className ="div-foto esconder"
				document.getElementById("div5").className ="div-foto esconder"
				document.getElementById("div6").className ="div-foto esconder"
			}
			else{
				//1 colunas de foto com tamanho menor
				quantImagens = 1

				document.getElementById("div1").className ="div-foto-menor"
				document.getElementById("div2").className ="div-foto esconder"
				document.getElementById("div3").className ="div-foto esconder"
				document.getElementById("div4").className ="div-foto esconder"
				document.getElementById("div5").className ="div-foto esconder"
				document.getElementById("div6").className ="div-foto esconder"
			}
		}
		esconderSeta()
	}
	//inicia as imagens
	function iniciarImagens(){
		var i = totalFotos
		for(var n = 1; n <= 6; n++){ 
			var id = "img"+n
			imagem[n] = "imagens/ensaios/videos/" + i +".mp4";

			if(n <= totalFotos){
				document.getElementById(id).setAttribute("src", imagem[n])
				orientacao(id)	
			}
			i--
		}

		ajustarImagens()
	}
	//passa as fotos
	function imagensSeguintes(){
		//string do endereço da imagem
		var strFoto = document.getElementById("img1").getAttribute("src")
		//posição do ponto
		var indicePonto = strFoto.indexOf(".") //30
		//posição da ultima barra
		var indiceBarra = strFoto.lastIndexOf("/") //26
		//substring com o numero da primeira foto da pagina
		var numeroFoto = strFoto.substr((indiceBarra+1), (indicePonto - indiceBarra-1))
		//soma o numero da primeira foto com a quantidade de fotos
		var novoNumero = eval(numeroFoto + " - " + quantImagens)
		//substitui o numero da foto pelo novo numero
		strFoto = strFoto.replace(numeroFoto, novoNumero)

		for (var i = 6 ; i >= 1; i--) {
			var id = "img" + i
			if((novoNumero + 1 - i) < 1){	
				imagem[i]=""
				
				document.getElementById(id).className="foto";
				imagem[i] = ""
				
			}
			else{
				document.getElementById(id).className="foto";
				imagem[i]="imagens/ensaios/videos/" + (novoNumero + 1 - i) + ".mp4"
			}
		}

		document.getElementById("img1").setAttribute("src", imagem[1]);
		document.getElementById("img2").setAttribute("src", imagem[2]);
		document.getElementById("img3").setAttribute("src", imagem[3]);
		document.getElementById("img4").setAttribute("src", imagem[4]);
		document.getElementById("img5").setAttribute("src", imagem[5]);
		document.getElementById("img6").setAttribute("src", imagem[6]);

		for(var n = 1; n <= 6; n++){ 
			var id = "img"+n
			if(imagem[n] != ""){
				orientacao(id)
			}
		}

		esconderSeta()
	}
	//volta as fotos anteriores
	function imagensAnteriores(){
		//string do endereço da imagem
		var strFoto = document.getElementById("img1").getAttribute("src")
		//posição do ponto
		var indicePonto = strFoto.indexOf(".") //30
		//posição da ultima barra
		var indiceBarra = strFoto.lastIndexOf("/") //26
		//substring com o numero da primeira foto da pagina
		var numeroFoto = strFoto.substr((indiceBarra+1), (indicePonto - indiceBarra-1))
		//sutrai o numero da primeira foto com a quantidade de fotos
		var novoNumero = eval(numeroFoto + " + " + quantImagens)	
		
		if((novoNumero) >= totalFotos){	
			iniciarImagens()
		}
		else{
			for (var i = 6; i >= 1; i--) {

				imagem[i]="imagens/ensaios/videos/" + (novoNumero + 1 - i) + ".mp4"
			}
		}

		document.getElementById("img1").setAttribute("src", imagem[1]);
		document.getElementById("img2").setAttribute("src", imagem[2]);
		document.getElementById("img3").setAttribute("src", imagem[3]);
		document.getElementById("img4").setAttribute("src", imagem[4]);
		document.getElementById("img5").setAttribute("src", imagem[5]);
		document.getElementById("img6").setAttribute("src", imagem[6]);

		for(var n = 1; n <= 6; n++){ 
			var id = "img"+n
			if(imagem[n] != ""){
				orientacao(id)
			}
		}

		esconderSeta()
	}
	//indica se a imagem é horizontal ou vertical (quadrada -> vertical)
	function orientacao(id){
		var newImage = new Image()
		newImage.src = document.getElementById(id).getAttribute("src")

		newImage.onload = function(){
			var largura = document.getElementById(id).naturalWidth
			var altura = document.getElementById(id).naturalHeight

			
			if(largura > altura){
				document.getElementById(id).className = "foto horizontal"
			}
			if(altura >= largura){
				document.getElementById(id).className = "foto vertical"
			}
		}	
	}

	function retrair(){
		document.getElementById("div-expandida").className = "esconder"
		document.getElementById("img-expandida").className = "esconder"
	}
	function expandir(id){
		
		flash = document.getElementById("flash");
		flash.src = "flash.mp3"
		flash.play()

		//iniciar transição

		var imagem = document.getElementById(id).getAttribute("src")
		document.getElementById("img-expandida").setAttribute("src", imagem)
		document.getElementById("div-expandida").className = "div-sobrepor"
		
		if(document.getElementById(id).className.includes("vertical")){
			document.getElementById("img-expandida").className = "img-sobrepor vertical-sobrepor"
		}
		else{
			document.getElementById("img-expandida").className = "img-sobrepor horizontal-sobrepor"
		}
	}
	document.addEventListener("keydown", function(tecla){
		if(tecla.keyCode == 27){
			retrair()
		}
	})

	function mudarPagina(novaPagina){
		novaPagina = totalFotos - novaPagina + 1
		//checa se é um valor valido, ajusta caso não seja
		if(novaPagina > totalFotos){
			novaPagina = totalFotos
		}
		if (novaPagina <= quantImagens || !Number.isInteger(novaPagina)){
			novaPagina = quantImagens
		}
		
		for(var n = 1; n <= 6; n++){ 
			
			var id = "img"+n

			imagem[n] = "imagens/ensaios/" + diretorio + "/" + (novaPagina - n + 1) +".jpg";

			if((novaPagina - n + 1) >= 1){
				document.getElementById(id).setAttribute("src", imagem[n])	
			}
			else{
				document.getElementById(id).setAttribute("src", "")
			}

			if(imagem[n] != ""){
				orientacao(id)
			}
		}
		
		document.getElementById("pagina").placeholder = novaPagina

		ajustarImagens()
		esconderSeta()
	}
	function esconderImagens(){
		for(var i = 1; i <= 6; i++){
			var id = "img" + i 

			if(document.getElementById(id).getAttribute("src") == ""){
				document.getElementById(id).className = "esconder"
			} 
		}
	}
	iniciarImagens()
</script>