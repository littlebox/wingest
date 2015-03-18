Cant de equipos
<select id="scanteq">
	<?php
		for($i=1;$i<=50;$i++):
			echo "<option value=\"$i\">$i</option>";
		endfor;
	?>
</select>
</br>
Grupos:<select id="scantgr"></select>
</br>
Cantidad de equipos que clasifican <select id="scantcl"></select>
<script>
	var canteq;
	var cantgr;

	scanteq = document.getElementById('scanteq');
	scantgr = document.getElementById('scantgr');
	scantcl = document.getElementById('scantcl');
	scanteq.addEventListener('change',function(){
		canteq = scanteq.selectedIndex + 1 ;
		cantgrupos(canteq)
	})

	scantgr.addEventListener('change',function(){
		cantgr = scantgr.querySelectorAll('option')[scantgr.selectedIndex].getAttribute('value') ;
		cantequiposclasifican(canteq,cantgr)
	})

	//funciones
	cantgrupos = function(canteq){
		scantgr.innerHTML = '';
		entro = false;

		for(i=2;i<canteq;i++){
			if(canteq % i == 0){
				entro = true;
				option = document.createElement('option');
				option.setAttribute('value', i);
				option.textContent = i+' grupos de '+ canteq/i +' equipos';
				if((canteq/i)%2 != 0){
					option.textContent += ' (equipos con fecha libre!!!)'
				}
				scantgr.appendChild(option)
			}
		}

		if(!entro){
			option = document.createElement('option');
			option.textContent = 'Numeros primos NO. La concha de la lora!!!';
			scantgr.appendChild(option)
		}
	}

	cantequiposclasifican = function(canteq,cantgr){
		scantcl.innerHTML = '';

		entro = false; //variable que indica si se pudieron formar llaves con esa combinacion

		for( i=1; i < canteq/cantgr; i++){ // recorro los equipos desde 1 hasta todos menos uno
			canteqcl = cantgr * i; // cant de eq que clasifican

			if((canteqcl & (canteqcl - 1)) == 0){ //comprueba si es potencia de 2. Lo vienen usando asi desde que se invento la computadora
				option = document.createElement('option');
				option.setAttribute('value', i);
				option.textContent = i;
				scantcl.appendChild(option)
				entro = true;
			}

			if(!entro){
				option = document.createElement('option');
				option.textContent = 'No se pueden formar llaves con esa combinación!!!';
				scantcl.appendChild(option)
			}
		}
	}


	function factorial(num){
		var rval=1;
		for (var i = 2; i <= num; i++)
			rval = rval * i;
		return rval;
	}

</script>