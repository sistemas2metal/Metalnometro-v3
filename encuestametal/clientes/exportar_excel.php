<?php
require 'vendor/autoload.php';
require '../conexion.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Ventas');
$sheet->setCellValue('B1', 'Caja');
$sheet->setCellValue('C1', 'Logistica');
$sheet->setCellValue('D1', 'Fecha y Hora');

// Obtener valores de filtro
$fechaInicio = $_POST['fecha_inicio'];
$fechaFin = $_POST['fecha_fin'];
$horaInicio = $_POST['hora_inicio'];
$horaFin = $_POST['hora_fin'];

// Construir consulta SQL con filtros
$sql = "SELECT id_cliente AS ID_Cliente,
            MAX(CASE WHEN id_pregunta = 2 THEN valoracion END) AS Valoracion_Ventas,
            MAX(CASE WHEN id_pregunta = 3 THEN valoracion END) AS Valoracion_Caja,
            MAX(CASE WHEN id_pregunta = 4 THEN valoracion END) AS Valoracion_Logistica,
            MAX(fecha_hora) AS Fecha_Hora
            FROM encuesta 
            WHERE fecha_hora BETWEEN '$fechaInicio $horaInicio' AND '$fechaFin $horaFin'
            GROUP BY id_cliente";

$result = $conexion->query($sql);

$rowNumber = 2;
while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $rowNumber, $row['Valoracion_Ventas']);
    $sheet->setCellValue('B' . $rowNumber, $row['Valoracion_Caja']);
    $sheet->setCellValue('C' . $rowNumber, $row['Valoracion_Logistica']);
    $sheet->setCellValue('D' . $rowNumber, $row['Fecha_Hora']);
    $rowNumber++;
}

$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="encuesta_clientes.xlsx"');
$writer->save('php://output');
?>
