function horaActual(){
	var hoy= new Date();
	var fecha = ""+hoy.getDate()+"/";
		fecha += (hoy.getMonth()+1)+"/";
		fecha += hoy.getFullYear()+"  ";
	var hora = hoy.getHours();
		hora += ":"+hoy.getMinutes();
		hora += ":"+hoy.getSeconds();
	document.getElementById('fechaActual').innerHTML= fecha + ' - ' + hora;
	setTimeout('horaActual()',1000);
}
