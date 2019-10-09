<?php
echo "<p><center><h1 class=\"w3-container w3-blue\"><i>Pokemón Buscado</i></h1></center></p><br>";
$busca = "";
$error ="";
$busca=$_POST['buscar'];
$conexion = mysqli_connect("127.0.0.1","root","46598842","pokemons");
if($busca!=""){
    $busqueda=mysqli_query($conexion, "SELECT * FROM pokemones WHERE nombre LIKE '%".$busca."%'");}
else {
    $error = "<div class='w3-panel w3-red'><p>El nombre de usuario ya existe</p></div>";
    header("Location:inicio.php");
    exit();
}
?>


<table  class="w3-table-all w3-hoverable" width="1166" border="1" id="tab">
    <tr class="w3-light-grey">
        <td width="61">Nombre: </td>
        <td width="157">Tipo: </td>
        <td width="157">Imagen: </td>

    </tr>

    <?php
    while($f=mysqli_fetch_array($busqueda)){
        echo '<tr>';
        echo '<td width="61">'.$f['nombre'].'</td>';
        echo '<td width="157">'.$f['tipo'].'</td>';
        echo '<td width="221">'.$f['imagen'].'</td>';
        echo '</tr>';
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Inicio</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <center><button class="w3-btn w3-black"><a href='inicio.php' >Salir</button></center><br>
    </head>
    </html>