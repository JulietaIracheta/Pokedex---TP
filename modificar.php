<link rel=StyleSheet href="apc.css" type="text/css" media=screen>
<script src="/fydt/apc/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#mytextarea',
        width: 600,
        height: 300,
        plugins: [
            'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
            'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
            'save table directionality emoticons template paste'
        ],
        content_css: 'css/content.css',
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
        toolbar2: 'fontselect',
        font_formats: 'Arial=arial,helvetica,sans-serif; Courier New=courier new,courier,monospace; AkrutiKndPadmini=Akpdmi-n'

    });
</script>


<?php
$error = "";
$conexion = mysqli_connect("127.0.0.1","root","46598842","pokemons");

if(!$conexion){
    echo "ERROR de conexion a la BD";
    die;
}

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
        //persiste en la BD
        /*$sql = "SELECT * FROM noticias WHERE id = '$id'";
        $resultado = mysqli_query($conexion, $sql);*/
        $sql= "UPDATE pokemones SET nombre='$nombre', tipo='$tipo' where id='$id'";
        $resultado = mysqli_query($conexion,$sql);
        header('location:inicio.php');
        if(!$resultado){
            $error = "Error - No se pudieron guardar los datos";
        }
        die;
    }
    else{
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

            if (move_uploaded_file($_FILES[uploadedfile][tmp_name], $add)) {
                echo "El archivo ".  basename( $_FILES['uploadedfile']['name']).
                    " ha sido subido";
                echo " Ha sido subido satisfactoriamente";
            } else {
                echo "Error al subir el archivo";
            }

        } else {
            echo $msg;
        }


        //persiste en la BD
        /*$sql = "SELECT * FROM noticias WHERE id = '$id'";
        $resultado = mysqli_query($conexion, $sql);*/
        $sql= "UPDATE noticias SET imagen='".basename( $_FILES['uploadedfile']['name'])."', titulo='$nombre', nota='$tipo' where id='$id'";
        $resultado = mysqli_query($conexion,$sql);
        header('location:inicio.php');
        if(!$resultado){
            $error = "Error - No se pudieron guardar los datos";
        }
        die;
    }
}

// $sql = "UPDATE agenda SET nombre='$nombre', direccion='$direccion',"."telefono='$telefono', email='$email'";



echo "<h2>$error</h2>";
?>
<p class='descripcion'>Modificación de pokemones</p>
<form method="POST" action="modificar.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $registro['id']; ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $registro['nombre']; ?>">
    <br><br><br>

    <label for="tipo">Tipo:</label>
    <input type="text" name="tipo" value="<?php echo $registro['tipo']; ?>">
    <br><br><br>


    <label for="imagen">Imagen:</label>
    <!--   <input class="input-group" type="file" name="user_image" accept="image/*" />   -->
    <input name="uploadedfile" value=".$registro['imagen']." type="file" />

    <?php
    if(empty($registro['imagen'])){
        echo "La noticia no tiene ninguna imagen asociada";
    }
    else{
        $img="<img src='uploads/".$registro['imagen']."' width='150'>";
        echo $img;
    }
    ?>
    <br>
    <button type="submit" name="enviar">Guardar</button>
</form>

