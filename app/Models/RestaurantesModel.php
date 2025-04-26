<?php

namespace App\Models;

use CodeIgniter\Model;

class RestaurantesModel extends Model
{
    protected $table = 'restaurantes';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nome',
        'descricao',
        'cnpj',
        'telefone',
        'email',
        'rua',
        'cidade',
        'estado',
        'cep',
        'status',
        'senha' // novo campo senha
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';

    protected $validationRules = [
        'nome'      => 'required|min_length[3]|max_length[100]',
        'cnpj'      => 'required|min_length[14]|max_length[18]|is_unique[restaurantes.cnpj]',
        'telefone'  => 'required|min_length[10]|max_length[20]',
        'email'     => 'required|valid_email|max_length[100]',
        'rua'       => 'required|max_length[255]',
        'cidade'    => 'required|max_length[100]',
        'estado'    => 'required|exact_length[2]',
        'cep'       => 'required|max_length[10]',
        'status'    => 'permit_empty|in_list[ativo,inativo]',
        'senha'     => 'required|min_length[8]'
    ];

    protected $validationMessages = [
        'cnpj' => [
            'is_unique' => 'Este CNPJ já está cadastrado.'
        ],
        'email' => [
            'valid_email' => 'Por favor, insira um e-mail válido.'
        ],
        'estado' => [
            'exact_length' => 'O estado deve conter exatamente 2 caracteres.'
        ],
        'senha' => [
            'required' => 'A senha é obrigatória.',
            'min_length' => 'A senha deve ter no mínimo 8 caracteres.'
        ]
    ];

    protected $skipValidation = false;
}
