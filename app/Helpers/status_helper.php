<?php

if (!function_exists('getStatusBadgeClass')) {
    function getStatusBadgeClass(string $status): string
    {
        return match ($status) {
            'aguardando' => 'bg-secondary',
            'preparando' => 'bg-warning text-dark',
            'enviado'    => 'bg-info text-dark',
            'finalizado' => 'bg-success',
            'cancelado'  => 'bg-danger',
            default      => 'bg-light text-dark',
        };
    }
}
