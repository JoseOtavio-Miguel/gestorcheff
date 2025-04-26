<?php

namespace App\Models;
use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nome', 
        'sobrenome', 
        'datanascimento', 
        'email', 
        'cpf', 
        'telefone', 
        'senha', 
        'ativo'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'criado_em';
    protected $updatedField = 'atualizado_em';
}
