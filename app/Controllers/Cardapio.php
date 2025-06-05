<?php

namespace App\Controllers;

use App\Models\ItensCardapioModel;
use CodeIgniter\Controller;


class Cardapio extends BaseController
{

    public function index($restauranteId)
    {
        // Pega os itens do restaurante 
        $itensCardapioModel = new \App\Models\ItensCardapioModel();
        $itens = $itensCardapioModel->where('restaurante_id', $restauranteId)->findAll();

        return view('cardapio/index', [
            'restauranteId' => $restauranteId,
            'itens' => $itens
        ]);
    }


    public function painel($restauranteId)
    {
        return view('restaurantes/painel-restaurante', [
            'restauranteId' => $restauranteId,
        ]);
    }



    public function novo($restauranteId)
    {
        return view('cardapio/cadastrar-cardapio', [
            'restauranteId' => $restauranteId,
        ]);
    }

    public function salvar($restauranteId)
    {
        $model = new ItensCardapioModel();

        $data = [
            'restaurante_id' => $restauranteId,
            'nome' => $this->request->getPost('nome'),
            'descricao' => $this->request->getPost('descricao'),
            'preco' => $this->request->getPost('preco'),
            'categoria' => $this->request->getPost('categoria'),
            'disponivel' => $this->request->getPost('disponivel'),
        ];

        // Tratar as imagens enviadas para o item do cardápio

        $model->save($data);

        return redirect()->to('/');
    }


            
}