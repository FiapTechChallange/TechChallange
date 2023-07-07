<?php

namespace App\Adapter\Driven\Infra\Repository;

use App\Core\Domain\Base\EnumStatus;
use App\Core\Domain\Entities\Preparo;
use App\Core\Domain\Repositories\IPreparoRepository;

class PreparoRepository implements IPreparoRepository
{

    protected Preparo $entity;

    public function __construct()
    {
        $this->entity = Preparo::model();
    }


    public function create(array $data): Preparo
    {
        $response = $this->entity->create($data);
        (new PedidoRepository())->update($data['id_pedido'], ['status' => EnumStatus::EM_PREPARACAO]);

        return $response;
    }

    public function update(int $id, array $data): Preparo
    {
        $response = $this->entity->update($id, $data);
        if(!empty($data['termino'])){
            (new PedidoRepository())->update($data['id_pedido'], ['status' => EnumStatus::PRONTO]);
        }
        return $response;
    }

    public function delete(int $id): Preparo
    {
        return $this->entity->delete($id);
    }

    public function show(int $id): Preparo
    {
        return $this->entity->show($id);
    }

    public function list(): Preparo
    {
        return $this->entity->list();
    }
}