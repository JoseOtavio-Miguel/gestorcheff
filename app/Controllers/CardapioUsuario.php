<?php
namespace App\Controllers;
use App\Models\UsuariosModel; // correto!
use App\Models\EnderecoModel;
use App\Models\ItensCardapioModel;
use CodeIgniter\Controller; // ou BaseController, depende de onde herdou


class CardapioUsuario extends BaseController {

    // CardapioUsuario.php (Controller)
    public function cardapio()
    {
        // Verifica login e redireciona se não estiver logado
        if (!session()->has('usuario_id')) {
            return redirect()->to('/login')
                ->with('erro', 'Você precisa estar logado para acessar o cardápio');
        }

        $itensModel = new ItensCardapioModel();
        $enderecoModel = new EnderecoModel();
        
        $dados = [
            'itens_cardapio' => $itensModel->where('disponivel', 'sim')->findAll(),
            'enderecos' => $enderecoModel
                ->where('usuario_id', session()->get('usuario_id'))
                ->orderBy('id', 'ASC')
                ->findAll(),
            'usuario_logado' => session()->get('usuario_id') // Para verificação fácil no front
        ];

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