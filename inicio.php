<?php

session_start();

echo "<p class='descripcion'>Panel de noticias</p>";
echo "<div class='menu'><a href='alta.php'>Ingresar nuevo pokemon</a></div>";
$conexion = mysqli_connect("127.0.0.1","root","46598842","pokemons");

$sql = "SELECT * FROM pokemones";
$resultado = mysqli_query($conexion,$sql);
$lista = mysqli_fetch_all($resultado);
$i=0;

echo "<table>
              <tr>
                <td class='nombre'>Nombre</td>
                <td class='tipo'>Tipo</td>
             
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
                <td align='center'><a href='modificar.php?id=".$lista[$i][0]."'>Modificar</a></td>
                <td align='center'><a href='baja.php?id=".$lista[$i][0]."'>Borrar</a></td>
              </tr>";
    $i++;
}
echo "</table>";
?>

<button onclick="location.href='salir.php'">Salir</button>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>
<body>

</body>
</html>