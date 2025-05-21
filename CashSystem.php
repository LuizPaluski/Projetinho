<?php
date_default_timezone_set('America/Sao_Paulo');
define("LOG_FILE", "log.txt");

function registrarlog($mensagem) {
    $datahora = date("d/m/Y H:i:s");
    $linha = "[$datahora] $mensagem" . PHP_EOL;
    file_put_contents(LOG_FILE, $linha, FILE_APPEND);
}

function exibirlog() {
    if (file_exists(LOG_FILE)) {
        echo file_get_contents(LOG_FILE);
    } else {
        echo "Nenhum log encontrado!\n";
    }
}

function telaInicial() {
    echo "Bem-vindo ao sistema de login e cadastro!\n";
    echo "Escolha uma opção:\n";
    echo "1. Login\n";
    echo "2. Cadastro\n";
    echo "3. Sair\n";

    $opcao = readline("Digite sua opção: ");

    switch ($opcao) {
        case 1:
            $usuario = readline("Digite seu usuário: ");
            $senha = readline("Digite sua senha: ");
            $res = login($usuario, $senha);
            registrarlog("Tentativa de login do usuário $usuario: $res");
            echo $res . PHP_EOL;
            if (strpos($res, "realizado")) {
                telaVenda();
            }
            break;

        case 2:
            $usuario = readline("Digite seu usuário: ");
            $senha = readline("Digite sua senha: ");
            $res = cadastro($usuario, $senha);
            registrarlog("Cadastro de usuário $usuario: $res");
            echo $res . PHP_EOL;
            break;

        case 3:
            echo "Saindo do sistema...\n";
            exit;

        default:
            echo "Opção inválida! Tente novamente.\n";
            break;
    }
}

function login($usuario, $senha) {
    $usuarios = [
        'admin' => '0000',
        'luiz' => '1234',
    ];

    if (isset($usuarios[$usuario]) && $usuarios[$usuario] === $senha) {
        return "Login realizado!";
    } else {
        return "Login não realizado, tente novamente!";
    }
}

function cadastro($usuario, $senha) {
    $usuarios = [
        'admin' => '0000',
        'luiz' => '1234',
    ];

    if (isset($usuarios[$usuario])) {
        return "Usuário já existe!";
    } else {
        // Simulando cadastro (não persiste)
        $usuarios[$usuario] = $senha;
        return "Usuário cadastrado com sucesso!";
    }
}

function registrarProduto(&$produtos) {
    $item = readline("Digite o nome do produto: ");
    $preco = floatval(readline("Digite o preço do produto: "));

    if (isset($produtos[$item])) {
        echo "Esse produto já existe!\n";
    } else {
        $produtos[$item] = $preco;
        echo "Produto cadastrado!\n";
        registrarlog("Produto '$item' cadastrado com preço R$ $preco");
    }
}

function vender(&$produtos) {
    $item = readline("Digite o produto: ");
    $preco = floatval(readline("Digite o preço: "));

    if (isset($produtos[$item]) && $produtos[$item] == $preco) {
        echo "Venda realizada: $item por R$ $preco\n";
        registrarlog("Venda: $item por R$ $preco");
    } else {
        echo "Produto não encontrado ou preço incorreto.\n";
    }
}

function telaVenda() {
    $produtos = [
        'arroz' => 5.3,
        'feijao' => 20,
        'cafe' => 103,
    ];

    while (true) {
        echo "\nMenu de Vendas:\n";
        echo "1. Vender\n";
        echo "2. Registrar item\n";
        echo "3. Log\n";
        echo "4. Sair\n";

        $opcao = readline("Digite sua opção: ");

        switch ($opcao) {
            case 1:
                vender($produtos);
                break;
            case 2:
                registrarProduto($produtos);
                break;
            case 3:
                exibirlog();
                break;
            case 4:
                echo "Saindo...\n";
                return;
            default:
                echo "Opção inválida!\n";
        }
    }
}

// Execução inicial
while (true) {
    telaInicial();
}
