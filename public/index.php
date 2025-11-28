<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/datos.php';
require_once __DIR__ . '/../src/validaciones.php';
require_once __DIR__ . '/../src/vistas.php';

$valores = [
    'nombre' => '',
    'apellidos' => '',
    'dni' => '',
    'correo' => '',
    'telefono' => '',
    'fecha_alta' => '',
    'provincia' => '',
    'sede' => '',
    'departamento' => ''
];

$errores = [];

iniciarPagina('Registro de empleados');
?>
<h1>Formulario de alta</h1>
<p>Completa los campos del empleado y guarda el resumen final.</p>
<?php mostrarFormulario($valores, $errores); ?>
<?php cerrarPagina(); ?>