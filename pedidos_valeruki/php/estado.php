<?php
    $id = $_POST["id"];  
    $estado = $_POST["estado"];
    $dot = $_POST["dot"];

    include("conexion.php");    

    $query = mysqli_prepare($conn, "UPDATE pedidos SET estado=?,dot=? WHERE id = $id");
    mysqli_stmt_bind_param($query, "ss", $estado,$dot);
    mysqli_stmt_execute($query);         
    mysqli_stmt_free_result($query);
    mysqli_stmt_close($query);         
?>