<?php include 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información sobre películas</title>
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
    <div class="container_main">
        <form action="resultado.php" method="get">
            <div class="form-group">
                <h3 class="title">¿Cómo se llama la película?</h3>
                <input type="text" class="form-control input_name" id="InputNombrePelicula" placeholder="Nombre de la película" name="nombre_pelicula" align="center">
                <div class="btn_div">
                    <button type="submit" class="btn btn-primary btn_send btn_sen">Consultar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
        <h2>Películas populares</h2>
        <div class="popular">
            <?php
            $popular = latest();
            for ($i = 0; $i < 3; $i++) {  ?>
                <div class="card card_popular">
                <img src='https://image.tmdb.org/t/p/w200<?php echo $popular["results"][$i]["poster_path"] ?>' class="card-img-top" alt="<?php echo $popular["results"][$i]["title"] ?>">
                    <div class="card-body">
                        <h5 class="card-title center-text"><?php echo $popular["results"][$i]["title"] ?></h5>
                        <p class="card-text"><?php echo $popular["results"][$i]["vote_average"] ?></p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <footer class="footer">
        <div class="container_footer" bis_skin_checked="1">
            <span class="text-muted center">Made with ❤ by <a href="https://github.com/bonestormm" target="_blank">Carlos Lagos</a></span>
        </div>
    </footer>
</body>

</html>