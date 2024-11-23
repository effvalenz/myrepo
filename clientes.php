<?php
$servername = "sql308.infinityfree.com";
$username = "if0_37678564";
$password = "Videotape1";
$dbname = "if0_37678564_uni";

// crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// revisar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// petición get
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM tbl_clientes";
    $result = $conn->query($sql);

    $customers = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }
    }
    echo json_encode($customers);
}

// petición post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente = $_POST['id_cliente'];
    $nombre = $_POST['nombre'];
    $apellido_p = $_POST['apellido_p'];
    $apellido_m = $_POST['apellido_m'];
    $sexo = $_POST['sexo'];
    $edad = $_POST['edad'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $sucursal = $_POST['sucursal'];
    $contrasena = $_POST['contrasena'];

    $sql = "INSERT INTO tbl_clientes (id_cliente, nombre, apellido_p, apellido_m, sexo, edad, celular, email, sucursal, contrasena) 
    VALUES ('$id_cliente', '$nombre', '$apellido_p', '$apellido_m', '$sexo', '$edad', '$celular', '$email', '$sucursal', '$contrasena')";
    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>