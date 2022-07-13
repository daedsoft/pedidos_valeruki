<?php
    $id = $_POST["id"];
    $fecha = date($_POST["fecha"]);
    $fechats = strtotime($fecha); 
    switch (date('w', $fechats)){
        case 0: $nombre_dia = "Domingo"; break;
        case 1: $nombre_dia = "Lunes"; break;
        case 2: $nombre_dia = "Martes"; break;
        case 3: $nombre_dia = "Miércoles"; break;
        case 4: $nombre_dia = "Jueves"; break;
        case 5: $nombre_dia = "Viernes"; break;
        case 6: $nombre_dia = "Sábado"; break;
    }    
    $fecha_int = strtotime($fecha);
    $dia = date("d", $fecha_int );
    $mes = date("m", $fecha_int);

    if ($mes == "01"){$mes_nombre = "Enero";}
    if ($mes == "02"){$mes_nombre = "Febrero";}
    if ($mes == "03"){$mes_nombre = "Marzo";}
    if ($mes == "04"){$mes_nombre = "Abril";}
    if ($mes == "05"){$mes_nombre = "Mayo";}
    if ($mes == "06"){$mes_nombre = "Junio";}
    if ($mes == "07"){$mes_nombre = "Julio";}
    if ($mes == "08"){$mes_nombre = "Agosto";}
    if ($mes == "09"){$mes_nombre = "Septiembre";}
    if ($mes == "10"){$mes_nombre = "Octubre";}
    if ($mes == "11"){$mes_nombre = "Noviembre";}
    if ($mes == "12"){$mes_nombre = "Diciembre";}

    $cliente = $_POST["cliente"];

    $detalle = $_POST["detalle"];  

    $valor = $_POST["valor"];

    include("conexion.php");    

    $query = mysqli_prepare($conn, "UPDATE pedidos SET fecha=?,nombre_dia=?,dia=?,mes=?,cliente=?,detalle=?,valor=? WHERE id = $id");
    mysqli_stmt_bind_param($query, "ssssssd", $fecha,$nombre_dia,$dia,$mes_nombre,$cliente,$detalle,$valor);
    mysqli_stmt_execute($query);         
    mysqli_stmt_free_result($query);
    mysqli_stmt_close($query);  
    header("location: ../index.php");     
?>