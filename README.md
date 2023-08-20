# Fiap - Tech Challenge - SOAT2 - Grupo 33

# DDD e Linguagem Ubíqua

Podem ser visualizados no miro através do link: https://miro.com/welcomeonboard/RVdjbENCVk1KZzZienFTa3BFd2RYajZCSEswcEVsejVGRTFTdDFJR3pmS0JUU3BQWmNqbWNzU3J4SmgzcjZEOHwzNDU4NzY0NTU2NTcwNzA5NzIyfDI=?share_link_id=963160921348


# Execução do projeto

## Portas necessárias e seus containers:

| Container      | Porta |
|----------------|-------|
| Web            | 8888  |
| DB             | 3307  |
| PHPMyadmin     | 8080  |

Os dados para acesso a base de dados no PHPMyadmin são:

    server: bd
    username: root
    senha: password

Para criação dos container, execute o seguinte comando dentro do diretorio em que esta o arquivo 'docker-compose.yml' que esta na raiz do projeto:

    docker compose -f docker-compose.yml up -d


# API

Você pode baixar um arquivo com as requisições já criadas(Fiap.postman_collection_202307062235) na raiz do repositorio. 

A pasta "Fluxo" contém as requisições de forma a exibir todos os itens solicitados para fase 1 seguindo a respectiva ordem:

* Cadastro do Cliente 
* Identificação do Cliente via CPF
* Criar produto 
* Editar produto 
* remover produto
* Buscar produtos por categoria
* Fake checkout, apenas enviar os produtos escolhidos para a fila
* Listar os pedidos

OBS: Esse arquivo foi feito utilizando o postman

