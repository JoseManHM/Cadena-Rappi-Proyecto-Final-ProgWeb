<?php
	//NOMBRE DE LA CLASE
	class clsservicioslog{
		//PROGRAMACIÓN DE LOS METODOS DEL SERVICIO
		public function nombre($nom,$pass){
			if ($nom=="admin" or $nom=="ventas") {
				if($nom=="admin" and $pass=="itp2021"){
				    return "Bienvenido: (".$nom." - Administrador) estás usando el servicio web de ITP progweb 2021";
				}else if($nom=="ventas" and $pass=="itp2021"){
				    return "Bienvenido: (".$nom." - Ventas) estás usando el servicio web de ITP progweb 2021";
				} else{
				    return "Usuario inválido, verifique";
				}
			} else{
				return "Usuario invalido, verifique";
			}
		}
		public function accesobd($nom, $pass){
		    //DEFINICIÓN DEL ARREGLO QUE RECIBIRÁ LOS DATOS DE EJECUCION DEL SP
		    $datos = array();
		    //CADENA DE CONEXIÓN CON FORMATO: USUARIO   CONTRASEÑA  BASE DE DATOS
		    if($conn = mysqli_connect("localhost","id16090898_usr_prosoft","G0dNOt3xx15sT666-","id16090898_db_prosoft")){
		        //CREACION DE CONSULTA PARA EJECUTAR EL PROCEDIMIENTO ALMACENADO
		        $sqlText = "CALL spValidarAcceso('$nom', '$pass')";
		        //EJECUCION DEL COMANDO
		        $renglon = mysqli_query($conn, $sqlText);
		        //ANALIZAR LOS DATOS RECIBIDOS
		        while($resultado = mysqli_fetch_assoc($renglon)){
		            //ANALISIS DE LA BANDERA
		            $datos[0]["ID"] = $resultado["CLAVE"];
		            if((int)$datos[0]["ID"] != 0){
		                $datos[1]["NOMBRE"] = $resultado["USUARIO"];
		                $datos[2]["ROL"] = $resultado["ROL"];
		            }
		        }
		        //CIERRE DE CONEXIONES
		        mysqli_close($conn);
		    }
		    //RETORNAR DATOS A LA CAPA DE PRESENTACION (PÁGINA DE USUARIO)
		    return $datos;
		}
		
		public function mostrarProductos(){
		    $datos = array();
		    $reg = 0;
		    // Condición principal de conexión a la BD
		    if($conn = mysqli_connect("localhost","id16090898_usr_prosoft","G0dNOt3xx15sT666-","id16090898_db_prosoft")){
		        $renglones = mysqli_query($conn, "CALL spMostrarProductos");
		        while($renglon = mysqli_fetch_assoc($renglones)){
		            $datos[$reg]["CLAVE"] = $renglon["CLAVE"];
		            $datos[$reg]["PRODUCTO"] = $renglon["PRODUCTO"];
		            $datos[$reg]["COSTO"] = $renglon["COSTO"];
		            $datos[$reg]["FOTO"] = $renglon["FOTO"];
		            $reg++;
		        }
		        mysqli_close($conn);
		    }
		    return $datos;
		}
		
		public function contarUsuarios(){
		    $res = array();
		    if($conn = mysqli_connect("localhost","id16090898_usr_prosoft","G0dNOt3xx15sT666-","id16090898_db_prosoft")){
		        $consulta = mysqli_query($conn, "CALL spConsultarUsuarios(0,0,0);");
		        $res[0] = mysqli_num_rows($consulta);
		    }
		    mysqli_free_result($consulta);
		    mysqli_close($conn);
		    return $res;
		}
		
		public function mostrarUsuarios($inicioPag, $numReg){
		    $datos = array();
		    $reg = 0;
		    if($conn = mysqli_connect("localhost","id16090898_usr_prosoft","G0dNOt3xx15sT666-","id16090898_db_prosoft")){
		        $consulta = mysqli_query($conn, "CALL spConsultarUsuarios(1,$inicioPag,$numReg);");
		        while($resultado = mysqli_fetch_assoc($consulta)){
		            $datos[$reg]["CLAVE"] = $resultado["CLAVE"];
		            $datos[$reg]["USUARIO"] = $resultado["USUARIO"];
		            $datos[$reg]["ROL"] = $resultado["ROL"];
		            $reg++;
		        }
		        mysqli_free_result($consulta);
		        mysqli_close($conn);
		    }
		    return $datos;
		}
		
		public function insertarUsuario($nom,$ap,$am,$usu,$pwd,$foto,$rol){
		    $datos = array();
		    if($conn = mysqli_connect("localhost", "id16090898_usr_prosoft", "G0dNOt3xx15sT666-", "id16090898_db_prosoft")){
		        $renglon = mysqli_query($conn, "CALL spInsUsuario('$nom','$ap','$am','$usu','$pwd','$foto','$rol');");
		        while($renglon = mysqli_fetch_assoc($renglon)){
		            $datos[0]["ID"] = $resultado["ID"];
		        }
		        mysqli_close($conn);
		    }
		    return $datos;
		}
		
		public function eliminarUsuario($cve){
		    $datos = array();
		    if($conn = mysqli_connect("localhost", "id16090898_usr_prosoft", "G0dNOt3xx15sT666-", "id16090898_db_prosoft")){
		        $renglon = mysqli_query($conn, "CALL spDelUsuario($cve);");
		        while($resultado = mysqli_fetch_assoc($renglon)){
		            $datos[0]["ID"] = $resultado["ID"];
		        }
		        mysqli_close($conn);
		    }
		    return $datos;
		}
		
		public function llenarTabla($cve){
		    $datos = array();
		    $reg = 0;
		    if($conn = mysqli_connect("localhost", "id16090898_usr_prosoft", "G0dNOt3xx15sT666-", "id16090898_db_prosoft")){
		        $renglon = mysqli_query($conn, "CALL spConsultarUsuariosID($cve);");
		        while($resultado = mysqli_fetch_assoc($renglon)){
		            $datos[$reg]["CLAVE"] = $resultado["CLAVE"];
		            $datos[$reg]["NOMBRE"] = $resultado["NOMBRE"];
		            $datos[$reg]["PATERNO"] = $resultado["PATERNO"];
		            $datos[$reg]["MATERNO"] = $resultado["MATERNO"];
		            $datos[$reg]["USUARIO"] = $resultado["USUARIO"];
		            $datos[$reg]["CONTRASENA"] = $resultado["CONTRASENA"];
		            $datos[$reg]["FOTO"] = $resultado["FOTO"];
		        }
		        mysqli_free_result($renglon);
		        mysqli_close($conn);
		    }
		    return $datos;
		}
		
		public function actualizarUsuario($cve,$nom,$ap,$am,$usu,$pwd){
		    $datos = array();
		    if($conn = mysqli_connect("localhost", "id16090898_usr_prosoft", "G0dNOt3xx15sT666-", "id16090898_db_prosoft")){
		        $renglon = mysqli_query($conn,"CALL spActUsuario('$cve','$nom','$ap','$am','$usu','$pwd');");
		        while($renglon = mysqli_fetch_assoc($renglon)){
		            $datos[0]["ID"] = $resultado["ID"];
		        }
		        mysqli_close($conn);
		    }
		    return $datos;
		}
		public function mostrarUsuariosPDF(){
		    $datos = array();
		    $reg = 0;
		    if($conn = mysqli_connect("localhost","id16090898_usr_prosoft","G0dNOt3xx15sT666-","id16090898_db_prosoft")){
		        $consulta = mysqli_query($conn, "CALL spReporteUsuarios();");
		        while($resultado = mysqli_fetch_assoc($consulta)){
		            $datos[$reg]["CLAVE"] = $resultado["CLAVE"];
		            $datos[$reg]["NOMBRE"] = $resultado["NOMBRE"];
		            $datos[$reg]["USUARIO"] = $resultado["USUARIO"];
		            $datos[$reg]["CONTRASEÑA"] = $resultado["CONTRASEÑA"];
		            $datos[$reg]["ROL"] = $resultado["ROL"];
		            $datos[$reg]["FOTO"] = $resultado["FOTO"];
		            $reg++;
		        }
		        mysqli_free_result($consulta);
		        mysqli_close($conn);
		    }
		    return $datos;
		}
		
		
		//-----------------------------------------------------------------
		//-----------------------------------------------------------------
		//METODOS DE BD_CONTACTOS
		public function cartaPedidosWhatsApp()
	{
		$datos=array();		
		$reg=0;
		
      if($conn = mysqli_connect("localhost","id16090898_usr_contactos", "G0dNOt3xx15sT666-", "id16090898_bd_contactos") ){			
		   $consulta = mysqli_query($conn,"call spCartaPedidos();");
		  	while($resultado = mysqli_fetch_assoc($consulta)){
                $datos[$reg]["CLAVE"]=$resultado["CLAVE"];				
			    $datos[$reg]["CVE_USU"] =$resultado["CVE_USU"];
			    $datos[$reg]["PRODUCTO"] =$resultado["PRODUCTO"];
			    $datos[$reg]["COSTO"] =$resultado["COSTO"];
			    $datos[$reg]["FOTO_PRO"] =$resultado["FOTO_PRO"];
			    $datos[$reg]["DESCRIPCION"] =$resultado["DESCRIPCION"];
			    $datos[$reg]["USUARIO"] =$resultado["USUARIO"];
			    $datos[$reg]["ALIAS"] =$resultado["ALIAS"];
			    $datos[$reg]["TELEFONO"] =$resultado["TELEFONO"];
			    $datos[$reg]["FOTO"] =$resultado["FOTO"];
			   	$reg++;
			}		
				mysqli_close($conn); 
		}
		return $datos;
	}    
	public function mostrarProductosWhatsApp($producto)
	{
		$datos=array();		
		$reg=0;
      if($conn = mysqli_connect("localhost","id16090898_usr_contactos", "G0dNOt3xx15sT666-", "id16090898_bd_contactos") ){			
		   $consulta = mysqli_query($conn,"call spMostrarProductos($producto);");	      			 
		  	while($resultado = mysqli_fetch_assoc($consulta)){
                $datos[$reg]["CLAVE"]=$resultado["CLAVE"];				
			    $datos[$reg]["CVE_USU"] =$resultado["CVE_USU"];	
			    $datos[$reg]["PRODUCTO"] =$resultado["PRODUCTO"];
			    $datos[$reg]["COSTO"] =$resultado["COSTO"];
			    $datos[$reg]["FOTO_PRO"] =$resultado["FOTO_PRO"];
			    $datos[$reg]["DESCRIPCION"] =$resultado["DESCRIPCION"];
			    $datos[$reg]["USUARIO"] =$resultado["USUARIO"];
			    $datos[$reg]["ALIAS"] =$resultado["ALIAS"];
			    $datos[$reg]["TELEFONO"] =$resultado["TELEFONO"];
			    $datos[$reg]["FOTO"] =$resultado["FOTO"];
			   	$reg++;
			}		
				mysqli_close($conn); 
		}
		return $datos;
	}    
		
	}
?>