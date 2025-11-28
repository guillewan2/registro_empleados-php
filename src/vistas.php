<?php

declare(strict_types=1);

require_once __DIR__ . '/datos.php';

function iniciarPagina(string $titulo): void
{
    ?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($titulo, ENT_QUOTES) ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="page">
<section class="panel">
    <?php
}

function cerrarPagina(): void
{
    ?>
</section>
</body>
</html>
    <?php
}

function mostrarErroresGenerales(array $errores): void
{
    if (empty($errores)) {
        return;
    }
    ?>
<div class="error-list">
    <ul>
        <?php foreach ($errores as $error): ?>
            <li><?= htmlspecialchars($error, ENT_QUOTES) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
    <?php
}

function mostrarFormulario(array $valores = [], array $errores = []): void
{
    $provincias = obtenerProvincias();
    $sedes = obtenerSedes();
    $departamentos = obtenerDepartamentos();

    $nombre = $valores['nombre'] ?? '';
    $apellidos = $valores['apellidos'] ?? '';
    $dni = $valores['dni'] ?? '';
    $correo = $valores['correo'] ?? '';
    $telefono = $valores['telefono'] ?? '';
    $fecha_alta = $valores['fecha_alta'] ?? '';
    $provincia = $valores['provincia'] ?? '';
    $sede = $valores['sede'] ?? '';
    $departamento = $valores['departamento'] ?? '';

    mostrarErroresGenerales($errores);
    ?>
<form action="guardar.php" method="post" novalidate>
    <div class="form-row">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($nombre, ENT_QUOTES) ?>" required>
        <?php if (isset($errores['nombre'])): ?>
            <span class="field-error"><?= htmlspecialchars($errores['nombre'], ENT_QUOTES) ?></span>
        <?php endif; ?>
    </div>
    <div class="form-row">
        <label for="apellidos">Apellidos</label>
        <input type="text" id="apellidos" name="apellidos" value="<?= htmlspecialchars($apellidos, ENT_QUOTES) ?>" required>
        <?php if (isset($errores['apellidos'])): ?>
            <span class="field-error"><?= htmlspecialchars($errores['apellidos'], ENT_QUOTES) ?></span>
        <?php endif; ?>
    </div>
    <div class="form-row">
        <label for="dni">DNI</label>
        <input type="text" id="dni" name="dni" value="<?= htmlspecialchars($dni, ENT_QUOTES) ?>" required>
        <?php if (isset($errores['dni'])): ?>
            <span class="field-error"><?= htmlspecialchars($errores['dni'], ENT_QUOTES) ?></span>
        <?php endif; ?>
    </div>
    <div class="form-row">
        <label for="correo">Correo electrónico</label>
        <input type="email" id="correo" name="correo" value="<?= htmlspecialchars($correo, ENT_QUOTES) ?>" required>
        <?php if (isset($errores['correo'])): ?>
            <span class="field-error"><?= htmlspecialchars($errores['correo'], ENT_QUOTES) ?></span>
        <?php endif; ?>
    </div>
    <div class="form-row">
        <label for="telefono">Teléfono</label>
        <input type="tel" id="telefono" name="telefono" value="<?= htmlspecialchars($telefono, ENT_QUOTES) ?>" required>
        <?php if (isset($errores['telefono'])): ?>
            <span class="field-error"><?= htmlspecialchars($errores['telefono'], ENT_QUOTES) ?></span>
        <?php endif; ?>
    </div>
    <div class="form-row">
        <label for="fecha_alta">Fecha de alta</label>
        <input type="date" id="fecha_alta" name="fecha_alta" value="<?= htmlspecialchars($fecha_alta, ENT_QUOTES) ?>" required>
        <?php if (isset($errores['fecha_alta'])): ?>
            <span class="field-error"><?= htmlspecialchars($errores['fecha_alta'], ENT_QUOTES) ?></span>
        <?php endif; ?>
    </div>
    <div class="form-row">
        <label for="provincia">Provincia</label>
        <select id="provincia" name="provincia" required>
            <option value="">Selecciona una provincia</option>
            <?php foreach ($provincias as $clave => $texto): ?>
                <option value="<?= htmlspecialchars($clave, ENT_QUOTES) ?>" <?= $clave === $provincia ? 'selected' : '' ?>>
                    <?= htmlspecialchars($texto, ENT_QUOTES) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errores['provincia'])): ?>
            <span class="field-error"><?= htmlspecialchars($errores['provincia'], ENT_QUOTES) ?></span>
        <?php endif; ?>
    </div>
    <div class="form-row">
        <label for="sede">Sede</label>
        <select id="sede" name="sede" required>
            <option value="">Selecciona una sede</option>
            <?php foreach ($sedes as $clave => $texto): ?>
                <option value="<?= htmlspecialchars($clave, ENT_QUOTES) ?>" <?= $clave === $sede ? 'selected' : '' ?>>
                    <?= htmlspecialchars($texto, ENT_QUOTES) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errores['sede'])): ?>
            <span class="field-error"><?= htmlspecialchars($errores['sede'], ENT_QUOTES) ?></span>
        <?php endif; ?>
    </div>
    <div class="form-row">
        <label for="departamento">Departamento</label>
        <select id="departamento" name="departamento" required>
            <option value="">Selecciona un departamento</option>
            <?php foreach ($departamentos as $clave => $texto): ?>
                <option value="<?= htmlspecialchars($clave, ENT_QUOTES) ?>" <?= $clave === $departamento ? 'selected' : '' ?>>
                    <?= htmlspecialchars($texto, ENT_QUOTES) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errores['departamento'])): ?>
            <span class="field-error"><?= htmlspecialchars($errores['departamento'], ENT_QUOTES) ?></span>
        <?php endif; ?>
    </div>
    <div class="form-actions">
        <button type="submit">Registrar empleado</button>
    </div>
</form>
    <?php
}

function mostrarResumen(array $datos): void
{
    ?>
<div class="resumen">
    <h2>Resumen del alta</h2>
    <dl>
        <dt>Nombre completo</dt>
        <dd><?= htmlspecialchars($datos['nombre'] . ' ' . $datos['apellidos'], ENT_QUOTES) ?></dd>
        <dt>DNI</dt>
        <dd><?= htmlspecialchars($datos['dni'], ENT_QUOTES) ?></dd>
        <dt>Correo</dt>
        <dd><?= htmlspecialchars($datos['correo'] ?? ($datos['email'] ?? ''), ENT_QUOTES) ?></dd>
        <dt>Teléfono</dt>
        <dd><?= htmlspecialchars($datos['telefono'], ENT_QUOTES) ?></dd>
        <dt>Fecha de alta</dt>
        <dd><?= htmlspecialchars($datos['fecha_alta'], ENT_QUOTES) ?></dd>
        <dt>Provincia</dt>
        <dd><?= htmlspecialchars($datos['provincia'], ENT_QUOTES) ?></dd>
        <dt>Sede</dt>
        <dd><?= htmlspecialchars($datos['sede'], ENT_QUOTES) ?></dd>
        <dt>Departamento</dt>
        <dd><?= htmlspecialchars($datos['departamento'], ENT_QUOTES) ?></dd>
    </dl>
    <hr>
    <div class="resumen-actions">
        <a class="resumen-link primary" href="index.php">Registrar otro empleado</a>
        <a class="resumen-link secondary" href="empleados.php">Ver empleados</a>
    </div>
</div>
    <?php
}

function mostrarListadoEmpleados(array $empleados): void
{
    if (empty($empleados)) {
        ?>
        <div class="resumen">
            <p>No hay empleados registrados todavía.</p>
        </div>
        <?php
        return;
    }

    ?><table class="employee-table">
        <thead>
        <tr>
            <th>Nombre completo</th>
            <th>DNI</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Fecha alta</th>
            <th>Provincia</th>
            <th>Sede</th>
            <th>Departamento</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($empleados as $empleado):
            $correo = $empleado['correo'] ?? ($empleado['email'] ?? '');
            ?>
            <tr>
                <td><?= htmlspecialchars(($empleado['nombre'] ?? '') . ' ' . ($empleado['apellidos'] ?? ''), ENT_QUOTES) ?></td>
                <td><?= htmlspecialchars($empleado['dni'] ?? '', ENT_QUOTES) ?></td>
                <td><?= htmlspecialchars($correo, ENT_QUOTES) ?></td>
                <td><?= htmlspecialchars($empleado['telefono'] ?? '', ENT_QUOTES) ?></td>
                <td><?= htmlspecialchars($empleado['fecha_alta'] ?? '', ENT_QUOTES) ?></td>
                <td><?= htmlspecialchars($empleado['provincia'] ?? '', ENT_QUOTES) ?></td>
                <td><?= htmlspecialchars($empleado['sede'] ?? '', ENT_QUOTES) ?></td>
                <td><?= htmlspecialchars($empleado['departamento'] ?? '', ENT_QUOTES) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table><?php
}
