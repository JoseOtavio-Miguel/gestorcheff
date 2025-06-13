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

function getStatusIcon($status) {
    switch ($status) {
        case 'aguardando': return 'bi-clock';
        case 'preparando': return 'bi-egg-fried';
        case 'entregue': return 'bi-check-circle';
        case 'cancelado': return 'bi-x-circle';
        default: return 'bi-question-circle';
    }
}
?>

