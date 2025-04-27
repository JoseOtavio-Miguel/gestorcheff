<?php

namespace App\Models;

use CodeIgniter\Model;

class ItensCardapioModel extends Model
{
    protected $table = 'itens_cardapio';    // Nome da tabela no banco
    protected $primaryKey = 'id';            // Chave primária

    protected $allowedFields = [
        'restaurante_id', // Relaciona com o restaurante que criou o item
        'nome',
        'descricao',
        'preco',
        'categoria',
        'imagem',
        'disponivel',
    ];

    protected $useTimestamps = true;         // Usa 'created_at' e 'updated_at'
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';

    protected $validationRules = [
        'nome'        => 'required|min_length[3]|max_length[100]',
        'descricao'   => 'permit_empty|max_length[500]',
        'preco'       => 'required|decimal',
        'categoria'   => 'required|max_length[50]',
        'imagem'      => 'permit_empty|max_length[255]',
        'disponivel'  => 'required|in_list[sim,nao]',
    ];

    protected $validationMessages = [
        'nome' => [
            'required' => 'O nome do item é obrigatório.',
        ],
        'preco' => [
            'required' => 'O preço do item é obrigatório.',
            'decimal'  => 'O preço deve ser um número decimal válido.'
        ],
        'disponivel' => [
            'required' => 'Informe se o item está disponível.',
            'in_list'  => 'Disponível deve ser "sim" ou "não".'
        ],
    ];

    protected $skipValidation = false;       // Validação automática ativa
}
