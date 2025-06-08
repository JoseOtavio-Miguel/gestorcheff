<?php
namespace App\Controllers;
use App\Models\ItensCardapioModel;
use App\Models\UsuariosModel; 
use App\Models\ItensPedidoModel;
use App\Models\EnderecoModel;
use App\Models\PedidosModel;
use CodeIgniter\Controller; 



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
            'pedidos' => $pedidos
        ]);
    }



    public function detalhes($pedidoId)
    {
        $pedidoModel = new PedidosModel();
        $itensPedidoModel = new \App\Models\ItensPedidoModel();
        
        $pedido = $pedidoModel->find($pedidoId);
        if (!$pedido) {
            return redirect()->back()->with('error', 'Pedido não encontrado');
        }

        // Verifica se o pedido pertence ao usuário logado
        if ($pedido['usuario_id'] != session()->get('usuario_id')) {
            return redirect()->back()->with('error', 'Acesso não autorizado');
        }

        $itens = $itensPedidoModel->select('itens_pedido.*, itens_cardapio.nome as item_nome')
                ->join('itens_cardapio', 'itens_cardapio.id = itens_pedido.cardapio_id')
                ->where('pedido_id', $pedidoId)
                ->findAll();

        return view('usuarios/detalhes-pedido', [
            'pedido' => $pedido,
            'itens' => $itens
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

}

?>