<?php

/* 
 *
 * @author kalina shkalova 
 */

include 'Connexio.php';

class Nuevo {
    // Método para agregar un nuevo producto
    public function agregarProducto() {
        // Verificar si se ha enviado el formulario de nuevo producto
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recuperar los datos del formulario
            $nom = $_POST['nom'];
            $descripcio = $_POST['descripcio'];
            $preu = $_POST['preu'];
            $categoria = $_POST['categoria'];
            $id = $_POST['id'];

            // Preparar la consulta SQL para insertar un nuevo producto
            $sql = "INSERT INTO productes (nom, descripció, preu, categoria, id) VALUES (?, ?, ?, ?)";

            // Preparar la sentencia SQL y vincular los parámetros
            global $conn; // Asegúrate de tener acceso a la conexión global
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdi", $nom, $descripcio, $preu, $categoria, $id);

            // Ejecutar la sentencia SQL
            if ($stmt->execute()) {
                echo "Producto agregado correctamente.";
            } else {
                echo "Error al agregar el producto: " . $conn->error;
            }

            // Cerrar la conexión
            $stmt->close();
            $conn->close();
        }
    }
}

// Instanciar la clase Nuevo
$nuevo = new Nuevo();

// Llamar al método agregarProducto
$nuevo->agregarProducto();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Nuevo Producto</title>
</head>
<body>
    <h2>Agregar Nuevo Producto</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Nombre: <input type="text" name="nom"><br><br>
        Descripción: <textarea name="descripcio"></textarea><br><br>
        Precio: <input type="text" name="preu"><br><br>
        Categoria: <input type="text" name="categoria"><br><br>
        ID: <input type="text" name="id"><br><br>
        <input type="submit" value="Agregar Producto">
    </form>
</body>
</html>