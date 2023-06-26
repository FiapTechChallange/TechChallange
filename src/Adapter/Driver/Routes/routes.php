<?php

namespace App\Adapter\Driver\Routes;

use App\Adapter\Driver\Api\Controllers\CardapioController;
use App\Adapter\Driver\Api\Controllers\ClientesController;
use App\Adapter\Driver\Api\Controllers\PedidoController;
use App\Adapter\Driver\Api\Controllers\PedidoItensController;
use App\Adapter\Driver\Api\Controllers\PreparoController;
use App\Core\Domain\Base\BaseController;

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$routes = [];

// Home - Exibe o cardápio
$routes['/'] = [
    'GET' => function ($params = null) {
        return BaseController::list(CardapioController::class);
    }
];

// Clientes
$routes['/clientes'] = [
    'POST' => function ($params = null) use ($data) {
        return BaseController::create(ClientesController::class, $data);
    },
    'GET' => function ($params = null) {
        return BaseController::list(ClientesController::class);
    }
];

$routes['/clientes/{id}'] = [
    'PUT' => function ($id) use ($data) {
        return BaseController::update(ClientesController::class, $id, $data);
    },
    'DELETE' => function ($id) {
        return BaseController::delete(ClientesController::class, $id);
    },
    'GET' => function ($id) {
        return BaseController::show(ClientesController::class, $id);
    }
];

// Pedidos
$routes['/pedido'] = [
    'POST' => function ($params = null) use ($data) {
        return BaseController::create(PedidoController::class, $data);
    },
    'GET' => function ($params = null) {
        return BaseController::list(PedidoController::class);
    }
];

$routes['/pedido/{id}'] = [
    'PUT' => function ($id) use ($data) {
        return BaseController::update(PedidoController::class, $id, $data);
    },
    'DELETE' => function ($id) {
        return BaseController::delete(PedidoController::class, $id);
    },
    'GET' => function ($id) {
        return BaseController::show(PedidoController::class, $id);
    }
];

$routes['/pedido-itens'] = [
    'POST' => function ($params = null) use ($data) {
        return BaseController::create(PedidoItensController::class, $data);
    },
    'GET' => function ($params = null) {
        return BaseController::list(PedidoItensController::class);
    }
];

$routes['/pedido-itens/{id}'] = [
    'PUT' => function ($id) use ($data) {
        return BaseController::update(PedidoItensController::class, $id, $data);
    },
    'DELETE' => function ($id) {
        return BaseController::delete(PedidoItensController::class, $id);
    },
    'GET' => function ($id) {
        return BaseController::show(PedidoItensController::class, $id);
    }
];

// Preparo
$routes['/preparo'] = [
    'POST' => function ($params = null) use ($data) {
        return BaseController::create(PreparoController::class, $data);
    },
    'GET' => function ($params = null) {
        return BaseController::list(PreparoController::class);
    }
];

$routes['/preparo/{id}'] = [
    'PUT' => function ($id) use ($data) {
        return BaseController::update(PreparoController::class, $id, $data);
    },
    'DELETE' => function ($id) {
        return BaseController::delete(PreparoController::class, $id);
    },
    'GET' => function ($id) {
        return BaseController::show(PreparoController::class, $id);
    }
];

// Cardapio
$routes['/cardapio'] = [
    'POST' => function ($params = null) use ($data) {
        return BaseController::create(CardapioController::class, $data);
    },
    'GET' => function ($params = null) {
        return BaseController::list(CardapioController::class);
    }
];

$routes['/cardapio/{id}'] = [
    'PUT' => function ($id) use ($data) {
        return BaseController::update(CardapioController::class, $id, $data);
    },
    'DELETE' => function ($id) {
        return BaseController::delete(CardapioController::class, $id);
    },
    'GET' => function ($id) {
        return BaseController::show(CardapioController::class, $id);
    }
];


return $routes;

