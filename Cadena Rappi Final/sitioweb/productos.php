<?php
    // CREAR EL OBJETO SOAPSERVER PARA HACER USO DEL SERVICIO WEB
    $cliente = new SoapClient(null, array('uri'=>'http://localhost','location'=>'https://progweb17200735.000webhostapp.com/practicas/Cadena%20Rappi%20Final/serviciosweb/servicioweblog.php'));
    // CONSUMO DEL METODO DE MOSTRAR PRODUCTOS DEL SERVICIO WEB
    $consulta = $cliente->cartaPedidosWhatsApp();
    // VARIABLE PARA FORMATEAR LA VISUALIZACION DE PRODUCTOS
    $totalProductos = 5;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>IDM</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" >
</head>

<body>
    <header class="landing-page">
        <div class="cover"></div>
        <nav class="navigation">
            <a href="#productos">Productos</a>
            <a href="#empresas">Empresas</a>
            <a href="#nosotros">Nosotros</a>
        </nav>
        <div class="presentation">
            <img src="https://logodownload.org/wp-content/uploads/2018/07/prime-video-1.png" alt="Logo">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, ducimus.</p>
            <a href="#productos">Ver Productos</a>
        </div>
    </header>

    <section id="productos" class="products d-flex">
        <h2 class="title">Productos</h2>
        <div class="container row col-12 mx-auto">
            <!-- Card Product -->
            
                <!--<div class="info d-flex">
                    <h3 class="Name-Product">Lorem, ipsum dolor.</h3>
                    <p class="Price">$25</p>
                    <a href="#">Detalles</a>
                </div>-->
                <form name="frmProductos" class="col-12 text-center" id="frmProductos" method="POST" style="background-color:#fefcfc;" width="100%">
                <table border="0" width="100%">
                <tr>
                </tr>
                <?php
                //VARIABLE PARA VISUALIZAR EL CONTEO DE PRODUCTOS
                    $i = 0;
                    for($ren = 0; $ren < count($consulta); $ren++){
                        //VALIDAR INICIO DE RENGLON
                        if($i == 0)
                            echo "<tr>";  
                        
                        echo "<td>";
                        echo "  <a href='detalleproducto.php?id=".$consulta[$ren]["CLAVE"]."'>";
                        echo "  <img src='".$consulta[$ren]["FOTO_PRO"]."'width='240px' height='175px' />";
                        echo "  <h4 class='black tituloCardCompra'><br>".$consulta[$ren]["PRODUCTO"]."</br></h4>";
                        echo "  <p class='gray'>$ ".$consulta[$ren]["COSTO"]."</p>";
                        echo "  </a>";
                        echo "</td>";
                        
                        
                        $i++;
                        //VALIDAR CIERRE DE RENGLON
                        if($i == $totalProductos){
                            $i = 0;
                            echo "</tr>";
                        }
                    }
                ?>
                </table>
            </form>
            
            <!-- Cierre del Card Product -->
        </div>
    </section>

    <section id="empresas" class="companies d-flex">
        <h2 class="title">Empresas</h2>
    <div class="container col-12 mx-auto">
        <div class="box-company">
            <a href="#"><img src="https://logos-marcas.com/wp-content/uploads/2020/11/Uber-Eats-Logo.png" alt="logo"></a>
        </div>
    </div>
    </section>

    <section id="nosotros">
        <h2 class="title">Nosotros</h3>
        <div class="container col-12 mx-auto">
            <div class="card-person">
                <div class="img-box-person">
                    <img src="https://persona-app-es.herokuapp.com/assets/personas/2-03cad6d57866b41e354c240f94fbe4a930d54ffe73e5e864ce28822c9d170c1e.png" alt="Persona">
                </div>
                <div class="info-person">
                    <h3>Peter Henderson</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore enim optio dolores magnam, neque id?</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, placeat.</p>
    </footer>
</body>

</html>