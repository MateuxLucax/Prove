<?php

	function geraGraficoSetor($vetor = false, $titulo = false, $div = false) {
		if ($vetor != false and $div != false) {
			echo '<script type="text/javascript" src="loader.js"></script>';
			echo '<script type="text/javascript">';

			echo "google.charts.load('current', {'packages':['corechart']});";
			echo "google.charts.setOnLoadCallback(drawChart);";
  
			echo "function drawChart() {";
  
			echo "var data = google.visualization.arrayToDataTable([";
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
		  
			echo "var chart = new google.visualization.LineChart(document.getElementById('". $div. "'));";
  
			echo "chart.draw(data, options);";
			echo "}";

			echo '</script>';

			echo '<div id="'.$div.'" style="width: 900px; height: 500px;"></div>';
		}
	}

?>