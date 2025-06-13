<?php
namespace App\Controllers;
use App\Models\ItensCardapioModel;
use App\Models\UsuariosModel; 
use App\Models\ItensPedidoModel;
use App\Models\EnderecoModel;
use App\Models\PedidosModel;
use CodeIgniter\Controller; 

helper('pedidos');
helper('status'); // Carrega seu helper com as funções

    helper('pedidos');
    helper('status'); // Carrega seu helper com as funções

    class Pedidos extends BaseController {
        

        /**
         * Página de pedidos do restaurante
         * 
         * @param int $restauranteId
         * @return \CodeIgniter\HTTP\ResponseInterface
         */
        public function index($restauranteId)
        {
            $pedidosModel = new \App\Models\PedidosModel();

            $pedidos = $pedidosModel->where('restaurante_id', $restauranteId)->orderBy('criado_em', 'DESC')->findAll();

            return view('restaurantes/pedidos-restaurante', [
                'pedidos' => $pedidos
            ]);
        }


    public function salvar()
    {
        $pedidoModel   = new \App\Models\PedidosModel();
        $itemModel     = new \App\Models\ItensCardapioModel();
        $usuarioModel  = new \App\Models\UsuariosModel();
        $enderecoModel = new \App\Models\EnderecoModel();

        $itensJson  = $this->request->getPost('itens');
        $enderecoId = $this->request->getPost('endereco_id');

        if (empty($itensJson)) {
            return redirect()->back()->with('error', 'Carrinho está vazio.');
        }

        $itens = json_decode($itensJson, true);
        if (empty($itens) || !is_array($itens)) {
            return redirect()->back()->with('error', 'Itens inválidos.');
        }

        // Pega o usuário logado
        $usuarioId = session()->get('usuario_id');
        if (!$usuarioId) {
            return redirect()->back()->with('error', 'Usuário não autenticado.');
        }

        $usuario = $usuarioModel->find($usuarioId);
        if (!$usuario) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }

        // Pega endereço
        $endereco = $enderecoModel->find($enderecoId);
        if (!$endereco) {
            return redirect()->back()->with('error', 'Endereço inválido.');
        }

        // Calcula o valor total
        $valorTotal = 0;
        foreach ($itens as $item) {
            $cardapio = $itemModel->find($item['id']);
            if (!$cardapio) continue;

            $valorTotal += $cardapio['preco'] * $item['quantidade'];

            $restauranteId = $cardapio['restaurante_id'];
        }

        if ($valorTotal <= 0) {
            return redirect()->back()->with('error', 'Erro ao calcular o valor total.');
        }

        // Prepara os dados para salvar o pedido
        $pedidoData = [
            'restaurante_id'      => $restauranteId, // ou dinâmico se você tiver isso no contexto
            'usuario_id'          => $usuarioId,
            'cliente_nome'        => $usuario['nome'] . ' ' . $usuario['sobrenome'],
            'cliente_telefone'    => $usuario['telefone'] ?? '',
            'cliente_endereco'    => $endereco['logradouro'] . ', ' . $endereco['numero'] . ' - ' . $endereco['bairro'] . ', ' . $endereco['cidade'] . '/' . $endereco['estado'],
            'valor_total'         => $valorTotal,
            'status'              => 'aguardando',
            'criado_em'           => date('Y-m-d H:i:s'),
            'atualizado_em'       => date('Y-m-d H:i:s'),
        ];

        if (!$pedidoModel->save($pedidoData)) {
            return redirect()->back()->with('error', 'Erro ao salvar o pedido.');
        }

        $pedidoId = $pedidoModel->getInsertID(); // pega o ID do pedido recém-salvo
        $itensPedidoModel = new \App\Models\ItensPedidoModel();

        foreach ($itens as $item) {
            $cardapio = $itemModel->find($item['id']);
            if (!$cardapio) continue;

            $itensPedidoModel->save([
                'pedido_id'      => $pedidoId,
                'cardapio_id'    => $cardapio['id'],
                'quantidade'     => $item['quantidade'],
                'preco_unitario' => $cardapio['preco'],
                'preco_total'    => $cardapio['preco'] * $item['quantidade']
            ]);
        }


        return redirect()->to('usuarios/painelUsuario')->with('success', 'Pedido criado com sucesso!');
    }


        /**
         * Rastrear pedidos do usuário
         */
        public function rastrear()
        {
            
            $pedidoModel = new PedidosModel();
            $restauranteModel = new \App\Models\RestaurantesModel(); // Adicione este model
            
            $usuarioId = session()->get('usuario_id');
            if (!$usuarioId) {
                return redirect()->to('/login')->with('error', 'Você precisa estar logado');
            }

            // Busca pedidos com informações do restaurante
            $pedidos = $pedidoModel->select('pedidos.*, restaurantes.nome as restaurante_nome')
                        ->join('restaurantes', 'restaurantes.id = pedidos.restaurante_id')
                        ->where('pedidos.usuario_id', $usuarioId)
                        ->orderBy('pedidos.criado_em', 'DESC')
                        ->findAll();

            return view('usuarios/rastreio-pedidos', [
                'pedidos' => $pedidos,
                'getStatusIcon' => [$this, 'getStatusIcon'], // Referência ao método
                'getStatusBadgeClass' => [$this, 'getStatusBadgeClass'],
            ]);
        }


        public function detalhes($pedidoId)
        {
            $db = \Config\Database::connect();
            $pedidoModel = new \App\Models\PedidosModel();

            // Busca o pedido
            $pedido = $pedidoModel->find($pedidoId);
            if (!$pedido) {
                return redirect()->back()->with('error', 'Pedido não encontrado');
            }

            // Verifica se pertence ao usuário logado
            if ($pedido['usuario_id'] != session()->get('usuario_id')) {
                return redirect()->back()->with('error', 'Acesso não autorizado');
            }

            // Query SQL nativa
            $query = "
                SELECT itens_pedido.*, itens_cardapio.nome AS item_nome
                FROM itens_pedido
                JOIN itens_cardapio ON itens_cardapio.id = itens_pedido.cardapio_id
                WHERE itens_pedido.pedido_id = ?
            ";
            $itens = $db->query($query, [$pedidoId])->getResultArray();

            return view('usuarios/detalhes-pedido', [
                'pedido' => $pedido,
                'itens'  => $itens
            ]);
        }



        public function cancelar()
        {
            if (!$this->request->isAJAX()) {
                return $this->response->setStatusCode(405)->setJSON([
                    'success' => false,
                    'message' => 'Método não permitido'
                ]);
            }

            $pedidoId = $this->request->getPost('pedido_id');
            if (!$pedidoId) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'ID do pedido não informado'
                ]);
            }

            $pedidoModel = new PedidosModel();
            $pedido = $pedidoModel->find($pedidoId);
            
            if (!$pedido) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Pedido não encontrado'
                ]);
            }

            // Verifica se o pedido pertence ao usuário logado
            if ($pedido['usuario_id'] != session()->get('usuario_id')) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Acesso não autorizado'
                ]);
            }

            // Verifica se o pedido pode ser cancelado
            if (!in_array($pedido['status'], ['aguardando', 'preparando'])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Este pedido não pode mais ser cancelado'
                ]);
            }

            // Atualiza o status
            if ($pedidoModel->update($pedidoId, ['status' => 'cancelado'])) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Pedido cancelado com sucesso'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Erro ao cancelar pedido'
                ]);
            }
        }


        // Adicione este método ao seu controller Pedidos
        public function avaliar($pedidoId)
        {
            // Verifica se é uma requisição AJAX
            if (!$this->request->isAJAX()) {
                return $this->response->setStatusCode(405)->setJSON([
                    'success' => false,
                    'message' => 'Método não permitido'
                ]);
            }

            // Valida o token CSRF
            if (!$this->request->getPost('csrf_test_name') || 
                !hash_equals($this->request->getPost('csrf_test_name'), session()->get('csrf_test_name'))) {
                return $this->response->setStatusCode(403)->setJSON([
                    'success' => false,
                    'message' => 'Token CSRF inválido'
                ]);
            }

            $pedidoModel = new PedidosModel();
            $pedido = $pedidoModel->find($pedidoId);

            // Verifica se o pedido pertence ao usuário e está finalizado
            if (!$pedido || $pedido['usuario_id'] != session()->get('usuario_id') || $pedido['status'] != 'finalizado') {
                return $this->response->setStatusCode(403)->setJSON([
                    'success' => false,
                    'message' => 'Pedido não disponível para avaliação'
                ]);
            }

            // Valida os dados
            $validation = \Config\Services::validation();
            $validation->setRules([
                'avaliacao' => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[5]',
                'comentario' => 'permit_empty|max_length[500]'
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'errors' => $validation->getErrors()
                ]);
            }

            // Processa a avaliação
            $avaliacao = $this->request->getPost('avaliacao');
            $comentario = $this->request->getPost('comentario');

            if ($pedidoModel->avaliarPedido($pedidoId, $avaliacao, $comentario)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Avaliação registrada com sucesso!'
                ]);
            }

            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Erro ao registrar avaliação'
            ]);
        }   

        // Métodos protegidos para status
        protected function getStatusIcon($status) {
            switch (strtolower($status)) {
                case 'aguardando': return 'bi-clock';
                case 'preparando': return 'bi-egg-fried';
                case 'enviado':
                case 'entregue': return 'bi-check-circle';
                case 'cancelado': return 'bi-x-circle';
                default: return 'bi-question-circle';
            }
        }

        protected function getStatusBadgeClass($status) {
            switch (strtolower($status)) {
                case 'aguardando': return 'badge-aguardando';
                case 'preparando': return 'badge-preparando';
                case 'enviado':
                case 'entregue': return 'badge-entregue';
                case 'cancelado': return 'badge-cancelado';
                default: return 'badge-secondary';
            }
        }
    }
    ?>