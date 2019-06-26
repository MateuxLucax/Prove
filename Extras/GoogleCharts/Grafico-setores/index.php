<!DOCTYPE html>
<html lang="pt-br">

<?php
    include_once 'funcoes.php';
    $vetor = array("['Excelente', 2]", "['Ótimo', 7]", "['Bom', 5]", "['Razoável', 3]", "['Ruim', 2]", "['Péssimo', 10]");
    $titulo = 'Desempenho na Prova';
    $div = 'grafico';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gerador de Gráficos</title>
    <script type="text/javascript" src="loader.js"></script>
    <script type="text/javascript">
        <?php 
            geraGraficoSetor($vetor, $titulo, $div);
        ?>
    </script>

</head> 

<body>

    <div id="grafico" style="width: 900px; height: 500px;"></div>

</body>

</html>