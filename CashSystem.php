<?php
date_default_timezone_set('America/Sao_Paulo');
define("LOG_FILE", "logmercado.txt");

$usuarios = [
    'admin' => '0000',
    'luiz' => '1234',
    'moacir'=> '4321',
];
$usuariologado = null;
$totaldeVendas = 0.0;
$caixa = [];
$produtos = [];
$id = 1;

function registrarlog($mensagem) {
    $datahora = date("d/m/Y H:i:s");
    $linha = "$datahora, $mensagem" . PHP_EOL;
    file_put_contents(LOG_FILE, $linha, FILE_APPEND);
}
function exibirlog() {
     system('clear');
    if (file_exists(LOG_FILE)) {
        echo file_get_contents(LOG_FILE);
    } else {
        echo "Nenhum log encontrado!";
    }
}
function TelaInicial(&$usuarios, &$usuariologado) {
    
    echo "Bem-vindo ao sistema de login e cadastro!\n";
    echo "Escolha uma opcao:\n";
    echo "1. Login\n";
    echo "2. Cadastro\n";
    echo "3. Sair\n";
    $opcao = readline("Digite sua opcao: ");
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
            echo "Saindo...\n";
            exit;
        default:
            echo "Opcao invalida!\n";
    }
}

function Login($usuario, $senha, $usuarios) {
    system('clear');
    return isset($usuarios[$usuario]) && $usuarios[$usuario] === $senha;
}
function Cadastro($usuario, $senha, &$usuarios) {
     system('clear');
    if (isset($usuarios[$usuario])) {
        return "Usuario ja existe!\n";
    } else {
        $usuarios[$usuario] = $senha;
        registrarlog("Novo usuario '$usuario' cadastrado.");
        return "Usuario cadastrado com sucesso!\n";
    }
}

function RegistrarProduto(&$produtos, &$id) {
    $nome = readline("Digite o nome do produto: ");
    $preco = readline("Digte o preco do produto: ");
    $estoque = (int)readline("Quantos produtos foram adicionados: ");
    $produtos[$id++] = [
        "nome"=> $nome,
        "preco"=> $preco,
        "estoque"=> $estoque
    ];
    registrarlog("Produto $nome, registrado");
    return "ID do produto cadastrado e $id\n";
}

function Vender(&$id) {
     system('clear');
     $id = (int)readline("Digite o ID do produto: \n" );
     if(isset($id)) {
        return "Produto ventido"; 
    }else("");{
        return "Produto nao existe";
    }
     
}


function TelaVenda($usuariologado) {
     system('clear');
    global $totaldeVendas;
    while (true) {
        echo "Bem-vindo, $usuariologado!\n";
        echo "Total vendido: R$ " . number_format($totaldeVendas, 2, ',', '.') . "\n";
        echo "1. Venda\n";
        echo "2. Registrar item\n";
        echo "3. Deslogar\n";
        echo "4. Ver log\n";
        $opcao = readline("Digite sua opção: ");

        switch ($opcao) {
            case 1:
                echo Vender($id);
                break;
            case 2:
                echo RegistrarProduto($produtos, $id);
                break;
            case 3:
                registrarlog("Usuário '$usuariologado' fez logout.");
                echo "Deslogado com sucesso!\n";
                return;
            case 4:
                exibirlog();
                break;
            default:
                echo "Opção invalida! Tente novamente.\n";
        }
    }
}

while (true) {
    TelaInicial($usuarios, $usuariologado);
}