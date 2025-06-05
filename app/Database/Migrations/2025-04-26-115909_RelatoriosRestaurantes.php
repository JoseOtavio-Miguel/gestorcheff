<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RelatoriosRestaurantes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'restaurante_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'total_pedidos' => [
                'type'           => 'INT',
                'default'        => 0,
            ],
            'receita_total' => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'default'        => 0.00,
            ],
            'avaliacao_media' => [
                'type'           => 'DECIMAL',
                'constraint'     => '3,2',
                'default'        => 0.00,
            ],
            'criado_em' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'atualizado_em' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('restaurante_id', 'restaurantes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('relatorios_restaurantes');
    }

    public function down()
    {
        $this->forge->dropTable('relatorios_restaurantes');
    }
}
