<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Sobre esse projeto

Este é um projeto desenvolvido como parte de um teste para estágio. A aplicação consiste em uma API RESTful construida em Laravel, com o foco em rotas de listar Tools, filtrar por tags, cadastrar e deletar, implementei algumas rotas a mais é algumas validações extras para deixar um pouco mais completo, criado Cliente, onde tem as rotas de cadastro e login além de utilizar o Swagger/OpenApi para documentação.

---

## Tecnologias Utilizadas 🚀
- [Laravel 12](https://laravel.com)
- PHP 8.2
- Composer 2.8
- XAMPP (Apache + MySQL)
- Laravel Sanctum (Autenticação via token)
- Swagger-PHP (Documentação OpenApi)

---

## Requisitos ⚙️

Antes de rodar esse projeto, certifique-se de ter instalado na maquina:

- PHP >= 8.1
- Composer
- MySQL (ou outro banco de dados configurado)
- XAMPP (ou Apache/Nginx + MySQL)
- Git (opcional)

---

## Instalação e Execução

1. **Clone o repositório**
    ```bash
    git clone https://github.com/JeronimoNP/Desafio-Back.git
    cd Desafio-Back
2. **Instale as dependências**
    ```bash
    composer install
3. **Copie o .env de exemplo e configure as variáveis**
    ```bash
    cp .env.example .env
4. **Gere a chave da aplicação**
    ```bash
    php artisan key:generate
5. **Configure seu banco de dados no arquivo .env**
<p align="center">
  <img src="image\image.png" alt="Configuração do .env" width="500">
</p>

6. **Execute as migrations**
    ```bash
    php artisan migrate
7. **Popularize o banco de dados com dados de teste**
   ```bash
   php artisan db:seed
   ```
8. **Rode o servidor local com a porta 3000**
    ```bash
    php artisan serve --port=3000
9.  **Teste a rota get no navegador**
    ```bash
    http://127.0.0.1:3000/api/v1/tools/
    ```
* Obs: ele retornara 15 tools por vez, para visualizar a outra pagina acesse a url: http://127.0.0.1:3000/api/v1/tools?page=1 ou acesse o link no campo links no final do corpo json.
---

## Autenticação 🔒
A API usa o Laravel Sanctum para autenticação via token.
Após o login, um token será retornado para ser usado nas próximas requisições protegidas.

### Rota de Login
**POST** `/api/v1/login`

**Headers**
```json
        Accept application/json
``` 

**Corpo da requisição**

```json
    {
        "email": "usuario@gmail.com",
        "password": "senhaSegura123", //Obrigatorio 6 caracteres ou números
    }
```


**Resposta: 200**
```bash
    {
        "token": "seu-token"
    }
```
## 🟥 Cadastro de Ferramentas

### 📥 POST `/api/v1/tools`

**Requer autenticação!**

**JSON de exemplo:**

```json
{
  "title": "typescript",
  "link": "https://code.visualstudio.com",
  "description": "Editor de código leve e poderoso",
  "tags": ["editor", "code", "microsoft", "node", "teste"]
}
```

**Resposta esperada: 201**

```json
{
  "message": "Tool created successfully",
  "data": {
    "id": 1,
    "title": "typescript",
    "link": "https://code.visualstudio.com",
    "description": "Editor de código leve e poderoso",
    "tags": ["editor", "code", "microsoft", "node", "teste"],
    "created_at": "2025-04-20T00:00:00.000000Z",
    "updated_at": "2025-04-20T00:00:00.000000Z"
  }
}
```
## 🟩 Listando Ferramentas

### 📥 Get `/api/v1/tools`
**Resposta esperada:**
```json
{
	"current_page": 1,
	"data": [
		{
			"id": 1,
			"title": "consequuntur est voluptas",
			"link": "http://www.boyer.org/consequatur-qui-totam-dolorum-iste",
			"description": "Optio quod dolore nesciunt voluptatum molestias et ut vitae optio asperiores dolores neque.",
			"tags": [
				"backend",
				"javascript",
				"security"
			],
			"created_at": "2025-04-20T17:26:06.000000Z",
			"updated_at": "2025-04-20T17:26:06.000000Z"
		},
		{
			"id": 2,
			"title": "quae in facere",
			"link": "http://yundt.net/vitae-deserunt-accusantium-voluptatibus-non-iusto-aut-eos",
			"description": "Qui a accusamus consequuntur molestias harum autem dicta commodi sit distinctio quae.",
			"tags": [
				"api",
				"web",
				"javascript"
			],
			"created_at": "2025-04-20T17:26:06.000000Z",
			"updated_at": "2025-04-20T17:26:06.000000Z"
		}
    ]
}
```

## 🟩 filtrando Ferramentas por tags

### 📥 Get `/api/v1/tools?tag=backend`
**Resposta esperada:**
```json
{
	"current_page": 1,
	"data": [
		{
			"id": 1,
			"title": "consequuntur est voluptas",
			"link": "http://www.boyer.org/consequatur-qui-totam-dolorum-iste",
			"description": "Optio quod dolore nesciunt voluptatum molestias et ut vitae optio asperiores dolores neque.",
			"tags": [
				"backend",
				"javascript",
				"security"
			],
			"created_at": "2025-04-20T17:26:06.000000Z",
			"updated_at": "2025-04-20T17:26:06.000000Z"
		}
    ]
}
```
* obs: podemos filtra utilizando mais de uma tag por exemplo(`/api/v1/tools?tag=backend,javascript`) e buscara por ferramentas com essas tags backend e javascript.
---

## 📚 Documentação da API

A documentação segue o padrão Swagger/OpenAPI.

Após rodar o projeto e gerar os arquivos:

```bash
php swagger.php
```

Acesse via navegador:

📄 [`http://127.0.0.1:3000/swagger/index.html`](http://127.0.0.1:3000/swagger/index.html)

---

## 📌 Observações

- As validações são feitas via Form Requests.
- Os tokens são gerados apenas após autenticação bem-sucedida.
- Requisições sem header `Accept: application/json` recebem resposta padrão HTML.

---

## 👨‍💼 Autor

Desenvolvido por **Jeronimo Noleto Pacheco**  
📢 [familiadojeronimo@gmail.com](mailto:familiadojeronimo@gmail.com)

---

## 📄 Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

