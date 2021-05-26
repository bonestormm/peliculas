<?php 

function API($nombre_pelicula){
            
    $nombre_final=preg_replace('/\s+/', '%20', $nombre_pelicula);
    $url="https://api.themoviedb.org/3/search/movie?api_key=9a8c99e1b480ef6836c1a418c68aebac&query=$nombre_final&language=es"; //Definimos la url a usar.
    $json=file_get_contents($url); //Obtenemos el contenido del resultado
    global $datos;
    $datos=json_decode($json,true); //Lo volvemos json para php
               
    
    if($datos["total_results"]==0){
        global $resultados;
        echo "No hay resultados";
    }
    
    
}

function latest(){
    $page=rand(1,500);
    $url='https://api.themoviedb.org/3/movie/popular?api_key=9a8c99e1b480ef6836c1a418c68aebac&language=es&page='.$page; //Definimos la url a usar.
    $json=file_get_contents($url); //Obtenemos las mas populares
    $datos=json_decode($json,true); //Lo volvemos json para php
    return $datos;

}