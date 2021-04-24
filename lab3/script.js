/**
* Функция check() выполняет основную работу программы, в которую входит:
*	-проверка корректности введеных данных
*	-удаление схожих элементов
*	-проверка на соответствие множеств
*
*	@param first - первое множество.
*	@param second - второе множество.
*	@param ratio - Отношение R.
*	@param sum - колличество соответствий для одного элемента множества
*
*	return false;
*/
function check(){
	var first = document.getElementById('first').value;
	var second = document.getElementById('second').value;
	var ratio = document.getElementById('ratio').value;
	var sum, upper = false, lower = false;
	first = first.split(' ');
	second = second.split(' ');
	ratio = ratio.split(' ');
	for (var i = 0; i < ratio.length; i++) {
		if(ratio[i].indexOf(',') == -1){
			alert("Отношение введено некорректно (пропущена запятая)");
			return;
		}
	}
	for (var i = 0; i < ratio.length; i++) {
		for (var j = i+1; j < ratio.length; j++) {
			if (ratio[i] == ratio[j]){
				ratio.splice(j, 1);
			}
		}
	}

	var trash = [], trash1 = [], trash2 = [];
	for (var i = 0; i < ratio.length; i++) {
		trash = ratio[i].split(',');
		trash1[i] = trash[0];
		trash2[i] = trash[1];
	}

	for (var i = 0; i < first.length; i++){
		sum = 0;
		for (var j = 0; j < trash1.length; j++){
			if(trash1[j].indexOf(first[i]) != -1){
				sum++;
			}
		}
		if (sum == 0){
			lower = true;
		}
		if (sum > 1) {
			upper = true;
		}
	}

	if (lower && upper) {
		document.getElementById('result').innerHTML = "Отношение не является функцией, так как имеются элементы из первого множества, которым не соответсвует ни один элемент из второго, а также элементы, которые имеют больше одного соответствия";
		return;
	}
	if (lower) {
		document.getElementById('result').innerHTML = "Отношение не является функцией, так как имеются элементы из первого множества, которым не соответсвует ни один элемент из второго";
		return;
	}
	if (upper) {
		document.getElementById('result').innerHTML = "Отношение не является функцией, так как имеются элементы из первого множества, которые имеют больше одного соответствия";
		return;
	}
	document.getElementById('result').innerHTML = "Отношение является функцией";
	return false;
}