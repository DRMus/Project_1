<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <title>Лабораторная работа №5</title>
	</head>
	<body>
		<center>
			<form method="post">
				Введите пары элементов для матрицы графа.
				<br> <br>
				<textarea id="matr" style = "width: 300px; height: 300px;" name = 'matrix' value = '0'><?= $_POST[matrix]; ?></textarea><br>
				</div>
				<input type = 'submit'>
			</form>
			<?php
				/**
				 * 
				 * @param matrix массив пар элементов
				 * @param max максимальная рамерность матрицы
				 * @param N размерность матрицы
				 * @param R массив матрицы достижимости
				 * 
				 */
				$matrix = explode("\r\n", $_POST[matrix]);
				$max = -1;
				for($i = 0; $i < count($matrix); $i++){
					$S_trash[$i] = explode(' ', $matrix[$i]);
				}
				
				for ($i = 0; $i < count($S_trash); $i++){
					if(count($S_trash[$i]) > 2){
						die('Неверный ввод. Элементов больше 2');
					}
				}

				for ($i = 0; $i < count($S_trash); $i++){
					for ($j = 0; $j < count($S_trash[$i]); $j++){
						if($max < $S_trash[$i][$j]) {
							$max = $S_trash[$i][$j];
						}
					}
				}

				for ($i = 0; $i <= $max; $i++){
					for ($j = 0; $j <= $max; $j++){
						$S[$i][$j] = 0;
					}
				}
				
				for ($i = 0; $i < count($S_trash); $i++){
					$S[$S_trash[$i][0]][$S_trash[$i][1]] = 1;
				}
				
				$matrix = $S;
				$N = count($matrix);

				for($i = 0; $i < $N; $i++)
				{
					for($j = 0; $j < $N; $j++)
					{
						if ($i == $j)
						{
							$R[$i][$j] = 1;
						} else
						{
							$R[$i][$j] = 0;							
						}
					}
				}

		        for ($i = 0; $i < $N; $i++) {
		            for ($j = 0; $j < $N; $j++) {
		                if ($matrix[$i][$j] != 0) {
		                    $R[$i][$j] = 1;
		                }
		            }
		        }
		        for ($k = 0; $k < $N; $k++) {
		            for ($i = 0; $i < $N; $i++) {
		                for ($j = 0; $j < $N; $j++) { 
		                    if ($R[$i][$j] != 0 || ($R[$i][$k] != 0 && $R[$k][$j] != 0)) {
		                        $R[$i][$j] = 1;
		                    }
		                }
		            }
		        }

				echo '<br>';
				echo 'Введенная матрица: <br>';
				echo '<div id = "matr">';
				for ($i = 0; $i < $N; $i++)
				{
					for ($j = 0; $j < $N; $j++)
					{
						echo '<input type = "number" style = "width: 30px; height: 20px;" value = "' . $matrix[$i][$j] . '" readonly >';
					}
					echo '<br>';
				}
				echo '</div>';
				echo '<br>';

				echo '<br>';
				echo 'Итоговая матрица достижимости: <br>';
				echo '<div id = "matr">';
				for ($i = 0; $i < $N; $i++)
				{
					for ($j = 0; $j < $N; $j++)
					{
						echo '<input type = "number" style = "width: 30px; height: 20px;" value = "' . $R[$i][$j] . '" readonly >';
					}
					echo '<br>';
				}
				echo '</div>';
				echo '<br>';
			?>
		</center>
	</body>
</html>