<?php

/**
 *
 *
 * @author kalina shkalova
 */

include 'Connexio.php';

class Elimina {
    // Método para eliminar un producto
    public function eliminarProducto() {
        // Verificar si se ha enviado el ID del producto a eliminar
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
            // Recuperar el ID del producto a eliminar
            $id = $_POST['id'];

            // Preparar la consulta SQL para eliminar el producto
            $sql = "DELETE FROM productes WHERE id = ?";

            // Preparar la sentencia SQL y vincular el parámetro
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);

            // Ejecutar la sentencia SQL
            if ($stmt->execute()) {
                echo "Producto eliminado correctamente.";
            } else {
                echo "Error al eliminar el producto: " . $conn->error;
            }

            // Cerrar la conexión
            $stmt->close();
            $conn->close();
        }
    }
}

// Instanciar la clase Elimina
$elimina = new Elimina();


// Llamar al método eliminarProducto
$elimina->eliminarProducto();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Producto</title>
</head>
<body>
    <h2>Eliminar Producto</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        ID del Producto a Eliminar: <input type="text" name="id"><br><br>
        <input type="submit" value="Eliminar Producto">
    </form>
</body>
</html>
