<?php

session_start();
echo "<p><center><h1 class=\"w3-container w3-blue\"><i>Panel de pokemones</i></h1></center></p><br>";
$conexion = mysqli_connect("127.0.0.1","root","46598842","pokemons");

$sql = "SELECT * FROM pokemones";
$resultado = mysqli_query($conexion,$sql);
$lista = mysqli_fetch_all($resultado);
$i=0;

echo "<table class=\"w3-table-all w3-hoverable\"> 
              <tr class=\"w3-light-grey\">
                <td class='nombre'><b>Nombre</b></td>
                <td class='tipo'><b>Tipo</b></td>
                <td class='tipo'><b>Imagen</b></td>
              </tr>";

while($i < count($lista)) {
    if(empty($lista[$i][4])){
        $img="";
    }
    else{
        $img="<img src='uploads/".$lista[$i][4]."' width='42'>";
    }

    echo "<tr>
                <td align='center'>".$lista[$i][1]."</td>
                <td style='padding-left: 10px'>".$lista[$i][2]."</td>
                 <td align='center'>".$lista[$i][3]."</td>
                <td align='center'><a href='modificar.php?id=".$lista[$i][0]."'>Modificar</a></td>
                <td align='center'><a href='baja.php?id=".$lista[$i][0]."'>Borrar</a></td>
              </tr>";
    $i++;
}


echo "</table>";
?><br><br>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<form method="post" action="buscar.php">
    <input name="palabra" placeholder="Palabra">
    <input type="submit" name="buscar" >
</form>
    <center><button class="w3-btn w3-black" type="submit" name="altapokemons"><a href='alta.php' >Ingresar nuevo pokemon</button></center><br>
    <center><button class="w3-btn w3-black"><a href='login.php' >Salir</button></center>



</body>
</html>