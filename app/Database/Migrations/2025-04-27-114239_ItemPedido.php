<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ItemPedido extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'pedido_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'cardapio_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'quantidade' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'default'        => 1,
            ],
            'preco_unitario' => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'default'        => 0.00,
            ],
            'preco_total' => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'default'        => 0.00,
            ],
            'criado_em' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'atualizado_em' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('pedido_id', 'pedidos', 'id', 'CASCADE', 'CASCADE');      // <-- AQUI corrigido para 'pedidos'
        $this->forge->addForeignKey('cardapio_id', 'itens_cardapio', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('itens_pedido');
    }

    public function down()
    {
        $this->forge->dropTable('itens_pedido');
    }
}
