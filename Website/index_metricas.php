<!DOCTYPE html>
<html>
<head>
	<title>Refill H2O</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body onload="changeMetrica();">
	<input type="checkbox" id="checkbox">
	<header class="header">
		<h2 class="u-name">Refill <b>H2O</b>
			<label for="checkbox">
				<i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
			</label>
		</h2>
		<a href="login_form.php">
			<i class="fa fa-user" aria-hidden="true"></i>
		</a>
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
                            <a href="index_instituto.php">Enchimentos no instituto</a>
                            <a href="index_unidade.php">Enchimentos por unidade orgânica</a>
                            <a href="index_curso.php">Enchimentos por curso</a>
                            <a href="index_turma.php">Enchimentos por turma</a>
                            <a href="index_agua.php">Quantidade de água consumida no instituto</a>
						</div>
					  </div>				
				</li>
				<li>
					<a href="index_metricas.php">
						<i class="fa fa-desktop" aria-hidden="true"></i>
						<span>Métricas gerais</span>
					</a>
				</li>

			</ul>
		</nav>
		<section class="section-1 left">
			<span for="start" class="text2">Data de início:</label>
			<input class="text1" type="date" id="start" name="start" onchange="changeMetrica()">
			<span for="end" class="text2">Data de fim:</label>
			<input class="text1" type="date" id="end" name="end" onchange="changeMetrica()">
		</section>
		<section class="section-1 right">
			<iframe id="iframeGraphic1" src="http://62.28.241.83:3000/d-solo/CS4T2cznk/refill_2?orgId=1&from=1624858890043&to=1624945290043&var-Curso=&var-Turma=&var-UnidadeOrganica=&var-User=&panelId=2" width="450" height="200" frameborder="1"></iframe>
			<iframe id="iframeGraphic2" src="http://62.28.241.83:3000/d-solo/CS4T2cznk/refill_2?orgId=1&from=1624858989030&to=1624945389030&var-Curso=&var-Turma=&var-UnidadeOrganica=&var-User=&panelId=4" width="450" height="200" frameborder="1"></iframe>
			<iframe id="iframeGraphic3" src="http://62.28.241.83:3000/d-solo/CS4T2cznk/refill_2?orgId=1&from=1624859032238&to=1624945432238&var-Curso=&var-Turma=&var-UnidadeOrganica=&var-User=&panelId=6" width="450" height="200" frameborder="1"></iframe>
		</section>
	</div>
</body>
<script src="js/main.js"></script>
</html>