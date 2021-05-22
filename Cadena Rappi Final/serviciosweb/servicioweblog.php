<?php

	// SE INCLUYE LA PAGINA QUE CONTIENE LA CLASE CON LOS METODOS DEL SERVICIO WEB
	include 'clsservicioslog.php';
	// SE HACE REFERENCIA AL PROTOCOLO SOAP PARA ESTABLECER CONEXION CON EL HOSTING
	$soap = new SoapServer(null, array('uri' => 'http://localhost/'));
	// SE EJECUTA LA CLASE QUE CONTIENE LOS METODOS
	$soap->setClass('clsservicioslog');
	// SE EJECUTA EL PROTOCOLO EN ESCUCHA
	$soap->handle();

?>