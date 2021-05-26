<?php include 'functions.php';
$txtTitulo = (isset($_POST['txtTitulo'])) ? $_POST['txtTitulo'] : "";
$txtDescripcion = (isset($_POST['txtDescripcion'])) ? $_POST['txtDescripcion'] : "";
$url_final = (isset($_POST['url_final'])) ? $_POST['url_final'] : "";
$nombre_pelicula = (isset($_GET['nombre_pelicula'])) ? $_GET['nombre_pelicula'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de: <?php echo $nombre_pelicula ?></title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- Data tables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
    <!-- Fin Data tables -->
</head>

<body>
    <div class="container_buscar">
        <form action="" method="get">
            <div class="form-group">
                <h3 class="title2">¿Cómo se llama la película?</h3>
                <input type="text" class="form-control input_name" id="InputNombrePelicula" placeholder="Nombre de la película" name="nombre_pelicula" align="center">
                <div class="btn_div">
                    <button type="submit" class="btn btn-primary btn_send">Consultar</button>
                </div>
                
            </div>
        </form>
        
    </div>
    <div class="container">
    <h3>Resultados de <?php echo $nombre_pelicula ?></h3>
    </div>
    <?php


    if (!empty($nombre_pelicula)) {
        API($nombre_pelicula); ?>
        <div class="container">
            <div class="tabla">


                <table id="tabla" class="display">
                    <thead>
                        <tr>
                            <th>Nombre película</th>
                            <th>Año</th>
                            <th>Descripción</th>
                            <th>Imagen</th>

                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($datos["results"] as $dato) {
                            $url_imagen = $dato["poster_path"];
                            if (empty($dato['overview'])) {
                                $dato['overview'] = "No se encontró descripción.";
                            }
                            if (empty($dato['release_date'])) {
                                $dato['release_date'] = "N/A";
                            }
                            if (!empty($dato["poster_path"])) {
                                $url_final = "https://image.tmdb.org/t/p/w200" . $url_imagen;
                            } else {
                                $url_final = "imagenes/error.png";
                            } ?>
                            <tr>
                                <td><?php echo $dato['title'] ?></td>
                                <td><?php echo substr($dato['release_date'], 0, 4) ?></td>
                                <td><?php echo $dato['overview'] ?></td>
                                <td><img src='<?php echo $url_final ?>' alt=''></td>

                                <td>
                                    <input type="hidden" value="<?php echo $dato['title'] . "\n" . $dato['overview'] . "\n" . $url_final ?>" id="myInput<?php echo $dato['id']; ?>">
                                    <button onclick="inputHidden('myInput<?php echo $dato['id']; ?>')" class="btn btn-info">Copiar info</button>
                                </td>
                            </tr>
                        <?php   }  ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    <?php } ?>
    
    

    
    <footer class="footer">
        <div class="container_footer_2" bis_skin_checked="1">
            <span class="text-muted center">Made with ❤ by <a href="https://github.com/bonestormm" target="_blank">Carlos Lagos</a></span>
        </div>
    </footer>
    <script>
        //Data tables
        $(document).ready(function() {
            $('#tabla').DataTable({
                "language": {
                    sProcessing: "Procesando...",
                    sLengthMenu: "Mostrar _MENU_ registros",
                    sZeroRecords: "No se encontraron resultados",
                    sEmptyTable: "Ningún dato disponible en esta tabla",
                    sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                    sInfoPostFix: "",
                    sSearch: "Buscar:",
                    sUrl: "",
                    sInfoThousands: ",",
                    sLoadingRecords: "Cargando...",
                    oPaginate: {
                        sFirst: "Primero",
                        sLast: "Último",
                        sNext: "Siguiente",
                        sPrevious: "Anterior"
                    },
                    oAria: {
                        sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                        sSortDescending: ": Activar para ordenar la columna de manera descendente"
                    }
                },
                "order": [
                    [1, "desc"]
                ]
            });
        });
        //Fin data tables


        //Botón de copiar código
        function myFunction(id) {
            /* Get the text field */
            var copyText = document.getElementById(id);

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            alert("¡Haz copiado la info de la película!: " + copyText.value);
        }
        //Fin botón de copiar código


        //Otra solucion para copiar el hidden campo
        function inputHidden(id) {
            var copyText = document.getElementById(id);
            copyText.type = 'text';
            copyText.select();
            document.execCommand("copy");
            copyText.type = 'hidden';
            alert("¡Haz copiado la info de la película!");
        }
        //Fin otra solucion para copiar el hidden campo
    </script>
</body>

</html>