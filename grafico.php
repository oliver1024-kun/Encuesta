<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "encuesta";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

function obtenerDatos($conn, $campo) {
    $sql = "SELECT $campo, COUNT(*) as cantidad FROM respuestas GROUP BY $campo";
    $result = $conn->query($sql);
    $datos = [];
    while ($row = $result->fetch_assoc()) {
        $datos[$row[$campo]] = (int)$row['cantidad'];
    }
    return $datos;
}
$saborData = obtenerDatos($conn, "sabor");
$recomendacionData = obtenerDatos($conn, "recomendacion");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gráficos de Encuesta</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Resultados en Gráficos</h2>
    
    <canvas id="chartSabor" width="600" height="400"></canvas>
    <canvas id="chartRecomendacion" width="600" height="400"></canvas>
    
    <script>
        const ctxSabor = document.getElementById('chartSabor').getContext('2d');
        const chartSabor = new Chart(ctxSabor, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode(array_keys($saborData)); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_values($saborData)); ?>,
                    backgroundColor: ['red', 'blue', 'green', 'yellow', 'purple']
                }]
            },
            options: { responsive: true, title: { display: true, text: 'Opinión sobre el Sabor' } }
        });
        
        const ctxRecomendacion = document.getElementById('chartRecomendacion').getContext('2d');
        const chartRecomendacion = new Chart(ctxRecomendacion, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_keys($recomendacionData)); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_values($recomendacionData)); ?>,
                    backgroundColor: ['orange', 'cyan']
                }]
            },
            options: { responsive: true, title: { display: true, text: '¿Recomendarías el Producto?' } }
        });
    </script>
</body>
</html>


<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "encuesta";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT id, mayor_edad, sabor, calidad, presentacion, recomendacion FROM respuestas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Respuestas de Encuesta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Respuestas de la Encuesta</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Mayor de Edad</th>
            <th>Sabor</th>
            <th>Calidad</th>
            <th>Presentación</th>
            <th>Recomendación</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['mayor_edad']}</td>
                    <td>{$row['sabor']}</td>
                    <td>{$row['calidad']}</td>
                    <td>{$row['presentacion']}</td>
                    <td>{$row['recomendacion']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay datos disponibles</td></tr>";
        }
        $conn->close();
        ?>
    </table>

</body>
</html>
