<?php

declare(strict_types=1);

function obtenerProvincias(): array
{
    return [
        'Madrid' => 'Madrid',
        'Barcelona' => 'Barcelona',
        'Valencia' => 'Valencia',
        'Sevilla' => 'Sevilla',
        'Bilbao' => 'Bilbao',
        'Zaragoza' => 'Zaragoza',
        'Alicante' => 'Alicante'
    ];
}

function obtenerSedes(): array
{
    return [
        'Central' => 'Central',
        'Oficina Norte' => 'Oficina Norte',
        'Plataforma Logística' => 'Plataforma Logística',
        'Servicio de Clientes' => 'Servicio de Clientes',
        'Centro de Innovación' => 'Centro de Innovación'
    ];
}

function obtenerDepartamentos(): array
{
    return [
        'Dirección' => 'Dirección',
        'Administración' => 'Administración',
        'Recursos Humanos' => 'Recursos Humanos',
        'I+D' => 'I+D',
        'Comercial' => 'Comercial',
        'Operaciones' => 'Operaciones'
    ];
}
