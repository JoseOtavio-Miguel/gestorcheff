<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidosModel extends Model
{
    protected $table = 'pedidos'; // Nome da tabela no banco
    protected $primaryKey = 'id'; // Chave primária

    protected $allowedFields = [
        'restaurante_id', // ID do restaurante que recebeu o pedido
        'cliente_nome',
        'cliente_telefone',
        'cliente_endereco',
        'valor_total',
        'status',         // Ex: aguardando, em preparo, enviado, finalizado, cancelado
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';

    protected $validationRules = [
        'restaurante_id'    => 'required|integer',
        'cliente_nome'      => 'required|max_length[255]',
        'cliente_telefone'  => 'required|max_length[20]',
        'cliente_endereco'  => 'required|max_length[255]',
        'valor_total'       => 'required|decimal',
        'status'            => 'required|in_list[aguardando,preparando,enviado,finalizado,cancelado]',
    ];

    protected $validationMessages = [
        'valor_total' => [
            'decimal' => 'O valor total precisa ser um número decimal válido.'
        ],
        'status' => [
            'in_list' => 'Status inválido.'
        ]
    ];

    protected $skipValidation = false;
}
