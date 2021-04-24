<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <title>Лабораторная работа №3</title>
	</head>
	<body>
		<center>
			<form method="post">
				Введите матрицу графа.
				<br>
				Основная диагональ должна состоять из нулей.
				<br>
				Если от одной вершины к другой нет прямого пути, то ставится "INF"
				<br> <br>
				<textarea id="matr" style = "width: 300px; height: 300px;" name = 'matrix' value = '0'></textarea><br>
				<div class="trial" style = "margin: 15px 0">
					Найти путь из 
					<input type = 'number' style = "width: 50px; height: 20px;" min = '1' placeholder="1" name = 'start' value = '<?= $_POST[start]?>'>
					в 
					<input type = 'number' style = "width: 50px; height: 20px;" min = '1' placeholder="1" name = 'end' value = '<?= $_POST[end]?>'>
				</div>
				<input type = 'submit'>
			</form>
			<?php
				
				$matrix = explode("\n", $_POST[matrix]);
				for($i = 0; $i < count($matrix); $i++)
				{
					$matrix[$i] = explode(" ", $matrix[$i]);
					if (count($matrix[0]) != count($matrix[$i]) or count($matrix) != count($matrix[$i]))
					{
						die('Матрица введена неверно');
					}
				}
				for ($i = 0; $i < count($matrix); $i++)
				{
					for ($j = 0; $j < count($matrix[$i]); $j++)
					{
						if($matrix[$i][$j] == 'INF'){
							$matrix[$i][$j] = INF;
						}
					}
				}

				$start = $_POST[start] - 1;
				$end = $_POST[end] - 1;
				$N = count($matrix);
				$v = 0;
				$S[0] = $v;

				for ($i = 0; $i < $N; $i++)
				{
					$T[$i] = INF;
				}
				$T[$v] = 0;

				while ($v != -1)
				{
					for ($j = 0; $j < $N; $j++)
					{
						if (array_search($j, $S) == false)
						{
							$w = $T[$v] + $matrix[$v][$j];
							if ($w < $T[$j])
							{
								$T[$j] = $w;
								$M[$j] = $v;
							}
						}
					}

					$v = -1;
					$m = INF;
					for ($i = 0; $i < $N; $i++)
					{
						$bol = true;
						for ($j = 0; $j < count($S); $j++)
						{
							if ($i == $S[$j])
							{
								$bol = false;
							}
						}
						if ($bol){
							if ($T[$i] < $m){
								$m = $T[$i];
								$v = $i;
							}
						}
					}

					if ($v >= 0){
						array_push($S, $v);
					}
				}

				$P[0] = $end;
				$con = 0;

				while ($end != $start)
				{
					$end = $M[$P[$con]];
					$con++;
					array_push($P, $end);
				} 

				echo 'Введенная матрица: <br>';
				echo '<div id = "matr">';
				for ($i = 0; $i < $N; $i++)
				{
					for ($j = 0; $j < $N; $j++)
					{
						echo '<input type = "number" style = "width: 30px; height: 20px;" value = "' . $matrix[$i][$j] . '" readonly >';
						if ($j == $N - 1)
						{
							print $matrix[$i][$j];
						}
					}
					echo '<br>';
				}
				echo '</div>';
				echo '<br>';

				echo 'Кратчайшие пути от начального пункта: <br>';
				echo '<div id = "trip">';
				for ($i = 0; $i < $N; $i++)
				{
					echo ($i + 1) . ': ' . $T[$i] . '<br>';
				}
				echo '</div>';
				echo '<br>';

				echo 'Путь из ' . ($start + 1) . ' в ' . $_POST[end] . ' составляет ';
				echo '<div id = "trip_code">';
				echo '(';
				for ($i = count($P)-1; $i >= 0; $i--)
				{
					if ($i == 0){
						echo ($P[$i]+1) . ')';
					}else
					{
						echo ($P[$i]+1) . ', ';
					}
				}
				echo ' и имеет вес ' . $T[$_POST[end]-1];
				echo '</div>';
				echo '<br>';

			?>
		</center>
	</body>
</html>