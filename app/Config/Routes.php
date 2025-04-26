<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 /* ----------- Bloco Home ------------ */

// Página Home 
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');

 /* ----------------------------------- */


  /* ----------- Bloco Restaurante ------------ */

// Página para Cadastro de Restaurante
$routes->get('/restaurantes/cadastro', 'Restaurantes::cadastro');

// Cadastrar Restaurante
$routes->post('restaurantes/cadastrar', 'Restaurantes::cadastrar');

// Página de login do restaurante
$routes->get('restaurantes/login-restaurante', 'Restaurantes::login');

// Logar restaurante
$routes->post('restaurantes/logar', 'Restaurantes::logar');

/* ---------------------------------------- */



/* ----------- Bloco Usuário -------------- */

// Página para Registro do Usuario 
$routes->get('usuarios/cadastro', 'Usuarios::cadastro');

// Página para Login do Usuário 
$routes->get('usuarios/login', 'Usuarios::login');

// Criar Usuarios
$routes->post('usuarios/cadastrar', 'Usuarios::cadastrar');

// Logar na Conta
$routes->post('usuarios/logar', 'Usuarios::logar');

//Deslogar da Conta
$routes->get('usuarios/logout', 'Usuarios::logout');

// Informações do Usuário 
$routes->get('/usuarios/informacao', 'Usuarios::info');

/* ---------------------------------------- */





