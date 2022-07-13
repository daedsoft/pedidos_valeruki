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
    <?php
        date_default_timezone_set('UTC');
        date_default_timezone_set("America/Bogota");
    ?>   

    <nav class="nav">
        <div style="display: flex;align-items:center;">
            <button type="button" class="add-btn">
                <img src="./assets/icon_calendar.svg">
                <p>Agregar</p>
            </button>
            <h1 style="margin-left:15px;">VALERUKI</h1>
        </div>        
        <form action="buscar.php" method="post" class="search-form" id="searchForm">
            <label for="txBuscar"></label>
            <input type="text" id="txBuscar" name="buscar" placeholder="Buscar pedido">
            <button type="button" class="search-btn">
                <img src="./assets/icon_search.svg">
            </button>            
        </form>        
    </nav>

    <div class="sorter">
        <div class="sorter-section">
            <h4>Ordenar: </h4>
            <button type="button" class="sorter-btn">
                Más reciente
            </button>
            <div class="sorter-menu">
                <ul>
                    <li class="sorter-menu__item" style="margin-bottom: 15px">
                        <a href="reciente.php">Más reciente</a>
                    </li>
                    <li class="sorter-menu__item">
                        <a href="index.php">Más antiguo</a>
                    </li>
                </ul>
            </div>
        </div>        

        <div class="sorter-section">
            <h4 style="margin-right:5px;">Filtrar: </h4> 
            <form action="fil_fecha.php" method="post" id="filForm">
                <input type="date" name="filFecha" id="filFecha" class="fil-date" >   
            </form>   
        </div>
    </div>

    <main>
        <div class="container">

            <?php
                include("php/conexion.php");
                $query = "SELECT * FROM pedidos  WHERE estado != 'Contabilizado' ORDER BY fecha DESC LIMIT 50";
                $resultset = mysqli_query($conn, $query) or die("Algo salió mal: ". mysqli_error($conn));
                while($rows = mysqli_fetch_assoc($resultset)){                          
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
            ?>               
            
        </div>
    </main>   
    
    <div class="add-modal">        
        <h2 class="modal-title">Nuevo Pedido</h2>        
        <form action="./php/guardar.php" method="post" id="formAdd">
            <p>Agendar para el:</p>                     
            <input type="date" name="fecha" id="fecha" class="modal-date" value="<?php echo date("Y-m-d");?>">            
            <div class="separator"></div>
            <p>Cliente:</p>
            <input type="text" name="cliente" id="cliente" class="input-text">
            <div class="separator"></div>
            <p>Detalle:</p>
            <textarea name="detalle" id="Detalle" cols="32" rows="6" class="modal-text"></textarea>
            <div class="separator"></div>
            <p>Valor:</p>
            <input type="number" name="valor" id="valor" class="input-text">
            <!--  -->
            <button type="button" class="modal-btn" id="saveModal">Guardar</button>
            <button type="button" class="modal-btn-secondary" id="closeModal">Cancelar</button>
        </form>
    </div>

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

    <div class="bottom-bar">        
        <form action="fil_estado.php" method="post" id="filStateForm">
            <input type="text" name="estado" id="inputEstado" style="display:inline-block; height:0px; width: 0px; opacity: 0;">
            <button type="button" class="btn-fil-state" data-estado="En proceso">
                <div class="dot gray"></div>
                En proceso
            </button>     
            <button type="button" class="btn-fil-state" data-estado="Cobrado">
                <div class="dot purple"></div>
                Cobrado
            </button>     
            <button type="button" class="btn-fil-state" data-estado="Por cobrar">
                <div class="dot orange"></div>
                Por cobrar
            </button>     
            <button type="button" class="btn-fil-state" data-estado="Terminado">
                <div class="dot green"></div>
                Terminado
            </button>     
            <button type="button" class="btn-fil-state" data-estado="Contabilizado">
                <div class="dot blue"></div>
                Contabilizado
            </button>     
            <button type="button" class="btn-fil-state" data-estado="Atrasado">
                <div class="dot red"></div>
                Atrasado
            </button>   
        </form>  
    </div>
</body>
</html>

<!-- pendientes -->
<!-- ocultar del home pedidos en estado Contabilizado -->
<!-- boton organizar ??? -->
<!-- en filtro y busqueda ordenar por id asc -->