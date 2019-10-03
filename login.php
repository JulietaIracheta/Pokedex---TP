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
            header('location:inicio.php');
            exit();
        }else{
            $error="Error al inicar sesión.";
        }
    }
}

echo "<h2>$error</h2>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesion</title>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body background="pikachu.png">


<div class="w3-card-4">
    <div class="w3-container w3-blue">
        <center> <h2><b><i>Iniciar sesión</i></b></h2></center>
    </div>
    <center><form class="w3-container" method="post" action="login.php">

            Usuario: <INPUT class="w3-input w3-border w3-sand" TYPE="text" NAME="usuario" required> <br><br>
            Password: <INPUT class="w3-input w3-border w3-sand" TYPE="password" NAME="password" required><br><br>


            <center><button class="w3-btn w3-black" type="submit" name="enviar">Iniciar sesión</button></center>


        </form>
    </center>
</div>
</body>
</html>
