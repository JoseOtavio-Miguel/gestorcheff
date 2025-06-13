<?php

namespace App\Controllers;

use App\Models\RestaurantesModel;
use CodeIgniter\Controller;

class Restaurantes extends Controller
{
    protected $restaurantesModel;

    public function __construct()
    {
        $this->restaurantesModel = new RestaurantesModel(); // ← instanciando o model
    }
    
    public function cadastro()
    {
        return view('restaurantes/cadastro-restaurante');
    }


    public function cadastrar()
    {
        $restaurantes = new RestaurantesModel();
        

        // Pega os dados do formulário
        $data = [
            'nome'        => $this->request->getPost('nome'),
            'descricao'   => $this->request->getPost('descricao'),
            'cnpj'        => $this->request->getPost('cnpj'),
            'telefone'    => $this->request->getPost('telefone'),
            'email'       => $this->request->getPost('email'),
            'rua'         => $this->request->getPost('rua'),
            'cidade'      => $this->request->getPost('cidade'),
            'estado'      => strtoupper($this->request->getPost('estado')),
            'cep'         => $this->request->getPost('cep'),
            'status'      => $this->request->getPost('status') ?? 'ativo',
            'senha'       => password_hash($this->request->getPost('senha'), PASSWORD_DEFAULT), // <--- cuidado aqui, já falo disso abaixo
        ];

        if ($restaurantes->save($data)) {
            return redirect()->to('/restaurantes/cadastro')->with('success', 'Restaurante cadastrado com sucesso!');
        } else {
            return redirect()->to('/restaurantes/cadastro')->with('error', 'Erro ao cadastrar restaurante.');
        }
    }


    public function login()
    {
        if (session()->get('logado')) {
            return redirect()->to('/painel');
        }

        return view('restaurantes/login-restaurante');
    }


    public function logout()
    {
        // Registra o logout (opcional, para auditoria)
        $this->registrarLog('logout', session()->get('restaurante_id'));
        
        // Destrói a sessão completamente
        session()->destroy();
        
        return redirect()->to('/restaurantes/login')
            ->with('success', 'Você saiu do sistema com sucesso.');
    }

    public function painel()
    {
        if (!session()->get('logado')) {
            return redirect()->to('/login'); // Protege o acesso
        }
        return view('restaurantes/painel-restaurante', [  
            'restauranteId' => session()->get('restaurante_id'),
            'restauranteNome' => session()->get('restaurante_nome')
        ]);
    }   

    
    // No método home (login), adicione verificação de CSRF
    public function home()
    {

        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');
        
        $restauranteModel = new RestaurantesModel();
        $restaurante = $restauranteModel->where('email', $email)->first();
        
        if ($restaurante) {
            // Verifica se a conta está ativa
            if ($restaurante['status'] !== 'ativo') {
                return redirect()->back()->with('error', 'Sua conta está desativada.');
            }
            
            if (password_verify($senha, $restaurante['senha'])) {
                // Regenera o ID da sessão para prevenir fixation
                session()->regenerate();
                
                session()->set([
                    'restaurante_id' => $restaurante['id'],
                    'restaurante_nome' => $restaurante['nome'],
                    'logado' => true,
                    'last_activity' => time(),
                    'ip_address' => $this->request->getIPAddress(),
                    'user_agent' => $this->request->getUserAgent()
                ]);
                
                // Redireciona para a URL salva ou para o painel
                return redirect()->to(session()->get('redirect_url') ?? '/painel');
            }
        }
        
        // Delay para prevenir brute force
        sleep(2);
        return redirect()->back()->with('error', 'E-mail ou senha incorretos.');
    }

    // Método para registrar atividades (opcional)
    protected function registrarLog($acao, $restauranteId)
    {
        $logModel = new \App\Models\LogModel();
        $logModel->save([
            'restaurante_id' => $restauranteId,
            'acao' => $acao,
            'ip' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString(),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    

    /**
    * Exibe o formulário de edição de um restaurante.
    */
    public function editar($id)
        {
            $restaurante = $this->restaurantesModel->find($id);

            if (!$restaurante) {
                return redirect()->to(base_url('restaurantes'))->with('error', 'Restaurante não encontrado.');
            }

            return view('restaurantes/editar-restaurante', [
                'restaurante' => $restaurante
            ]);
        }

    /**
    * Processa os dados e atualiza o restaurante.
    */

    
    public function atualizar($id)
    {
        $restaurante = $this->restaurantesModel->find($id);

        if (!$restaurante) {
            return redirect()->to(base_url('restaurantes'))->with('error', 'Restaurante não encontrado.');
        }

        $dados = $this->request->getPost();

        // Se quiser permitir alteração de senha, deve fazer verificação e hash aqui.
        unset($dados['senha']); // Proteção, caso não queira alterar a senha diretamente.

        $this->restaurantesModel->update($id, $dados);

        return redirect()->to(base_url('restaurantes'))->with('success', 'Dados do restaurante atualizados com sucesso!');
    }
}