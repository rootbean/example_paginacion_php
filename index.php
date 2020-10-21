<?php

include_once('funciones.php');
$connection_bd = conexionBD();

if(!$_GET) {
    header('Location:index.php?pagina=1');
}

// Obtener la cantidad de usuarios
$sql_cantidad = "SELECT COUNT(*) FROM usuarios";

$resultado_cantidad = $connection_bd->prepare($sql_cantidad);

$resultado_cantidad->execute();

$resultado_cantidad = $resultado_cantidad->fetchColumn();

$usuarios_por_pagina = 5;

$total_paginas = ceil($resultado_cantidad / $usuarios_por_pagina);


// Datos páginación

$inicio = ($_GET['pagina'] - 1) * $usuarios_por_pagina; 

$sql = "SELECT * FROM usuarios LIMIT ".$inicio.",".$usuarios_por_pagina;

$resultado = $connection_bd->prepare($sql);

// $resultado->bindParam('::inicio', $inicio, PDO::PARAM_INT);
// $resultado->bindParam('::cantidadpagina', $usuarios_por_pagina, PDO::PARAM_INT);

$resultado->execute();

$resultado = $resultado->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Ejemplo Paginación</title>
</head>
<body>

    <section class="bg-ligth">
        <div class="container">
          <div class="row">
           <div class="col-lg-12 mx-auto">
            <h2> Tabla de Usuarios </h2>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Fecha Registro</th>
                    <th scope="col">Activo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultado as $fila) { ?>
                    <tr>
                        <th scope="row"><?php echo $fila['usuarios_id'] ?></th>
                        <td><?php echo $fila['usuarios_nombre'] ?></td>
                        <td><?php echo $fila['usuarios_fecha_registro'] ?></td>
                        <td><?php echo $fila['usuarios_activo'] ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            
          </div>
          <div class="row">
            <nav aria-label="Page navigation example" >
                <ul class="pagination" >
                    <li class="page-item <?php echo $_GET['pagina']<=$i + 1 ? 'disabled': '' ?>">
                        <a class="page-link" href="index.php?pagina=<?php echo $_GET['pagina']-1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php for($i = 0; $i < $total_paginas; $i++) { ?>
                        <li class="page-item <?php echo $_GET['pagina']==$i + 1 ? 'active': ''; ?>"><a class="page-link" href="index.php?pagina=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
                    <?php } ?>
                    
                    <li class="page-item <?php echo $_GET['pagina']>=$total_paginas ? 'disabled': '' ?>">
                        <a class="page-link" href="index.php?pagina=<?php echo $_GET['pagina']+1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
          </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>