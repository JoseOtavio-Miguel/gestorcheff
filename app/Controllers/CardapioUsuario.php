<?php
namespace App\Controllers;
use App\Models\UsuariosModel; // correto!
use CodeIgniter\Controller; // ou BaseController, depende de onde herdou


class CardapioUsuario extends BaseController {

// CardapioUsuario.php (Controller)
        public function cardapio()
        {
            $model = new \App\Models\ItensCardapioModel();
            $dados['itens_cardapio'] = $model->where('disponivel', 'sim')->findAll();

            return view('usuarios/pedido-usuario', $dados);
        }

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
?>