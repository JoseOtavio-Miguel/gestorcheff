<?php

namespace App\Models;

use CodeIgniter\Model;

class ItensPedidoModel extends Model
{
    protected $table = 'itens_pedido';           // Nome da tabela no banco
    protected $primaryKey = 'id';                // Chave primária

    protected $useAutoIncrement = true;

    protected $returnType = 'array';             // Pode ser 'object' se preferir
    protected $useSoftDeletes = false;           // Altere para true se quiser deletar "logicamente"

    protected $allowedFields = [                 // Campos permitidos para insert/update
        'pedido_id',
        'cardapio_id',
        'quantidade',
        'preco_unitario',
        'criado_em',
        'atualizado_em',
    ];

    // Timestamps automáticos
    protected $useTimestamps = true;
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';

    // Validação (opcional, adicione se quiser validar antes de salvar)
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
