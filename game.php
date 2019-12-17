<!DOCTYPE html>
<html>
<head>
	<title>Jogo da Cobrinha</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!--Bootstrap-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<!--jquery - pooper.js e bootstrap.min.js-->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>

	<div class="container-fluid">
		<div class="row">
			<div id="pontuacao" class="col-md-3">
				<div>
					<div class="mostrador"><h3 id="pontos">Score:</h3></div>
					<div class="mostrador"><h3 id="nivel">Nivel:</h3></div>
				</div>
				<div class="espaco"></div>
				<div class="row">
					<div id="info">
						<h4>Use a tecla espaço para pausar</h4>
					</div>
				</div>
			</div>
			<div id="tabuleiro" class="col-md-4">
				<canvas id="stage" width="600" height="600"></canvas>
				<script type="text/javascript">
					
					window.onload = function(){
						var stage = document.getElementById('stage');//repera o id do elemento
						var ctx = stage.getContext("2d");//contexto do jogo
						document.addEventListener("keydown", keyPush);
						var tarefa = setInterval(game, 100);

						const vel = 1;//casas que a cobrinha anda por vez
						var vx = 0;//velocidade x
						var vy = 0;//velocidade y
						var px = 10;//posição do eixo x da cabeça da cobinha
						var py = 10;//posição do eixo y
						var lp = 20;//tamanho da peça
						var qp = 30;//quantidade de peças tabuleiro
						var ax = 15;//posição do eixo da maça
						var ay = 15;//posição do eixo da maça
						var trail = [0];//rastro da cobrinha
						var tail = 5;//calda da cobrinha(tamanho)
						var pause = false;
						var pontos = 0;
						//var nivel = 0;


						//movimento da cobrinha
						function game(){
							px +=vx;
							py +=vy;
							if (px <0) {
								px = qp-1;
							}
							if (px > qp-1) {
								px = 0;
							}
							if (py < 0) {
								py = qp-1;
							}
							if (py > qp-1) {
								py = 0;
							}


							ctx.fillStyle = "black";//cor do tabuleiro(stage)
							ctx.fillRect(0,0, stage.width, stage.height);//pinta da cor selecionada

							ctx.fillStyle = "red";//cor da maça
							ctx.fillRect(ax*lp, ay*lp, lp, lp);//pintar a maça

							ctx.fillStyle = "gray";//pinta a cobrinha na tela e verifica o rastro da cobrinha
							for (var i = 0; i < trail.length; i++) {
								tam = trail.length;
								ctx.fillRect(trail[i].x*lp,trail[i].y*lp, lp-1, lp-1);
								if (trail[i].x == px && trail[i].y == py) {
									/*Condiição de game over*/
									vx = vy = 0;
									tail = 5;
									pontos = 0;
									//nivel = 0;

								}
							}
							//desenha rastro da cobrinha na tela e simula o movimento
							trail.push({x:px,y:py})
							while(trail.length > tail) {
								trail.shift();
							}

							//define maça na tela de modo random e aumenta o tamanho da cobrinha quando come a maça
							if (ax == px && ay == py) {
								tail++;
								pontos = pontos + 5;
								document.getElementById("pontos").innerHTML = "Score: "+pontos;
								//nivel++;
								ax = Math.floor(Math.random()*qp);
								ay = Math.floor(Math.random()*qp);
								//console.log(tail);
							}
						}

						function keyPush(event){
							switch(event.keyCode){
								case 37://left
									vx = -vel;
									vy = 0;
									keyCode = 37;
									break;
								case 38://up
									vx = 0;
									vy = -vel;
									keyCode = 38;		
									break;
								case 39://right
									vx = vel;
									vy = 0;
									keyCode = 39;
									break;
								case 40://down
									vx = 0;
									vy = vel;
									keyCode = 40;
									break;
								case 32://espaço
									if (!pause) {
										clearInterval(tarefa); pause = true;
									}else{
										tarefa = setInterval(game, 100); pause = false;
									}
									//console.log(tam);
									break;
								default:
								
									break;
							}
						}
					}

				</script>
			</div>
		</div>	
	</div>
	
</body>
</html>