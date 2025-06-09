<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRelatoriosRestaurantes extends Migration
{
    public function up()
    {
        $this->forge->addColumn('relatorios_restaurantes', [
            
            'nome_restaurante' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'pedidos_30dias' => [
                'type'       => 'INT',
                'default'    => 0,
            ],
            'receita_30dias' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
            ],
            'total_clientes' => [
                'type'       => 'INT',
                'default'    => 0,
            ],
            'produto_mais_vendido' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'categoria_mais_vendida' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('relatorios_restaurantes');
    }
}
