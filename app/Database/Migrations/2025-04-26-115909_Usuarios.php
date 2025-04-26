<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuarios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'nome'             => ['type' => 'VARCHAR', 'constraint' => 50],
            'sobrenome'        => ['type' => 'VARCHAR', 'constraint' => 50],
            'datanascimento'   => ['type' => 'DATE'],
            'email'            => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
            'cpf'              => ['type' => 'VARCHAR', 'constraint' => 14, 'unique' => true],
            'telefone'         => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'senha'            => ['type' => 'VARCHAR', 'constraint' => 255],
            'ativo'            => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'criado_em'        => ['type' => 'DATETIME', 'null' => true],
            'atualizado_em'    => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->createTable('usuarios');
    }

    public function down()
    {
        $this->forge->dropTable('usuarios');
    }
}
