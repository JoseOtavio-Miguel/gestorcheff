<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Restaurantes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nome' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'descricao' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'cnpj' => [
                'type'       => 'VARCHAR',
                'constraint' => '18',
                'unique'     => true,
            ],
            'telefone' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'rua' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'cidade' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'estado' => [
                'type'       => 'CHAR',
                'constraint' => '2',
            ],
            'cep' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'senha' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['ativo', 'inativo'],
                'default'    => 'ativo',
            ],
            'criado_em' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'atualizado_em' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id', true); // Chave primária
        $this->forge->createTable('restaurantes');
    }

    public function down()
    {
        $this->forge->dropTable('restaurantes');
    }
}
