<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ItensCardapio extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'restaurante_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
            ],
            'nome' => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'descricao' => [
                'type'              => 'VARCHAR',
                'constraint'        => 500,
                'null'              => true,
            ],
            'preco' => [
                'type'              => 'DECIMAL',
                'constraint'        => '10,2',
            ],
            'categoria' => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
            ],
            'imagem' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
                'null'              => true,
            ],
            'disponivel' => [
                'type'              => 'ENUM',
                'constraint'        => ['sim', 'nao'],
                'default'           => 'sim',
            ],
            'criado_em' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'atualizado_em' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        // Opcional: FK de restaurante_id para restaurantes
        // $this->forge->addForeignKey('restaurante_id', 'restaurantes', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('itens_cardapio');
    }

    public function down()
    {
        $this->forge->dropTable('itens_cardapio');
    }
}
