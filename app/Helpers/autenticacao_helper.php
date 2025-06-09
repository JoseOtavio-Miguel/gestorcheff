<?php

function isRestauranteLogado(): bool
{
    return session()->get('restaurante_logado') === true;
}

function isUsuarioLogado(): bool
{
    return session()->get('usuario_logado') === true;
}
