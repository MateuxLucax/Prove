<!DOCTYPE html>
<html lang="pt-br">

<?php
    include_once 'funcoes.php';
    $vetor = array("['Notas', 'Aluno', 'Teste']", "['Prova 1', 7, 0]", "['Trabalho 1', 9, 10]", "['Prova 2', 7.5, 9]", "['Trabalho 2', 8, 1]", "['Prova 3', 9.5, 6]");
    $titulo = 'Notas do aluno';
    $div = 'grafico-linhas-notas';
    $eixoX = array("Notas", "Prova 1", "Prova 2", "Trabalho 1");
    $linhas = array (
        array ("Aluno A", 9, 8, 7),
        array ("Aluno B", 10, 5, 9),
    );
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gerador de Gráficos</title>

</head> 

<body>
    <?php geraGraficoSetor($eixoX, $linhas, $titulo, $div); ?>
    

</body>

</html>