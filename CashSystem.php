<?php

function TelaIncial() {
    echo "Bem-vindo ao sistema de login e cadastro!\n";
    echo "Escolha uma opção:\n";
    echo "1. Login\n";
    echo "2. Cadastro\n";
    echo "3. Sair\n";
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
echo telaIncial();

// Tela de login
echo "Digite o usuario: ";
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
echo $resultado, PHP_EOL;


