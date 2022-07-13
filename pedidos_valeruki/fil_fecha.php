<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <script defer src="./app.js"></script>
    <link rel="shortcut icon" href="./assets/favicon.svg" type="image/x-icon">
    <title>VALERUKI</title>
</head>
<body>
    <nav class="nav">
        <div style="display: flex;align-items:center;">            
            <h1 style="margin-left:15px;">VALERUKI / Resultados por fecha</h1>
        </div>         
    </nav>
    <main>
        <div class="container">
            <?php            
                $fecha = $_POST["filFecha"];   
                
                include("php/conexion.php"); 

                $query = "SELECT * FROM pedidos WHERE fecha = '".$fecha."'";
                $resultset = mysqli_query($conn, $query) or die("Algo salió mal: ". mysqli_error($conn));
                $recs = 0;
                while($rows = mysqli_fetch_assoc($resultset)){  
                    $recs++;                        
                    echo "<div class='card-pedido'>";
                        echo "<div class='card-pedido__edit'>";
                            echo "<button type='button' class='action-btn edit-pedido-btn' data-id='".$rows["id"]."' data-fecha='".$rows["fecha"]."' data-cliente='".$rows["cliente"]."' data-detalle='".$rows["detalle"]."' data-valor='".$rows["valor"]."'>";
                                echo "<img src='./assets/icon_edit.svg'>";
                            echo "</button>";
                        echo "</div>";
                        echo "<div class='card-pedido__fecha ".$rows['dot']."'>";
                            echo "<span class='card-pedido__fecha__nombre'>".$rows["nombre_dia"]."</span>";
                            echo "<span class='card-pedido__fecha__dia'>".$rows["dia"]."</span>";
                            echo "<span class='card-pedido__fecha__mes'>".$rows["mes"]."</span>";
                        echo "</div>";

                        echo "<div class='card-pedido__cuerpo'>";
                            echo "<p><strong>".$rows["cliente"]."</strong></p>";
                            echo "<p>".$rows["detalle"]."</p>";
                            echo "<br>";
                            echo "<h5>Valor: </h5>";
                            echo "<p>"."$".number_format($rows["valor"])."</p>";
                        echo "</div>";

                        echo "<div class='card-pedido__tags'>";
                            echo "<div class='tag'><div class='dot ".$rows["dot"]."'></div><p>".$rows["estado"]."</p></div>";
                            echo "<button type='button' class='action-btn edit-btn'>";
                                echo "<img src='./assets/icon_state.svg'>";
                            echo "</button>";
                        echo "</div>";

                        echo "<div class='context-menu'>";
                            echo "<div class='context-menu__sec' data-id='".$rows["id"]."'><div class='dot gray'></div><p class='context-menu__item'>En proceso</p></div>";                            
                            echo "<div class='context-menu__sec' data-id='".$rows["id"]."'><div class='dot purple'></div><p class='context-menu__item'>Cobrado</p></div>";                            
                            echo "<div class='context-menu__sec' data-id='".$rows["id"]."'><div class='dot orange'></div><p class='context-menu__item'>Por cobrar</p></div>";                            
                            echo "<div class='context-menu__sec' data-id='".$rows["id"]."'><div class='dot green'></div><p class='context-menu__item'>Terminado</p></div>";                            
                            echo "<div class='context-menu__sec' data-id='".$rows["id"]."'><div class='dot blue'></div><p class='context-menu__item'>Contabilizado</p></div>";                             
                            echo "<div class='context-menu__sec' data-id='".$rows["id"]."'><div class='dot red'></div><p class='context-menu__item'>Atrasado</p></div>";                            
                        echo "</div>";                        
                    echo "</div>";                       
                }     
                if ($recs == 0){
                    echo "<h3>No existen registros para la fecha: ".$fecha."</h3>";
                }   
            ?>
        </div>
        <div class="div-back">
            <a href="index.php" class="back">Volver al inicio</a>
        </div>
    </main>  
    
    <div class="edit-modal">        
        <h2 class="modal-title">Editar Pedido</h2>        
        <form action="./php/actualizar.php" method="post" id="formEdit">
            <p>Agendado para el:</p>            
            <input type="date" name="fecha" id="editFecha" class="modal-date">            
            <div class="separator"></div>
            <p>Cliente:</p>
            <input type="text" name="cliente" id="clienteEdit" class="input-text">
            <div class="separator"></div>
            <p>Detalle</p>
            <textarea name="detalle" id="Detalle" cols="32" rows="6" class="modal-text-edit"></textarea>
            <div class="separator"></div>
            <p>Valor:</p>
            <input type="number" name="valor" id="valorEdit" class="input-text">
            <!--  -->
            <button type="button" class="modal-btn" id="saveEditModal">Actualizar</button>
            <button type="button" class="modal-btn-secondary" id="closeEditModal">Cancelar</button>
            <input type="text" name="id" id="inputId" style="opacity: 0; display:inline-block; height: 0px;">
        </form>
    </div>
    
</body>
</html>
    