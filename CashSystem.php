<?php
date_default_timezone_set('America/Sao_Paulo');
define("LOG_FILE", "log.txt");

$usuarios = [
    'admin' => '0000',
    'luiz' => '1234',
    'moacir'=> '4321',
];
$usuariologado = null;
$totaldeVendas = 0.0;
$caixa = [];
$id = 1;

function registrarlog($mensagem) {
    $datahora = date("d/m/Y H:i:s");
    $linha = "[$datahora] $mensagem" . PHP_EOL;
    file_put_contents(LOG_FILE, $linha, FILE_APPEND);
}

function exibirlog() {
    if (file_exists(LOG_FILE)) {
        echo file_get_contents(LOG_FILE);
    } else {
        echo "Nenhum log encontrado!";
    }
}

function TelaInicial(&$usuarios, &$usuariologado) {
    echo "Bem-vindo ao sistema de login e cadastro!\n";
    echo "Escolha uma opção:\n";
    echo "1. Login\n";
    echo "2. Cadastro\n";
    echo "3. Sair\n";
    $opcao = readline("Digite sua opção: ");
    switch ($opcao) {
        case 1:
            $usuario = readline("Digite seu usuario: ");
            $senha = readline("Digite sua senha: ");
            if (Login($usuario, $senha, $usuarios)) {
                $usuariologado = $usuario;
                registrarlog("Usuário '$usuario' fez login.");
                TelaVenda($usuariologado);
            } else {
                echo "Login falhou!\n";
            }
            break;
        case 2:
            $usuario = readline("Novo usuario: ");
            $senha = readline("Senha: ");
            echo Cadastro($usuario, $senha, $usuarios);
            break;
        case 3:
            echo "Saindo do sistema...\n";
            exit;
        default:
            echo "Opção inválida!\n";
    }
}

function Login($usuario, $senha, $usuarios) {
    return isset($usuarios[$usuario]) && $usuarios[$usuario] === $senha;
}

function Cadastro($usuario, $senha, &$usuarios) {
    if (isset($usuarios[$usuario])) {
        return "Usuario ja existe!\n";
    } else {
        $usuarios[$usuario] = $senha;
        registrarlog("Novo usuario '$usuario' cadastrado.");
        return "Usuario cadastrado com sucesso!\n";
    }
}

function RegistrarProduto() {
    $item = readline("Digite o nome do produto: ");
    $preco = floatval(readline("Digite o preço do produto: "));
    $produtos = [
        'arroz' => null,
        'feijao' => null,
        'cafe' => null,
    ];
    if (isset($produtos[$item])) {
        return "Esse produto ja existe!\n";
    } else {
        $produtos[$item] = $preco;
        return "Produto cadastrado com sucesso!\n";
    }
}

function Vender($item, $preco, &$totaldeVendas, $usuariologado) {
    $totaldeVendas += $preco;
    //talvez adicionar um foreach para verificar se o produto existe ou verificar id 
    // criar uma enteracao para verificar o id dos produtos
    registrarlog("Usuario $usuariologado vendeu $item por R$ $preco.");
    return "Venda registrada!\n";
}

function TelaVenda($usuariologado) {
    global $totaldeVendas;

    while (true) {
        echo "\nBem-vindo, $usuariologado!\n";
        echo "Total vendido: R$ " . number_format($totaldeVendas, 2, ',', '.') . "\n";
        echo "1. Venda\n";
        echo "2. Registrar item\n";
        echo "3. Deslogar\n";
        echo "4. Ver log\n";
        $opcao = readline("Digite sua opção: ");

        switch ($opcao) {
            case 1:
                $item = readline("Digite o produto: ");
                $preco = floatval(readline("Digite o preço: "));
                echo Vender($item, $preco, $totaldeVendas, $usuariologado);
                break;
            case 2:
                echo RegistrarProduto();
                break;
            case 3:
                registrarlog("Usuário '$usuariologado' fez logout.");
                echo "Deslogado com sucesso!\n";
                return;
            case 4:
                exibirlog();
                break;
            default:
                echo "Opção inválida! Tente novamente.\n";
        }
    }
}

// Início do sistema
while (true) {
    TelaInicial($usuarios, $usuariologado);
}
