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
                <td class='imagen'>Imagen</td>
                <td class='editar'>Editar</td>
                <td class='borrar'>Borrar</td>
              </tr>";

while($i < count($lista)) {
    if(empty($lista[$i][3])){
        $img="";
    }
    else{
        $img="<img src='uploads/".$lista[$i][2]."' width='42'>";
    }

    echo "<tr>
                <td align='center'>".$lista[$i][1]."</td>
                <td style='padding-left: 10px'>".$lista[$i][3]."</td>
                <td align='center'><a href='modificar.php?id=".$lista[$i][0]."'><img src='img/editar.png'></a></td>
                <td align='center'><a href='eliminar.php?id=".$lista[$i][0]."'><img src='img/borrar.pg'></a></td>
              </tr>";
    $i++;
}
echo "</table>";
?>

<button onclick="location.href='salir.php'">Salir</button>
