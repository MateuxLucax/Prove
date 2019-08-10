<?php

    function geraGraficoSetor($vetor = false, $titulo = false, $div = false) {
        if ($vetor != false and $div != false) {
            echo "google.charts.load('current', {'packages':['corechart']});";
            echo "google.charts.setOnLoadCallback(drawChart);";
  
            echo "function drawChart() {";

            echo "var data = google.visualization.arrayToDataTable([";
            echo "['descricao', 'valor'],";
            for ($linhas = 0; $linhas < count($vetor); $linhas++) {
                if ($linhas != (count($vetor) - 1)) {
                    echo $vetor[$linhas] . ',';
                } else {
                    echo $vetor[$linhas];
                }
            }
          echo "]);";
          
          echo "var options = {";
          echo $titulo == false ? "title: null" : "title: '". $titulo. "'";
          echo "};";
          
          echo "var chart = new google.visualization.PieChart(document.getElementById('". $div. "'));";
  
          echo "chart.draw(data, options);";
          echo "}";
        }
    }

?>