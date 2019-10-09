<?php

$error = "";

if (isset($_POST['enviar'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $conexion = mysqli_connect("127.0.0.1","root","46598842","pokemons");

    if(empty($usuario) or empty($password)){
        $error = "<div class='w3-panel w3-blue'><p>Los datos ingresados son incorrectos</p></div>";
    }else {
        $sql = "SELECT * FROM usuario WHERE usuario = '" . $usuario . "' AND password = '" . $password . "'";
        $consulta = mysqli_query($conexion, $sql);
        if (!$consulta) {
            $error = "<div class='w3-panel w3-blue'><p>Los datos ingresados son incorrectos</p></div>";
        }else {
                $resultado = mysqli_fetch_assoc($consulta); /*Todos los datos que trae los guardo aca*/

                if ($resultado['password'] == $password) {
                    session_start();
                    $_SESSION['username'] = $usuario;
                    header("location:inicio.php");
                    exit();
                } else {
                    $error = "<div class='w3-panel w3-blue'><p>Los datos ingresados son incorrectos</p></div>";
                    $clase ="animated shake";
                }
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

            Usuario: <INPUT class="w3-input w3-border w3-sand" TYPE="text" NAME="usuario" > <br><br>
            Password: <INPUT class="w3-input w3-border w3-sand" TYPE="password" NAME="password" ><br><br>


            <center><button class="w3-btn w3-black" type="submit" name="enviar">Iniciar sesión</button></center>



        </form>
    </center>
</div>
</body>
</html>
