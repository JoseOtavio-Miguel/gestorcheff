<?php

namespace App\Models;

use CodeIgniter\Model;

class EnderecoModel extends Model
{
    protected $table = 'enderecos'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'usuario_id',    // FK para usuário
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'pais',
        'created_at',
        'updated_at'
    ];

    // Se estiver usando timestamps automáticos
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validações básicas (exemplo)
    protected $validationRules = [
        'usuario_id' => 'required|integer',
        'logradouro' => 'required|string|max_length[255]',
        'numero' => 'required|string|max_length[20]',
        'bairro' => 'required|string|max_length[100]',
        'cidade' => 'required|string|max_length[100]',
        'estado' => 'required|string|max_length[2]',  // Ex: SP, RJ
        'cep' => 'required|string|max_length[20]',
        'pais' => 'required|string|max_length[100]'
    ];

    protected $validationMessages = [
        'usuario_id' => [
            'required' => 'O ID do usuário é obrigatório.',
            'integer' => 'O ID do usuário deve ser um número inteiro.'
        ],
        'logradouro' => [
            'required' => 'O logradouro é obrigatório.'
        ],
        // Mensagens podem ser adicionadas para outros campos conforme necessário
    ];

    protected $skipValidation = false;
}
