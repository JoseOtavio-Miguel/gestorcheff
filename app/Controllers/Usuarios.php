<?php

namespace App\Controllers;
use App\Models\UsuariosModel; // correto!
use CodeIgniter\Controller; // ou BaseController, depende de onde herdou

class Usuarios extends BaseController
{
    public function index()
    {
        echo view('');
    }

    // Página de Login do Usuario
    public function login()
    {
        return view('usuarios/login-usuario');
    }
    

    // Retorna a página para cadastro
    public function cadastro()
    {
        return view('usuarios/cadastro-usuario');
    }

    // Retorna a página com informações do usuário
    public function informacao()
    {
        // Exemplo: pegar id do usuário logado na sessão
        $usuarioId = session()->get('usuario_id');
        
        if (!$usuarioId) {
            return redirect()->to('/usuarios/login');
        }


        $usuarioModel = new UsuariosModel();
        $usuario = $usuarioModel->find($usuarioId);

        if (!$usuario) {
            // Se usuário não encontrado, trate o erro
            throw new \Exception('Usuário não encontrado');
        }

        // Passa o array $usuario para a view
        return view('usuarios/informacao-usuario', ['usuario' => $usuario]);
    }



    public function painelUsuario()
    {
        // Pega o ID do usuário da sessão
        $usuarioId = session()->get('usuario_id');

        // Verifica se o usuário está logado
        // Se não estiver logado, redireciona para a página de login
        if (!$usuarioId) {
            return redirect()->to('/usuarios/login');
        }


        $usuarioModel = new UsuariosModel(); // veja que no seu controller é UsuariosModel (plural)
        $usuario = $usuarioModel->find($usuarioId);

        if (!$usuario) {
            throw new \Exception('Usuário não encontrado');
        }

        return view('usuarios/painel-usuario', ['usuario' => $usuario]);
    }
        



    /* ------------  CRUD USUARIO  ------------ */

    // Cadastra o Usuário no Banco de Dados
    // Cadastra o Usuário no Banco de Dados
    public function cadastrar()
        {
        $usuarios = new UsuariosModel();

        // Pega os dados do formulário
        $data = [
            'nome'            => $this->request->getPost('nome'),
            'sobrenome'       => $this->request->getPost('sobrenome'),
            'email'           => $this->request->getPost('email'),
            'telefone'        => $this->request->getPost('telefone'),
            'cpf'             => $this->request->getPost('cpf'),
            'datanascimento'  => $this->request->getPost('datanascimento'),
            'senha'           => password_hash($this->request->getPost('senha'), PASSWORD_DEFAULT), // senha criptografada
        ];

        $usuarios->save($data);

        return redirect()->to('/usuarios/login')->with('success', 'Usuário cadastrado com sucesso! Faça o login.');
    }




    /* ------------  LOGIN/LOGOUT  ------------ */
    public function logar()
    {
        $session = session();
        $model = new UsuariosModel();

        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');

        // Verifica se existe o usuário
        $usuario = $model->where('email', $email)->first();

        if ($usuario) {
            // Confere a senha
            if (password_verify($senha, $usuario['senha'])) {
                $sessionData = [
                    'usuario_id' => $usuario['id'],
                    'nome' => $usuario['nome'],
                    'email' => $usuario['email'],
                    'logged_in' => true
                ];
                $session->set($sessionData);

                $session->set($sessionData);
                return redirect()->to(base_url('/usuarios/painelUsuario'))->with('success', 'Login realizado com sucesso!');
            } else {
                return redirect()->back()->with('error', 'Senha incorreta.');
            }
        } else {
            return redirect()->back()->with('error', 'E-mail não encontrado.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('usuarios/login'))->with('success', 'Você saiu com sucesso.');
    }
}
