<?php

namespace App\Models;

use CodeIgniter\Model;

class RelatoriosRestaurantesModel extends Model
{
    protected $table = 'relatorios_restaurantes';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'restaurante_id',
        'total_pedidos',
        'receita_total',
        'avaliacao_media',
        'criado_em',
        'atualizado_em',
    ];

    protected $useTimestamps = true;


    public function getComRelatorio($id)
    {
        return $this->select('restaurantes.*, relatorios_restaurantes.total_pedidos, relatorios_restaurantes.receita_total, relatorios_restaurantes.avaliacao_media')
                    ->join('relatorios_restaurantes', 'relatorios_restaurantes.restaurante_id = restaurantes.id')
                    ->where('restaurantes.id', $id)
                    ->first();
    }

}
