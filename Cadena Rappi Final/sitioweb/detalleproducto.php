<?php
    $consulta = array();

    // >> CREAR EL OBJETO SOAPSERVER PARA HACER USO DEL SERVICIO WEB
    $cliente = new SoapClient(null, array('uri'=>'http://localhost','location'=>'https://progweb17200735.000webhostapp.com/practicas/Cadena%20Rappi%20Final/serviciosweb/servicioweblog.php'));

    //verifica que se reciba el id del producto
    if(isset($_GET['id']))
    {
      $cve=$_GET['id'];
      // CONSUMO DEL METODO DE MOSTRAR PRODUCTOS DEL SERVICIO WEB
      $consulta = $cliente->mostrarProductosWhatsApp($cve);
    }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
	<title>detalle producto</title>
	<link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <?php
    $alias = $consulta[0]['ALIAS'];
    $producto = $consulta[0]['PRODUCTO'];
 ?>
</head>
<body>
    <div class="container">
	<div class="row">
	    <h1 class="h1 row justify-content-center bg-dark text-white p-3 mb-5">Pedido de productos</h1>
	    <div class="carddetalle col-4 row justify-content-center">
		<img class="productImage rounded mx-auto h-auto" src="<?php echo $consulta[0]["FOTO_PRO"]?>"/>
		</div>
		    <div class="botonesContacto col-4 text-center">
			<h1><?php echo $consulta[0]["PRODUCTO"];?></h1>
			<p class="gray grey fs-3">$<?PHP echo $consulta[0]["COSTO"];?><p>
			<p class="fs-4"> Descripción: <?php echo $consulta[0]["DESCRIPCION"];?></p>
			<a class="aProducto" href="javascript:window.open('https://api.whatsapp.com/send?phone=52<?php echo $consulta[0]["TELEFONO"] ?>&text=Hola <?php echo $alias ?>, me interesa hacer un pedido de <?php echo $producto ?>, espero tu respuesta.','popup','width=280px,height=380px');">
				<img src="imgusuarios/whatsapp.png" width="100px"height="100px" class="mx-auto d-block mt-5"><i class="fab fa-whatsapp fa-2x"></i>
			</a><p class="fs-5 text-decoration-none text-success">Enviar mensaje al vendedor</p>
		</div>
		
	<div class="col-4">
	<h2 class="text-center">Detalles del vendedor</h2>
     <p class="fs-5"><?php echo $consulta[0]["USUARIO"];?> <br>
     tambien conocido como "<?php echo $consulta[0]["ALIAS"];?>" <br>
     Contacto: <?php echo $consulta[0]["TELEFONO"];?></p>
     <img class="productImage rounded mx-auto d-block" src="<?php echo $consulta[0]["FOTO"]?>" width="300px"height="400px"/>
     </div>
     <div class="row justify-content-start mt-2">
	    <a href="../inicio.php?op=consultaproductos" class="aProducto"><img src="imgusuarios/left-arrow.png" width="70px"height="50px"></a><p class="fs-5 text-decoration-none text-dark">Seleccionar otro producto</p>
	    </div>
	</div>
	</div>
<script src="src/js/jquery-3.1.1.min.js"></script>    
	<script src="src/js/main.js"></script>
</body>
</html>