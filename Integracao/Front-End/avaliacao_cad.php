<!DOCTYPE html>
<?php
	date_default_timezone_set('America/Sao_Paulo');
?>
<html>
<head>
	<title>Cadastro de Avaliações</title>
	<meta charset="utf-8">

	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
	<div class="container">
		<form action="avaliacao_pdo.php" method="post">
			<div class="input-field col s12">	
				<label for="conteudo">Conteudo</label>
				<input type="text" name="conteudo" id="conteudo">
			</div>

			<div class="input-field col s12">	
				<label for="dataInicio">Data Inicio</label>
				<input type="date" name="dataInicio" id="dataInicio">
			</div>

			<div class="input-field col s12">	
				<label for="dataFim">Data Fim</label>
				<input type="date" name="dataFim" id="dataFim">
			</div>

			<div class="input-field col s12">	
				<label for="peso">Peso</label>
				<input type="text" name="peso" id="peso">
			</div>	
			
			<div class="input-field col s12">	
				<div class="switch">Embaralhar <br/>
					<label for="embaralhar">Não
						<input type="checkbox" name="embaralhar" id="embaralhar" value = 1>
						<span class="lever"></span>
						Sim</label>
				</div>
			</div>



			<button type="submit" name="acao" class="btn black white-text waves-effect waves-light" value="cadastrar">Cadastrar</button>
		</form>
	</div>
</body>
</html>