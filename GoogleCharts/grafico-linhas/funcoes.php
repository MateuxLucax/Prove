<?php

	function geraGraficoSetor2($vetor = false, $titulo = false, $div = false) {
		if ($vetor != false and $div != false) {
			echo '<script type="text/javascript" src="loader.js"></script>';
			echo '<script type="text/javascript">';

			echo "google.charts.load('current', {'packages':['corechart']});";
			echo "google.charts.setOnLoadCallback(drawChart);";
  
			echo "function drawChart() {";
  
			echo "var data = google.visualization.arrayToDataTable([";
			gerarMatriz2($vetor);
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

	function gerarMatriz2($vetor) {
		for ($linhas = 0; $linhas < count($vetor); $linhas++) {
			if ($linhas != (count($vetor) - 1)) {
				echo $vetor[$linhas] . ',';
			} else {
				echo $vetor[$linhas];
			}
		}
	}

	function geraMatriz($eixoX, $linhas) {
		$matriz = array();
		for ($i=0; $i < count($eixoX); $i++) { 
			$matriz[0][$i] = $eixoX[$i];
		}

		for ($i=0; $i < count($linhas); $i++) { 
			for ($j=0; $j < count($linhas[$i]); $j++) { 
				$matriz[$i+1][$j] = $linhas[$i][$j];
			}
		}

		for ($i=0; $i < count($matriz); $i++) { 
			echo "[ "
			for ($j=0; $j < count($matriz[$i]); $j++) { 
				echo $matriz[$i][$j]", ";
			}
			echo "], <br>";
		}
	}



?>