<?php

// Tela de login
function Login($usuario, $senha) {
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

echo "Digite o usuario: ";
$usuario = readline();
echo "Digite a senha: ";
$senha = readline();
$resultado = Login($usuario, $senha);
echo $resultado, PHP_EOL;

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
echo "Digite o usuario: ";
$usuario = readline();  
echo "Digite a senha: ";
$senha = readline();
$resultado = Cadastro($usuario, $senha);
echo $resultado, PHP_EOL;

//deslogar
