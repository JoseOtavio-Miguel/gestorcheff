<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCamposExtrasToPedidos extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pedidos', [
            'usuario_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
                'after'    => 'id', // ou onde quiser posicionar
            ],
            'data' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'status',
            ],
            'avaliacao' => [
                'type' => 'INT',
                'null' => true,
                'after' => 'data',
            ],
            'avaliacao_detalhes' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'avaliacao',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pedidos', ['usuario_id', 'data', 'avaliacao', 'avaliacao_detalhes']);
    }
}
