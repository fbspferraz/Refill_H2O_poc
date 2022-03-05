<!DOCTYPE html>
<html>
<head>
	<title>Refill H2O</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body onload="changeUser();">
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
		<section class="section-1 left">
			<span for="start" class="text2">Data de início:</label>
			<input class="text1" type="date" id="start" name="start" onchange="changeUser()">
			<span for="end" class="text2">Data de fim:</label>
			<input class="text1" type="date" id="end" name="end" onchange="changeUser()">
		</section>
		<section class="section-1 right">
			<iframe id="iframeGraphic" src="http://62.28.241.83:3000/d-solo/CS4T2cznk/refill_2?orgId=1&from=1622487071256&to=1625079071256&var-Curso=&var-Turma=&var-UnidadeOrganica=&var-User=<?php session_start(); echo $_SESSION["n_meca"];?>&panelId=14" width="600" height="350" frameborder="1"></iframe>
		</section>
	</div>
</body>
<script>
   var user = '<?php echo $_SESSION["n_meca"];?>';
</script>
<script src="js/main.js"></script>
</html>

