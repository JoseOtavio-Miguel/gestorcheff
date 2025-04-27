<?php

namespace App\Controllers;

use App\Models\ItensCardapioModel;
use CodeIgniter\Controller;


class Cardapio extends BaseController
{

    public function index($restauranteId)
    {
        // Pega os itens do restaurante (se quiser listar eles já)
        $itensCardapioModel = new \App\Models\ItensCardapioModel();
        $itens = $itensCardapioModel->where('restaurante_id', $restauranteId)->findAll();

        return view('cardapio/index', [
            'restauranteId' => $restauranteId,
            'itens' => $itens
        ]);
    }



    public function novo($restauranteId)
    {
        return view('cardapio/cadastrar-cardapio', [
            'restauranteId' => $restauranteId
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

        // Aqui você pode tratar upload de imagem também

        $model->save($data);

        return redirect()->to('/');
    }


            
}