<?php

namespace App\gateways;

use App\api\DBGateway;
use App\entities\Cardapio;
use App\interfaces\ICardapioGateway;
use MongoDB\BSON\ObjectId;


class CardapioGateway extends DBGateway implements ICardapioGateway
{

    protected Cardapio $entity;
    protected String $namespace = 'cardapio';
    protected string $pKey = 'oid';
    protected array $fields = [
        'oid',
        'nome',
        'descricao',
        'categoria',
        'valor'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->entity = new Cardapio();
    }


    public function create(array $data): Cardapio
    {
        return $this->entity->fill($this->repository->create($data));
    }

    public function update(string $id, array $data): Cardapio
    {
        return $this->entity->fill($this->repository->update($id, $data));
    }

    public function delete(string $id): Cardapio
    {
        return $this->entity->fill($this->repository->delete($id));
    }

    public function show(string $id): Cardapio
    {
        return $this->entity->fill($this->repository->show($id));
    }

    public function list(): array
    {
        $response = [];
        foreach($this->repository->list() as $row){
            $response[] = (new Cardapio())->fill($row);
        }

        return $response;
    }

    public function listByCategoria(string $categoria):array
    {
        return $this->mongoRepository->query(['categoria' => ['$eq' => strtoupper($categoria)]]);
    }

    public function listByIdItems(array $idItems): array
    {
        $data = $this->redisRepository->listByIdItems($idItems);

        if(empty($data)){
            foreach($idItems as $idItem){
                $item = $this->mongoRepository->query(['_id' => new ObjectId($idItem)]);
                $this->redisRepository->create($item);
                $data[] = $item;
            }
        }
        return $data;
    }
}