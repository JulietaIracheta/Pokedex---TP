<?php

$error = "";

if (isset($_POST['enviar'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $conexion = mysqli_connect("127.0.0.1","root","46598842","pokemons");

    if(!$conexion){
        echo "ERROR de conexion a la BD";
        die;
    }

    $sql= "SELECT * FROM usuario WHERE usuario = '".$usuario."'";
    $resultado = mysqli_query($conexion,$sql);
    if(!$resultado){
        $error = "Error al inicar sesion.";
    }else{
        $lista = mysqli_fetch_assoc($resultado);
        if($lista["password"] == $password){

            session_start();
            $_SESSION['selogueo'] = true;
            header('location:inicio.html');
            exit();
        }else{
            $error="Error al inicar sesion.2";
        }
    }
}

echo "<h2>$error</h2>";


?>