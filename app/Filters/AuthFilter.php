<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Se não estiver logado, redireciona para login
        if (!session()->get('logado')) {
            // Salva a URL atual para redirecionar após o login
            session()->set('redirect_url', current_url());
            return redirect()->to('/restaurantes/login')
                ->with('error', 'Você precisa estar logado para acessar esta página.');
        }
        
        // Verifica se a sessão ainda é válida
        $lastActivity = session()->get('last_activity');
        if ($lastActivity && (time() - $lastActivity > config('App')->sessionTimeToLive)) {
            return $this->logout();
        }
        
        // Atualiza o tempo da última atividade
        session()->set('last_activity', time());
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nada a fazer após a requisição
    }
    
    protected function logout()
    {
        // Destrói a sessão completamente
        session()->destroy();
        return redirect()->to('/restaurantes/login')
            ->with('error', 'Sua sessão expirou. Por favor, faça login novamente.');
    }
}