<?php
require 'vendor/autoload.php';
require '../conexion.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Valoración');
$sheet->setCellValue('B1', 'Fecha y Hora');

// Obtener valores de filtro
$fechaInicio = $_POST['fecha_inicio'];
$fechaFin = $_POST['fecha_fin'];
$horaInicio = $_POST['hora_inicio'];
$horaFin = $_POST['hora_fin'];

// Construir consulta SQL con filtros
$sql = "SELECT valoracion, fecha_hora FROM encuesta_empleados WHERE fecha_hora BETWEEN '$fechaInicio $horaInicio' AND '$fechaFin $horaFin'";
$result = $conexion->query($sql);

$rowNumber = 2;
while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $rowNumber, $row['valoracion']);
    $sheet->setCellValue('B' . $rowNumber, $row['fecha_hora']);
    $rowNumber++;
}

$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="encuesta_empleados.xlsx"');
$writer->save('php://output');
?>
