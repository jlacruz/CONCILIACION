function mostrar_ocultar_opciones_x_operaciones(id_operacion)
{
	var opciones=document.getElementsByName('opciones'+id_operacion+'[]');
	var contador_opciones=opciones.length;
	for(a=0;a<contador_opciones;a++)
	{
		if(opciones.item(a).style.display=='none')
		opciones.item(a).style.display="table-row";	
		else
		opciones.item(a).style.display="none";
	}
}