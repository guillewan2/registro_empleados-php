<?php

declare(strict_types=1);

function limpiarTexto(string $valor): string
{
    return trim($valor);
}

function normalizarDni(string $dni): string
{
    return strtoupper(preg_replace('/[^0-9A-Za-z]/', '', $dni));
}

function validarTexto(string $valor): bool
{
    return $valor !== '';
}

function validarDni(string $dni): bool
{
    if (!preg_match('/^\d{8}[A-Z]$/', $dni)) {
        return false;
    }

    $tabla = 'TRWAGMYFPDXBNJZSQVHLCKE';
    $numero = (int) substr($dni, 0, 8);
    $letra = substr($dni, -1);

    return $tabla[$numero % 23] === $letra;
}

function validarEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validarTelefono(string $telefono): bool
{
    $soloDigitos = preg_replace('/\D+/', '', $telefono);

    return $soloDigitos !== '' && strlen($soloDigitos) >= 9 && strlen($soloDigitos) <= 15;
}

function validarFecha(string $fecha): bool
{
    $formato = DateTime::createFromFormat('Y-m-d', $fecha);

    return $formato !== false && $formato->format('Y-m-d') === $fecha;
}

function validarSeleccion(string $valor, array $opciones): bool
{
    return $valor !== '' && array_key_exists($valor, $opciones);
}
