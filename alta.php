<link rel=StyleSheet href="apc.css" type="text/css" media=screen>
<script src="/fydt/apc/tinymce/tinymce.min.js"></script>


<?php
$error = "";

if (isset($_POST['enviar'])) {
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];

    $conexion = mysqli_connect("127.0.0.1","root","46598842","pokemons");

    if(!$conexion){
        echo "ERROR de conexion a la BD";
        die;
    }



    // sube un archivo
    /* $target_path = "uploads/";
     $target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
     if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
         echo "El archivo ".  basename( $_FILES['uploadedfile']['name']).
             " ha sido subido";
     } else{
         echo "Ha ocurrido un error, trate de nuevo!";
     }*/


    $uploadedfileload = "true";
    $msg = "";
    $uploadedfile_size = $_FILES['uploadedfile']['size'];
    echo $_FILES['uploadedfile']['name'];

    if ($_FILES['uploadedfile']['size'] > 4000000) {
        $msg = $msg . "El archivo es mayor que 400KB, debes reduzcirlo antes de subirlo<BR>";
        $uploadedfileload = "false";
    }

    if (!($_FILES['uploadedfile']['type'] == "image/jpeg" OR $_FILES['uploadedfile']['type'] == "image/gif" OR $_FILES['uploadedfile']['type'] == "image/png")) {
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

    $fecha = date("d.m.y");
    //persiste en la BD
    $sql= "INSERT INTO pokemones (nombre, tipo) VALUES ('".$fecha."','".basename( $_FILES['uploadedfile']['name'])."','nombre','$tipo')";
    // $sql= "INSERT INTO noticias (fecha, imagen, titulo, nota) VALUES ('".$fecha."','".basename( $_FILES['uploadedfile']['name'])."','".$titulo."', '".$desarrollo."')";
    // $sql= "UPDATE noticias SET imagen='".basename( $_FILES['uploadedfile']['name'])."', titulo='$titulo', nota='$desarrollo' where id='$id'";
    $resultado = mysqli_query($conexion,$sql);
    if(!$resultado){
        $error = "Error - No se pudieron guardar los datos";
    }
}

echo "<h2>$error</h2>";
?>
<p class='descripcion'>Ingreso de pokemones</p>
<form method="POST" action="alta.php" enctype="multipart/form-data">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre">
    <br><br><br>

    <label for="tipo">Tipo</label>
    <input type="text" name="tipo">
    <br><br><br>
    <br><br><br>
    <label for="imagen">Imagen:</label>
    <input name="uploadedfile" type="file" />
    <div id="preview"></div>
    <!--<input id="imagen" name="imagen" size="30" type="file">-->
    <br><br><br>
    <button type="submit" name="enviar">Guardar</button>
</form>
