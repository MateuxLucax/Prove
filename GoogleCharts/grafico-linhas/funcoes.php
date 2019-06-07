<?php

	function geraGraficoSetor($eixoX = false, $linhas = false, $titulo = false, $div = false) {
		if ($eixoX != false and $div != false and $linhas != false) {
			echo '<script type="text/javascript" src="loader.js"></script>';
			echo '<script type="text/javascript">';

			echo "google.charts.load('current', {'packages':['corechart']});";
			echo "google.charts.setOnLoadCallback(drawChart);";
  
			echo "function drawChart() {";
  
			echo "var data = google.visualization.arrayToDataTable([";
			geraMatriz($eixoX, $linhas);
			echo "]);";
		  
			echo "var options = {";
			echo $titulo == false ? "title: null" : "title: '". $titulo. "',";
			echo "vAxis: {"; # vertical Axis
			echo "viewWindow: {"; # janela de visualização
			echo "min: 0,"; # determina o menor valor fixo do gráfico como 0
			echo "max: 10"; # determina o maior valor fixo do gráfico como 10
			echo "}"; 		# ou seja, independente das notas do aluno, o gráfico vai de 0 a 10
			echo "}";
			echo "};";
			 
			echo "var chart = new google.visualization.LineChart(document.getElementById('". $div. "'));";
  
			echo "chart.draw(data, options);";
			echo "};";

			echo '</script>';

			echo '<div id="'.$div.'" style="width: 900px; height: 500px;"></div>';
		}
	}

	function geraMatriz($eixoX, $linhas) {
		$matriz = array();
		for ($i=0; $i < count($eixoX); $i++) { 
			$matriz[$i][0] = $eixoX[$i];
		}
		
		for ($i=0; $i < count($linhas); $i++) { 
			for ($j=0; $j < count($linhas[$i]); $j++) { 
				$matriz[$j][$i+1] = $linhas[$i][$j];
			}
		}

		$txt = "";
		for ($i=0; $i < count($matriz); $i++) { 
			$txt .= "[";
			for ($j=0; $j < count($matriz[$i]); $j++) { 

				if($i == 0 || $j == 0)	$txt .= "'".$matriz[$i][$j]."'";
				else $txt .= $matriz[$i][$j];

				if($j < (count($matriz[$i])-1)) $txt .= ",";
			}
			$txt .= "]";
			if($i < (count($matriz)-1)) $txt .= ",";
		}
		echo $txt;
	}



?>