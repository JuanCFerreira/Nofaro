# Teste Nofaro

Um teste técnico desenvolvido em Laravel 

## Features

- A criação de uma rota que encontra um hash, de certo formato, para uma certa string fornecida como input.
- A criação de um comando que consulta a rota criada e armazena os resultados na base de dados.
- Criação de rota que retorne os resultados que foram gravados.


Para o desenvolvimento dessa solução foram usadas basicamente as técnologias Laravel e SQLite


## Instalação

Instale as dependências e inicie o servidor

```sh
composer install
php artisan migrate
php artisan serve
```

## Rotas

A aplicação possui apenas 2 rotas GET, sendo elas:

- /generate-hash/{value}
- /get-hashes/{maxAttempts?}

Onde '{values}' seria a string a ser criptografada
e '{maxAttempts?}' um filtro opcional para a listagem

## Commands

A aplicação possui apenas 1 comando que consiste em fazer diversas requisições a '/generate-hash/{value}' utilizando o hash gerado como valor a próxima requisição.

No contexto da aplicação aqui está um exemplo de uso:

```sh
php artisan nofaro:test foobar --requests=10
```

Onde o primeiro parâmetro trata-se da string a ser criptografada na primeira requisição

E a option '--requests' trata-se da quantidade de requisições a serem feitas, ela possui um valor padrão de 1.

