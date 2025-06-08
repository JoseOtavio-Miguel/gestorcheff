<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pedido extends Migration
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
            'cliente_nome' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'cliente_telefone' => [
                'type'           => 'VARCHAR',
                'constraint'     => 20,
            ],
            'cliente_endereco' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'valor_total' => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'default'        => 0.00,
            ],
            'status' => [
                'type'           => 'ENUM',
                'constraint'     => ['aguardando', 'preparando', 'enviado', 'finalizado', 'cancelado'],
                'default'        => 'aguardando',
            ],
            'data' => [ //  novo campo: data do pedido
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'avaliacao' => [ //  novo campo: nota de 1 a 5
                'type'       => 'INT',
                'null'       => true,
            ],
            'avaliacao_detalhes' => [ //  novo campo: texto do cliente
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'criado_em' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'atualizado_em' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('pedidos');
    }

    public function down()
    {
        $this->forge->dropTable('pedidos');
    }
}
