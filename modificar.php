<?php
$error = "";
$conexion = mysqli_connect("127.0.0.1","root","46598842","pokemons");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM pokemones WHERE id = '$id'";
    $resultado = mysqli_query($conexion, $sql);
    if (!$resultado) {
        $error = "Error - No se pudo encontrar esa nota";
    }
    $registro = mysqli_fetch_assoc($resultado);
}
else if (isset($_POST['enviar'])){
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];

    if (empty($_FILES['uploadedfile']['name'])){
        $sql= "UPDATE pokemones SET nombre='$nombre', tipo='$tipo' where id='$id'";
        $resultado = mysqli_query($conexion,$sql);
        header('location:inicio.php');
        if(!$resultado){
            $error = "Error - No se pudieron guardar los datos";
        }
        die;
    } else{
        $uploadedfileload = "true";
        $msg = "";
        $uploadedfile_size = $_FILES['uploadedfile']['size'];
        echo $_FILES['uploadedfile']['name'];
        if ($_FILES['uploadedfile']['size'] > 200000) {
            $msg = $msg . "El archivo es mayor que 200KB, debes reducirlo antes de subirlo<BR>";
            $uploadedfileload = "false";
        }

        if (!($_FILES['uploadedfile']['type'] == "image/jpeg" OR $_FILES['uploadedfile']['type'] == "image/gif" OR $_FILES[uploadedfile][type] == "image/png")) {
            $msg = $msg . " Tu archivo tiene que ser JPG o GIF. Otros archivos no son permitidos<BR>";
            $uploadedfileload = "false";
        }

        $file_name = $_FILES['uploadedfile']['name'];
        $add = "uploads/$file_name";
        if ($uploadedfileload == "true") {

            if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $add)) {
                echo "El archivo ".  basename( $_FILES['uploadedfile']['name']).
                    " ha sido subido";
                echo " Ha sido subido satisfactoriamente";
            } else {
                echo "Error al subir el archivo";
            }

        } else {
            echo $msg;
        }

        $sql= "UPDATE pokemones SET imagen='".basename( $_FILES['uploadedfile']['name'])."', nombre='$nombre', tipo='$tipo' where id='$id'";
        $resultado = mysqli_query($conexion,$sql);
        header('location:inicio.php');
        if(!$resultado){
            $error = "Error - No se pudieron guardar los datos";
        }
        die;
    }
}
echo "<h2>$error</h2>";
?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="w3-container w3-blue">
    <p><b><i><center><h1>Modificación de pokemones</h1></center></i></b></p>
</div><br><br>

<form class="w3-container" method="POST" action="modificar.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $registro['id']; ?>">
    <label for="nombre"><b><i>Nombre:</i></b></label>
    <input class="w3-input" type="text" name="nombre" value="<?php echo $registro['nombre']; ?>">
    <br><br><br>

    <label for="tipo"><b><i>Tipo:</i></b></label>
    <input class="w3-input" type="text" name="tipo" value="<?php echo $registro['tipo']; ?>">
    <br><br><br>


    <label for="imagen"><b><i>Imagen:</i></b></label>
    <input class="w3-input" name="uploadedfile" value=".$registro['imagen']." type="file" />

    <?php
    if(empty($registro['imagen'])){
            echo "El pokemón no tiene ninguna imagen asociada";
    }
    else{
        $img="<img src='uploads/".$registro['imagen']."' width='150'>";
        echo $img;
    }
    ?>
    <br>
    <center><button class="w3-btn w3-black" type="submit" name="enviar">Guardar</button></center>
</form>