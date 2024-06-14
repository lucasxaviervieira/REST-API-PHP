# projects-visualizer-backend

Rest API feita com PHP e PostgreSQL, utilizando o Xampp como Servidor Web.

Este projeto visa usar o minimo bibliotecas e frameworks, com foco no aprendizado.

## Instalação e Configuração

- Com o PostgreSQL instalado, inicie o PGAdmin
- Com o Xampp instalado, para criar ou acessar o banco de dados no PostgreSQL, abra no navegador essa url --> [start-db]
- Finalizado os passos, a utilização da API deve estar funcionado.

## Documentação da API

#### Authentication and Authorization

```http
  POST /api/routes/auth.php
```

| Parâmetro  | Tipo     |
| :--------- | :------- |
| `username` | `string` |
| `password` | `string` |

#### Retorna todos os itens

```http
  GET /api/routes/tasks.php
```

| Parâmetro      | Tipo     | Descrição                           |
| :------------- | :------- | :---------------------------------- |
| `Bearer Token` | `string` | **Obrigatório**. A chave da sua API |

#### Retorna um item

```http
  GET /api/routes/tasks.php?id=${id}
```

| Parâmetro      | Tipo     | Descrição                           |
| :------------- | :------- | :---------------------------------- |
| `Bearer Token` | `string` | **Obrigatório**. A chave da sua API |

#### Cria um item

```http
  POST /api/routes/tasks.php
```

| Parâmetro      | Tipo     | Descrição                              |
| :------------- | :------- | :------------------------------------- |
| `bodyJson`     | `object` | **Obrigatório**. O objeto a ser criado |
| `Bearer Token` | `string` | **Obrigatório**. A chave da sua API    |

#### Edita um item

```http
  PUT /api/routes/tasks.php
```

| Parâmetro      | Tipo     | Descrição                               |
| :------------- | :------- | :-------------------------------------- |
| `bodyJson`     | `object` | **Obrigatório**. O objeto a ser editado |
| `Bearer Token` | `string` | **Obrigatório**. A chave da sua API     |

#### Deleta um item

```http
  PUT /api/routes/tasks.php?id=${id}
```

| Parâmetro      | Tipo     | Descrição                           |
| :------------- | :------- | :---------------------------------- |
| `Bearer Token` | `string` | **Obrigatório**. A chave da sua API |

[start-db]: http://localhost/db/main.php
