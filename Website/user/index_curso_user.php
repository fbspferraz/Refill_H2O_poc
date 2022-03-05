<!DOCTYPE html>
<html>
<head>
	<title>Refill H2O</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<input type="checkbox" id="checkbox">
	<header class="header">
		<h2 class="u-name">Refill <b>H2O</b>
			<label for="checkbox">
				<i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
			</label>
		</h2>
	</header>
	<div class="body">
		<nav class="side-bar">
			<div class="user-p">
				<img src="img/ipvc.jpg">
				<h4>Instituto Politécnico de Viana do Castelo</h4>
			</div>
			<ul>
				<li>
					<div class="dropdown">
						<a><i class="fa fa-tachometer" aria-hidden="true"></i></a>
						<button class="dropbtn">Dashboard
						  <i class="fa fa-caret-down"></i>
						</button>
						<div class="dropdown-content">
						  <a href="index_instituto_user.php">Enchimentos no instituto</a>
						  <a href="index_unidade_user.php">Enchimentos por unidade orgânica</a>
						  <a href="index_curso_user.php">Enchimentos por curso</a>
						  <a href="index_turma_user.php">Enchimentos por turma</a>
						  <a href="index_agua_user.php">Quantidade de água consumida no instituto</a>
						</div>
					  </div>				
				</li>
				<li>
					<a href="index_metricas_user.php">
						<i class="fa fa-desktop" aria-hidden="true"></i>
						<span>Métricas gerais</span>
					</a>
				</li>
				<li>
					<a href="index_user.php">
						<i class="fa fa-user-circle" aria-hidden="true"></i>
						<span>Dashboard pessoal</span>
					</a>
				</li>
				<li>
					<a href="../index_instituto.php">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						<span>Logout</span>
					</a>
				</li>
			</ul>
		</nav>
		<section class="section-1">
				<span class="text2">
					Selecione uma unidade orgânica:
					<select class="text1" name="uniOrganica" id="uniOrganica" onchange="changeCurso()">
						<option value="1">ESTG</option>
						<option value="2">ESE</option>
						<option value="3">ESS</option>
						<option value="4">SAS</option>
				</select>
				</span>
		
				<span class="text2">
				Selecione um curso:
				<select class="text1" name="curso" id="curso" onchange="changeCurso()">
					<option value="0">Curso Non-Defined</option>
					<option value="1">Engenharia de Redes e Sistemas de Computadores</option>
					<option value="2">Educação Básica</option>
					<option value="3">Enfermagem</option>
				</select>
			</span>
			
			<iframe id="iframeGraphic" src="http://62.28.241.83:3000/d-solo/CS4T2cznk/refill_2?orgId=1&from=1624858328038&to=1624944728039&var-Curso=0&var-Turma=&var-UnidadeOrganica=1&var-User=&panelId=12" width="600" height="350" frameborder="1"></iframe>
		</section>
	</div>
</body>
<script src="js/main.js"></script>
</html>