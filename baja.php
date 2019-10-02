<?php
$conexion = mysqli_connect("127.0.0.1","root","46598842","pokemons");

if(!$conexion){
    echo"Error al conectar con la BD";
    die;
}

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $sql = "DELETE FROM pokemones WHERE id = $id";
    $resultado = mysqli_query($conexion,$sql);

    if(!$resultado){
        echo "No se ha encontrado ese pokemon";
    }
    header("location:inicio.php");
}
?>