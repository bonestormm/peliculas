<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- Data tables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
    <!-- Fin Data tables -->

</head>
<body>
    <style>
        .centerdiv{
        margin: auto;
        width: 60%;
        padding: 10px;
    }

        .centro{
            text-align: center;
        }
    </style>
<?php
    $txtTitulo=(isset($_POST['txtTitulo']))?$_POST['txtTitulo']:"";
    $txtDescripcion=(isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
    $url_final=(isset($_POST['url_final']))?$_POST['url_final']:"";
    $nombre_pelicula=(isset($_GET['nombre_pelicula']))?$_GET['nombre_pelicula']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";
    

        function API($nombre_pelicula){
            
            $nombre_final=preg_replace('/\s+/', '%20', $nombre_pelicula);
            $url="https://api.themoviedb.org/3/search/movie?api_key=9a8c99e1b480ef6836c1a418c68aebac&query=$nombre_final&language=es"; //Definimos la url a usar.
            $json=file_get_contents($url); //Obtenemos el contenido del resultado
            global $datos;
            $datos=json_decode($json,true); //Lo volvemos json para php
                       
            /*$nombre=$datos["title"];
            $descripcion=$datos["overview"];
            */
            if($datos["total_results"]==0){
                global $resultados;
                echo "No hay resultados";
            }
            
            /*if($datos["total_results"]>0){ 
                 
            }*/
        }
        ?>


    <div class="container">
        <form>
            <div class="form-group" action="" method="get">
                <h3 align="center">¿Cómo se llama la película?</h3>
                <input type="text" class="form-control col-md-6 centerdiv" id="InputNombrePelicula" placeholder="Nombre de la película" name="nombre_pelicula" align="center">
                <div class="centro">
                    <br/>
                    <button type="submit" class="btn btn-primary">Consultar</button>
                </div>
                
            </div>
            
        </form>
        
        <?php 
            if(!empty($nombre_pelicula)){
                API($nombre_pelicula); ?>

                <table id="tabla" class="display">
                <thead>
                    <tr>
                        <th>Nombre película</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                    <tbody>  
                        <?php
                        foreach($datos["results"] as $dato){ 

                                $url_imagen=$dato["poster_path"];

                                if(empty($dato['overview'])){
                                    $dato['overview']="No se encontró descripción.";
                                }

                                if(!empty($dato["poster_path"])){
                                    $url_final="https://image.tmdb.org/t/p/w200".$url_imagen;
                                }
                                else{
                                    $url_final="imagenes/error.png";
                                }
                        ?>
                                <tr>
                                <td><?php echo $dato['title'] ?></td>
                                <td><?php echo $dato['overview']?></td>
                                <td><img src='<?php echo $url_final ?>' alt=''></td>
                                <td>

                                <input type="hidden" value="<?php echo $dato['title']."\n".$dato['overview']."\n".$url_final ?>" id="myInput<?php echo $dato['id'];?>">
                                <button onclick="inputHidden('myInput<?php echo $dato['id'];?>')" class="btn btn-info">Copiar info</button>

                                </td>   
                                </tr>

                    <?php   }  ?>
                    </tbody>
                </table>
                
            <?php } ?>             
    </div>
</body>
<script>

    //Data tables
$(document).ready( function () {
    $('#tabla').DataTable();
} );
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
        function inputHidden(id){
            var copyText = document.getElementById(id);
            copyText.type = 'text';
            copyText.select();
            document.execCommand("copy");
            copyText.type = 'hidden';
            alert("¡Haz copiado la info de la película!");
        }
    //Fin otra solucion para copiar el hidden campo

</script>
</html>