<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "encuesta";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


if (isset($_GET['generar'])) {
    $opciones = ["Malo", "Regular", "Bien", "Muy bien", "Excelente"];
    $booleanos = ["Si", "No"];
    
    for ($i = 0; $i < 100; $i++) {
        $mayor_edad = $booleanos[array_rand($booleanos)];
        $sabor = $opciones[array_rand($opciones)];
        $calidad = $opciones[array_rand($opciones)];
        $presentacion = $opciones[array_rand($opciones)];
        $recomendacion = $booleanos[array_rand($booleanos)];
        
        $sql = "INSERT INTO respuestas (mayor_edad, sabor, calidad, presentacion, recomendacion) VALUES ('$mayor_edad', '$sabor', '$calidad', '$presentacion', '$recomendacion')";
        $conn->query($sql);
    }
    echo "<p>¡100 respuestas generadas aleatoriamente!</p>";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mayor_edad = $_POST['mayor_edad'];
    $sabor = $_POST['sabor'];
    $calidad = $_POST['calidad'];
    $presentacion = $_POST['presentacion'];
    $recomendacion = $_POST['recomendacion'];
    
    $sql = "INSERT INTO respuestas (mayor_edad, sabor, calidad, presentacion, recomendacion) VALUES ('$mayor_edad', '$sabor', '$calidad', '$presentacion', '$recomendacion')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registro exitoso'); window.location.href='grafico.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
 } ?>