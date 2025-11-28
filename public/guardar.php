<?php

declare(strict_types=1);


require_once __DIR__ . '/../src/datos.php';
require_once __DIR__ . '/../src/validaciones.php';
require_once __DIR__ . '/../src/almacenamiento.php';
require_once __DIR__ . '/../src/vistas.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$valores = [
    'nombre' => limpiarTexto($_POST['nombre'] ?? ''),
    'apellidos' => limpiarTexto($_POST['apellidos'] ?? ''),
    'dni' => normalizarDni($_POST['dni'] ?? ''),
    'correo' => limpiarTexto($_POST['correo'] ?? ''),
    'telefono' => limpiarTexto($_POST['telefono'] ?? ''),
    'fecha_alta' => limpiarTexto($_POST['fecha_alta'] ?? ''),
    'provincia' => limpiarTexto($_POST['provincia'] ?? ''),
    'sede' => limpiarTexto($_POST['sede'] ?? ''),
    'departamento' => limpiarTexto($_POST['departamento'] ?? '')
];

$errores = [];

if (!validarTexto($valores['nombre'])) {
    $errores['nombre'] = 'El nombre es obligatorio.';
}

if (!validarTexto($valores['apellidos'])) {
    $errores['apellidos'] = 'Los apellidos son obligatorios.';
}

if (!validarDni($valores['dni'])) {
    $errores['dni'] = 'Introduce un DNI válido (8 dígitos y letra correcta).';
}

if (!validarEmail($valores['correo'])) {
    $errores['correo'] = 'El correo debe ser válido.';
}

if (!validarTelefono($valores['telefono'])) {
    $errores['telefono'] = 'El teléfono debe tener entre 9 y 15 dígitos.';
}

if (!validarFecha($valores['fecha_alta'])) {
    $errores['fecha_alta'] = 'Debes indicar una fecha de alta válida.';
}

$provincias = obtenerProvincias();
$sedes = obtenerSedes();
$departamentos = obtenerDepartamentos();

if (!validarSeleccion($valores['provincia'], $provincias)) {
    $errores['provincia'] = 'Selecciona una provincia.';
}

if (!validarSeleccion($valores['sede'], $sedes)) {
    $errores['sede'] = 'Selecciona una sede.';
}

if (!validarSeleccion($valores['departamento'], $departamentos)) {
    $errores['departamento'] = 'Selecciona un departamento.';
}

if (!empty($errores)) {
    iniciarPagina('Errores en el formulario');
    ?>
    <h1>Corrige los errores</h1>
    <p>Revisa los campos marcados y vuelve a intentarlo.</p>
    <?php mostrarFormulario($valores, $errores); ?>
    <?php cerrarPagina();
    exit;
}

$registro = [
    'nombre' => $valores['nombre'],
    'apellidos' => $valores['apellidos'],
    'dni' => $valores['dni'],
    'correo' => $valores['correo'],
    'telefono' => $valores['telefono'],
    'fecha_alta' => $valores['fecha_alta'],
    'provincia' => $valores['provincia'],
    'sede' => $valores['sede'],
    'departamento' => $valores['departamento'],
    'registrado_en' => date('c')
];

$guardados = leerEmpleados();
$guardados[] = $registro;
guardarEmpleados($guardados);

iniciarPagina('Alta completada');
?>
<h1>Alta registrada</h1>
<p>El empleado se ha registrado correctamente y los datos se han guardado en el fichero.</p>
<?php mostrarResumen($registro); ?>
<?php cerrarPagina(); ?>
