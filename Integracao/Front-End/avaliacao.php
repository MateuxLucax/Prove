<!DOCTYPE html>
<?php

	if (isset($_POST['codigo'])) {
		$codigo = $_POST['codigo'];
	} else if (isset($_GET['codigo'])) {
		$codigo = $_GET['codigo'];
	} else {
		$codigo = '';
	}

    include 'disciplinas_pdo.php';
    include 'funcoes.php';
    include 'conf.php';
	date_default_timezone_set('America/Sao_Paulo');

    $registros = selectPDO_discaval($codigo, 'avaliacao');

    if($codigo != '') { 
            
        $cod_disciplina = $registros[0][0];
        $disciplina = $registros[0][1];
        $cod_avaliacao = $registros[0][2];
        $conteudo = $registros[0][3];
        $data_inicio = $registros[0][4];
        $data_fim = $registros[0][5];
        $peso = $registros[0][6];
        $embaralhar = $registros[0][7];

        $title = $disciplina." - ".$conteudo;

    } else {
        $title = '';
    }

?>
<html>
<head>
	<title><?php echo $title ?></title> 
	<meta charset="utf-8">

	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

	<style type="text/css">
		select { display: block; } /*Tive que colocar, porque por padrão o select estava com display:none por algum motivo*/
	</style>

	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
	<div class="container">
        
        <?php if($codigo != '') { ?>

            <form action="avaliacao_pdo.php" method="post" style="border: 1px black solid">
                <div class="input-field col s12">
                    <label for="conteudo">Conteúdo</label>
                    <input type="text" name="conteudo" id="conteudo" value="<?php echo $conteudo; ?>">
                </div>
                <br/>Aqui vão ficar os campos para editar a avaliação (conteúdo, data de início e fim etc.)
                <br/>O próximo form é para o cadastro de questões.
                <br/>No meio desses dois forms deve estar a visualização de questões da prova<br/>
                <button type="submit" name="acao" value="editar" class="btn black waves-effect waves-light">Editar</button>
            </form>
            
            
            <form action="avaliacao_pdo.php" method="post">
                
                <div class="input-field col s12">
				    <?php gerarSelect($tb_tipo, 'Tipo_Questao', 0, 'Codigo_Tipo', 'Descricao'); ?>
			    </div><p> Colocar botão para abrir questão </p><br/><br/><br/>
                
                
                <div class="chips">
                    Palavras-chave aqui
                </div>

                <div class="input-field col s12">	
                    <label for="enunciado">Enunciado</label>
                    <input type="text" name="enunciado" id="enunciado">
                </div>
                
                <div class="input-field col s12">	
                    <label for="texto">Texto</label>
                    <input type="text" name="texto" id="texto">
                </div>

                

                <div class="input-field col s12">
                    <?php //gerarSelect($tb_avaliacoes, 'Disciplina_Codigo_Disciplina', 0, 'Codigo_Disciplina', 'Nome'); ?>
                </div>
                
                

                <button type="submit" name="acao" class="btn black white-text waves-effect waves-light" value="cadastrar">Cadastrar</button>
            </form>


        <?php } else { ?>

            <div id="erro_codigo">
                <p><b>Erro: </b> a página não recebeu nenhum código. Adicione, no final da URL, <code>?codigo=[codigo da disciplina]</code></p>
            </div>

        <?php } ?>
	</div>
</body>
</html>