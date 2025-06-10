<?php

namespace App\Controllers;

use App\Models\ItensCardapioModel;
use CodeIgniter\Controller;


class Cardapio extends BaseController
{
    /**
     * Exibe a lista de itens do cardápio de um restaurante específico.
     *
     * @param int $restauranteId ID do restaurante cujos itens serão exibidos.
     * @return \CodeIgniter\HTTP\ResponseInterface Retorna a view com os itens do cardápio.
     */
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

    /**
     * Exibe o painel do restaurante.
     *
     * @param int $restauranteId ID do restaurante.
     * @return \CodeIgniter\HTTP\ResponseInterface Retorna a view do painel do restaurante.
     */
    public function painel($restauranteId)
    {
        return view('restaurantes/painel-restaurante', [
            'restauranteId' => $restauranteId,
        ]);
    }


    /**
     * Exibe a página para cadastrar um novo item no cardápio do restaurante.
     *
     * @param int $restauranteId ID do restaurante ao qual o item pertence.
     * @return \CodeIgniter\HTTP\ResponseInterface Retorna a view de cadastro de cardápio.
     */
    public function novo($restauranteId)
    {
        return view('cardapio/cadastrar-cardapio', [
            'restauranteId' => $restauranteId,
        ]);
    }

    /**
     * Salva um novo item no cardápio do restaurante.
     *
     * @param int $restauranteId ID do restaurante ao qual o item pertence.
     * @return \CodeIgniter\HTTP\RedirectResponse Redireciona para a página principal ou outra página específica.
     */
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

        $imagem = $this->request->getFile('imagem');
        if ($imagem && $imagem->isValid() && !$imagem->hasMoved()) {
            $nomeImagem = $imagem->getRandomName();

            $uploadPath = FCPATH . 'uploads/cardapio/'; // pasta pública para acesso direto
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $caminhoFinal = $uploadPath . $nomeImagem;

            // Redimensiona e salva
            \Config\Services::image()
                ->withFile($imagem->getTempName())
                ->resize(400, 300, true, 'width')
                ->save($caminhoFinal);

            $data['imagem'] = 'uploads/cardapio/' . $nomeImagem;

        }

        $model->save($data);

        return redirect()->to('/'); // pode ser redirecionado para a página correta
    }


    /**
     * Exclui um item do cardápio.
     *
     * @param int $id ID do item a ser excluído.
     * @return \CodeIgniter\HTTP\RedirectResponse Redireciona de volta com mensagem de sucesso ou erro.
     */
    public function editar($id)
    {
        $model = new ItensCardapioModel();
        $item = $model->find($id);

        if (!$item) {
            return redirect()->to('/erro')->with('erro', 'Item não encontrado');
        }

        return view('cardapio/editar-cardapio', ['item' => $item]);
    }


    /**
     * Atualiza um item do cardápio.
     *
     * @param int $id ID do item a ser atualizado.
     * @return \CodeIgniter\HTTP\RedirectResponse Redireciona de volta com mensagem de sucesso ou erro.
     */
    public function atualizar($id)
    {
        // Verifica se o ID é válido
        $model = new ItensCardapioModel();

        // Busca o item atual no banco de dados
        if (!$id || !is_numeric($id)) {
            return redirect()->to('/erro')->with('erro', 'ID inválido');
        }
        $itemAtual = $model->find($id);
        if (!$itemAtual) {
            return redirect()->to('/erro')->with('erro', 'Item não encontrado');
        }

        // Coleta os dados do formulário
        $data = [
            'nome' => $this->request->getPost('nome'),
            'descricao' => $this->request->getPost('descricao'),
            'preco' => $this->request->getPost('preco'),
            'categoria' => $this->request->getPost('categoria'),
            'disponivel' => $this->request->getPost('disponivel'),
        ];
        
        // Verifica se o checkbox "remover_imagem" está marcado
        $removerImagem = $this->request->getPost('remover_imagem');

        // Verifica se uma nova imagem foi enviada
        $imagem = $this->request->getFile('imagem');

        $uploadPath = FCPATH . 'uploads/';

        // Criar pasta uploads se não existir
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        

        if ($removerImagem) {
            // Usuário quer remover a imagem atual
            if (!empty($itemAtual['imagem']) && file_exists($uploadPath . $itemAtual['imagem'])) {
                unlink($uploadPath . $itemAtual['imagem']);
            }
            $data['imagem'] = null; // Remove imagem do banco
        } elseif ($imagem && $imagem->isValid() && !$imagem->hasMoved()) {
            // Se enviou uma nova imagem, salva ela
            $nomeImagem = $imagem->getRandomName();
            $caminhoFinal = $uploadPath . $nomeImagem;

            \Config\Services::image()
                ->withFile($imagem->getTempName())
                ->resize(400, 300, true, 'width')
                ->save($caminhoFinal);

            $data['imagem'] = $nomeImagem;

            // Apaga a imagem antiga para não acumular arquivos
            if (!empty($itemAtual['imagem']) && file_exists($uploadPath . $itemAtual['imagem'])) {
                unlink($uploadPath . $itemAtual['imagem']);
            }
        } else {
            // Nenhuma nova imagem enviada e não pediu remoção, mantém a imagem atual
            $data['imagem'] = $itemAtual['imagem'];
        }


        // Atualiza o item no banco de dados com os novos dados
        $model->update($id, $data);

        // Verifica se ocorreram erros na atualização
        if ($model->errors()) {
            // Redireciona de volta para o formulário com os erros e os dados já preenchidos
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        // Redireciona para o painel do cardápio do restaurante após a atualização bem-sucedida
        return redirect()->to('/cardapio/painel/' . $itemAtual['restaurante_id']);
    }

}
