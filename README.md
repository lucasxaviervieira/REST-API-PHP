# projects-visualizer-backend

Rest API feita com PHP e PostgreSQL, utilizando o Xampp como Servidor Web.

Este projeto visa usar o minimo bibliotecas e frameworks, com foco no aprendizado.

## Instalação e Configuração

- Com o PostgreSQL instalado, inicie o PGAdmin
- Com o Xampp instalado, abra no navegador essa url --> http://localhost/db/schemas/main.php
- Após isso, troque a chave secreta da API.

## Documentação da API

#### Retorna todos os itens

```http
  GET /api/items
```

| Parâmetro | Tipo     | Descrição                           |
| :-------- | :------- | :---------------------------------- |
| `api_key` | `string` | **Obrigatório**. A chave da sua API |

#### Retorna um item

```http
  GET /api/items/${id}
```

| Parâmetro | Tipo     | Descrição                                   |
| :-------- | :------- | :------------------------------------------ |
| `id`      | `string` | **Obrigatório**. O ID do item que você quer |

#### add(num1, num2)

Recebe dois números e retorna a sua soma.
