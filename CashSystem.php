<?php

function TelaIncial($usuario, $senha) {
    echo "Bem-vindo ao sistema de login e cadastro!\n";
    echo "Escolha uma opção:\n";
    echo "1. Login\n";
    echo "2. Cadastro\n";
    echo "3. Sair\n";
    $opcao = readline("Digite sua opção: ");
    if ($opcao == "1") {
        $usuario = readline("Digite o usuario: \n");
        $senha = readline("Digite sua senha: \n");
        return Login($usuario, $senha);
}elseif ($opcao == "2") {
    $usuario = readline("Digite seu Usuario para cadastro: \n");
    $senha = readline("Digite sua senha para cadastro: \n");
    return Cadastro($usuario, $senha);
}elseif($opcao == "3"){
    return null; 
}
}
// Tela de login
function Login($usuario, $senha,) {
    $usuarios = [
        'admin' => '0000',
        'luiz' => '1234',
    ];
    if (isset($usuarios[$usuario]) && $usuarios[$usuario] === $senha) {
        return "Login realizado! ";
    }
    else {
        return "Login não realizado, tente novamente!";
    }
}
// Tela de cadastro
function Cadastro($usuario, $senha) {
    $usuarios = [
        'admin' => '0000',
        'luiz' => '1234',
    ];
    if (isset($usuarios[$usuario])) {
        return "Usuario já existe!";
    }
    else {
        $usuarios[$usuario] = $senha;
        return "Usuario cadastrado com sucesso!";
    }
}

// Registrar produto
function RegistrarProduto($item, $preco){
    $produtos = [
        'arroz' => 5.3,
        'feijao' =>20,
        'cafe' => 103,

    ];
    if (isset($produtos[$item]) && $produtos[$item] == $preco) {
        return "Esse produto ja existe! \n";

    }else {
        $produtos[$item] = $preco;
        return "Produto cadastrado! \n";
    }
}



function Vender($item, $preco){
    $vendas = [
        'arroz' => 20,
        'feijao' => 30,
        
    ];
    if(isset($vendas[$item]) && $vendas[$item] === $preco){
        return $vendas[$item];

    }
}
    
// Tela inicial 
echo telaIncial($usuario, $senha);

//test

$item = readline("Digite o produto:\n");
echo RegistrarProduto($item, $preco);