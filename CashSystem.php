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
$produtos= [];
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

function RegistrarProduto() {
    system("clear");
    global $produtos, $id;
    $item = readline("Digite o nome do produto: ");
    $preco = floatval(readline("Digite o preço do produto: "));
    foreach ($produtos as $produto) {
        if ($produto['nome'] === $item) {
            return "Esse produto já está cadastrado!\n";
        }
    }
    $produtos[$id] = [
        'nome' => $item,
        'preco' => $preco
    ];
    echo "Produto cadastrado com sucesso! ID: $id\n";
    $id++;
    return "";

}

function Vender($id, &$totaldeVendas, $usuariologado) {
   global $produtos;
   if(!isset($produtos[$id])) {
    return "Produto nao encontrado\n";
   }
   $nome = $produtos[$id]["nome"];
   $valor = $produtos[$id]["preco"];
   $totaldeVendas += $valor;
   registrarlog("$usuariologado Vendeu $nome por R$ $valor");
   return "Venda registrada\n";

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
                $id = readline("Digite o ID do produto: ");
                echo Vender($id, $totaldeVendas, $usuariologado);
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
                echo "Opção invalida! Tente novamente.\n";
        }
    }
}

while (true) {
    TelaInicial($usuarios, $usuariologado);
}