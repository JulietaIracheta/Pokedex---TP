<?php
session_start();
$error = "";
if(isset($_POST['buscar'])){
    $buscar = $_POST ['buscar'];
    $conexion = mysqli_connect("127.0.0.1","root","46598842","pokemons");
    if(!$conexion){
        echo "ERROR de conexion a la BD";
        die;
    }
$sql = "SELECT * FROM pokemones WHERE nombre =$buscar";
$resultado = mysqli_query($conexion,$sql);
    if(!$resultado) {
        echo "No ha buscado nada";
        /*   header('location:inicio.php');*/
        exit();
    }
}
?>