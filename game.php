<!DOCTYPE html>
<html>
<head>
	<title>Jogo da Cobrinha</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div id="interface" class="container">
	<canvas id="stage" width="600" height="600"></canvas>
	<script type="text/javascript">
		
		window.onload = function(){
			var stage = document.getElementById('stage');//repera o id do elemento
			var ctx = stage.getContext("2d");//contexto do jogo
			document.addEventListener("keydown", keyPush);
			var tarefa = setInterval(game, 60);

			const vel = 1;//casas que a cobrinha ando por vez
			var vx = 0;//velocidade x
			var vy = 0;//velocidade y
			var px = 10;//posição do eixo x
			var py = 10;//posição do eixo y
			var lp = 20;//tamanho da peça
			var qp = 30;//quantidade de peças tabuleiro
			var ax = 15;//posição do eixo da maça
			var ay = 15;//posição do eixo da maça
			var trail = [];//rastro da cobrinha
			var tail = 5;//calda da cobrinha(tamanho)
			var pause = false;


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

				ctx.fillStyle = "gray";//pinta a cobrinha na tela e verificar o rastro da cobrinha
				for (var i = 0; i < trail.length; i++) {
					ctx.fillRect(trail[i].x*lp,trail[i].y*lp, lp-1, lp-1);
					if (trail[i].x == px && trail[i].y == py) {
						/*Condiição de game over*/
						vx = vy = 0;
						tail = 5;

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
					ax = Math.floor(Math.random()*qp);
					ay = Math.floor(Math.random()*qp);
				}
			}

			function keyPush(event){
				switch(event.keyCode){
					case 37://left
						vx = -vel;
						vy = 0;
						break;
					case 38://up
						vx = 0;
						vy = -vel;
						break;
					case 39://right
						vx = vel;
						vy = 0;
						break;
					case 40://down
						vx = 0;
						vy = vel;
						break;
					case 32://espaço
						if (!pause) {
							clearInterval(tarefa); pause = true;
						}else{
							tarefa = setInterval(game, 60); pause = false;
						}
						break;
					default:
						break;
				}
			}
		}

	</script>
	</div>

</body>
</html>