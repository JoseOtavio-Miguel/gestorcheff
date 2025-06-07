<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEnderecosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'usuario_id'  => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'logradouro'  => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'numero'      => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'complemento' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'bairro'      => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'cidade'      => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'estado'      => [
                'type'       => 'CHAR',
                'constraint' => '2',
            ],
            'cep'         => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'pais'        => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'created_at'  => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at'  => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('usuario_id', 'usuarios', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('enderecos');
    }

    public function down()
    {
        $this->forge->dropTable('enderecos');
    }
}
