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
    ;
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
// Tela inicial
echo telaIncial($usuario,"");

// Tela de login
/*echo "Digite o usuario: ";
$usuario = readline();
echo "Digite a senha: ";
$senha = readline();
$resultado = Login($usuario, $senha);
echo $resultado, PHP_EOL;

//Cadastro
echo "Digite o usuario: ";
$usuario = readline();  
echo "Digite a senha: ";
$senha = readline();
$resultado = Cadastro($usuario, $senha);
echo $resultado, PHP_EOL;*/


