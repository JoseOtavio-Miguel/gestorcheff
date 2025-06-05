<?php

namespace App\Controllers;

use App\Models\RelatoriosRestaurantesModel;
use CodeIgniter\Controller;


class Relatorios extends BaseController
{
    public function index()
    {
        $relatoriosModel = new RelatoriosRestaurantesModel();

        $dados = $relatoriosModel
            ->select('relatorios_restaurantes.*, restaurantes.nome AS nome_restaurante')
            ->join('restaurantes', 'restaurantes.id = relatorios_restaurantes.restaurante_id')
            ->findAll();

        return view('restaurantes/relatorio-restaurante', ['relatorios' => $dados]);
    }
}
