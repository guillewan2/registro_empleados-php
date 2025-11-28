<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/almacenamiento.php';
require_once __DIR__ . '/../src/vistas.php';

$empleados = leerEmpleados();

iniciarPagina('Empleados registrados');
?>
<h1>Empleados registrados</h1>
<p>A continuación tienes el listado completo de los empleados registrados hasta ahora.</p>
<?php mostrarListadoEmpleados($empleados); ?>
<?php cerrarPagina(); ?>
