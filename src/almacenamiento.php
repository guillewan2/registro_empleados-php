<?php

declare(strict_types=1);

function rutaDatos(): string
{
    return __DIR__ . '/../data/datos.json';
}

function leerEmpleados(): array
{
    $ruta = rutaDatos();

    if (!file_exists($ruta)) {
        return [];
    }

    $contenido = file_get_contents($ruta);

    if ($contenido === false || trim($contenido) === '') {
        return [];
    }

    try {
        return json_decode($contenido, true, 512, JSON_THROW_ON_ERROR);
    } catch (\JsonException) {
        return [];
    }
}

function guardarEmpleados(array $registros): void
{
    $ruta = rutaDatos();
    file_put_contents($ruta, json_encode($registros, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
