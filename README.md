# Sistema de Gestão de Estoque

Um sistema web simples para gestão de estoque, permitindo o controle de produtos, usuários, fornecedores e compras.

## Funcionalidades

*   **Gestão de Produtos:** Adicionar, editar, visualizar e excluir produtos.
*   **Gestão de Usuários:** Adicionar, editar, visualizar e excluir usuários (administradores e usuários comuns).
*   **Gestão de Fornecedores:** Adicionar, editar, visualizar e excluir informações de fornecedores.
*   **Gestão de Compras:** Registrar e visualizar compras realizadas.
*   **Autenticação Segura:** Login de usuário e administrador com senhas criptografadas.
*   **Dashboard:** Visão geral do estoque e atividades.

## Tecnologias Utilizadas

*   **Backend:** PHP
*   **Banco de Dados:** MySQL
*   **Frontend:** HTML, CSS (Bootstrap), JavaScript (jQuery)
*   **Servidor Web:** PHP Built-in Web Server (para desenvolvimento)

## Configuração do Ambiente

### 1. Pré-requisitos

Certifique-se de ter o seguinte software instalado em sua máquina:

*   **PHP** (versão 7.4 ou superior recomendada)
*   **MySQL** (ou MariaDB)

### 2. Configuração do Banco de Dados

1.  **Crie o Banco de Dados:**
    Crie um banco de dados MySQL chamado `sistema_de_estoque`.

    ```sql
    CREATE DATABASE sistema_de_estoque;
    ```

2.  **Crie as Tabelas:**
    Execute os seguintes comandos SQL no seu banco de dados `sistema_de_estoque` para criar as tabelas necessárias:

    ```sql
    -- Tabela: usuario
    CREATE TABLE usuario (
        idusuario VARCHAR(36) PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        role VARCHAR(50),
        status VARCHAR(50)
    );

    -- Tabela: fornecedor
    CREATE TABLE fornecedor (
        idfornecedor INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        email VARCHAR(255),
        telefone VARCHAR(20)
    );

    -- Tabela: categoria
    CREATE TABLE categoria (
        idcategoria INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL
    );

    -- Tabela: produto
    CREATE TABLE produto (
        idproduto INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        descricao TEXT,
        preco DECIMAL(10, 2),
        quant_em_estoque INT,
        cod_de_barra VARCHAR(255),
        idfornecedor INT,
        idcategoria INT
    );

    -- Tabela: compra
    CREATE TABLE compra (
        idcompra INT AUTO_INCREMENT PRIMARY KEY,
        cliente VARCHAR(255),
        produtos TEXT,
        data_compra TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        idusuario VARCHAR(36),
        preco_total DECIMAL(10, 2),
        FOREIGN KEY (idusuario) REFERENCES usuario(idusuario)
    );

    -- Adicionar chaves estrangeiras à tabela produto (execute APÓS criar as tabelas fornecedor e categoria)
    ALTER TABLE produto
    ADD CONSTRAINT fk_fornecedor
    FOREIGN KEY (idfornecedor) REFERENCES fornecedor(idfornecedor);

    ALTER TABLE produto
    ADD CONSTRAINT fk_categoria
    FOREIGN KEY (idcategoria) REFERENCES categoria(idcategoria);
    ```

3.  **Credenciais do Banco de Dados:**
    O sistema está configurado para usar as seguintes credenciais no arquivo `model/conect/DBConnection.php`:
    *   Host: `localhost`
    *   Usuário: `root`
    *   Senha: (vazia)

    Se suas credenciais forem diferentes, edite o arquivo `model/conect/DBConnection.php` para refletir suas configurações.

### 3. Executando a Aplicação

1.  **Navegue até o diretório do projeto:**
    Abra seu terminal e navegue até a pasta raiz do projeto (`Sistema-de-Estoque`).

    ```bash
    cd /caminho/para/Sistema-de-Estoque
    ```

2.  **Inicie o servidor web embutido do PHP:**

    ```bash
    php -S localhost:8000
    ```

3.  **Acesse a Aplicação:**
    Abra seu navegador e acesse: `http://localhost:8000/`

    Você será redirecionado para a página de login do administrador.

## Uso

### Login

*   **Administrador:** Acesse `http://localhost:8000/`.
*   **Usuário:** Acesse `http://localhost:8000/view/user/index.php`.

### Criando um Novo Usuário (Após a Configuração Inicial)

Para criar um novo usuário (admin ou comum) com senha criptografada, faça login como administrador e navegue até a página "Add New User" (geralmente em `/view/admin/add_new_user.php`).

## Contribuição

Sinta-se à vontade para contribuir com melhorias, correções de bugs ou novas funcionalidades.

## Licença

Este projeto está licenciado sob a licença MIT.