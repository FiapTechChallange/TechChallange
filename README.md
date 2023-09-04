# Fiap - Tech Challenge - SOAT2 - Grupo 33

# DDD e Linguagem Ubíqua

Podem ser visualizados no miro através do link: https://miro.com/welcomeonboard/RVdjbENCVk1KZzZienFTa3BFd2RYajZCSEswcEVsejVGRTFTdDFJR3pmS0JUU3BQWmNqbWNzU3J4SmgzcjZEOHwzNDU4NzY0NTU2NTcwNzA5NzIyfDI=?share_link_id=963160921348


# Execução do projeto

## Portas necessárias e seus containers:

| Container      | Porta |
|----------------|-------|
| Web            | 8888  |
| DB             | 3307  |

Os dados para acesso a base de dados são:

    server: bd
    username: root
    senha: password

## Kubernetes
Iniciar cluster: <code>make start-kubernetes</code><br>
Criar base com seus respectivos volumes: <code>make create-db</code><br>
Encerrar cluster: <code>make delete-namespace</code>

Para sistemas windows o make deve ser instalado. O comando para instação através do chocolatey é: <code>choco install make</code>

# API

Você pode baixar um arquivo com as requisições já criadas(Fiap.postman_collection.json) na raiz do repositorio. 

A pasta "Fluxo" contém as requisições de forma a exibir todos os itens solicitados.

OBS: Esse arquivo foi feito utilizando o postman