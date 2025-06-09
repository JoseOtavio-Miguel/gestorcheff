<?php

namespace App\Models;

use CodeIgniter\Model;

class RelatoriosRestaurantesModel extends Model
{
    protected $table = 'relatorios_restaurantes';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'restaurante_id',
        'nome_restaurante',
        'total_pedidos',
        'pedidos_30dias',
        'receita_total',
        'receita_30dias',
        'avaliacao_media',
        'total_clientes',
        'produto_mais_vendido',
        'categoria_mais_vendida',
        'criado_em',
        'atualizado_em',
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'criado_em';
    protected $updatedField = 'atualizado_em';

    /**
     * Obtém relatório completo de um restaurante
     */
    public function getRelatorioCompleto($restaurante_id)
    {
        return $this->where('restaurante_id', $restaurante_id)
                   ->orderBy('atualizado_em', 'DESC')
                   ->first();
    }

    /**
     * Obtém os top 10 restaurantes por receita
     */
    public function getTopRestaurantes($limit = 10)
    {
        return $this->select('nome_restaurante, receita_total, avaliacao_media, total_pedidos')
                   ->orderBy('receita_total', 'DESC')
                   ->limit($limit)
                   ->findAll();
    }

    /**
     * Atualiza ou cria relatório para um restaurante
     */
    public function atualizarRelatorio($restaurante_id, $data)
    {
        $existe = $this->where('restaurante_id', $restaurante_id)->first();
        
        if ($existe) {
            return $this->update($existe['id'], $data);
        }
        
        $data['restaurante_id'] = $restaurante_id;
        return $this->insert($data);
    }

    /**
     * Obtém estatísticas gerais
     */
    public function getEstatisticasGerais()
    {
        return $this->select('SUM(total_pedidos) as total_pedidos, 
                            SUM(receita_total) as receita_total, 
                            AVG(avaliacao_media) as avaliacao_media')
                   ->first();
    }
}