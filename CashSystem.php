<?php
function TelaIncial(&$usuario, &$senha) {
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
            return Login($usuario, $senha);
        case 2:
            $usuario = readline("Digite seu usuário: ");
            $senha = readline("Digite sua senha: ");
            return Cadastro($usuario, $senha);
        case 3:
            return "Saindo do sistema...\n";
        default:
            return "Opção inválida! Tente novamente.\n";
    }
}
// Tela de login
function Login(&$usuario, &$senha) {
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
    $item = readline("Digite o produto");
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
function Vender(&$item, &$preco){
    $vendas = [
        'arroz' => 20,
        'feijao' => 30,
        
    ];
    if(isset($vendas[$item]) && $vendas[$item] === $preco){
        return $vendas[$item];

    }
}
function TelaVenda($item, $preco) {
    echo "Bem-vindo ao sistema de login e cadastro!\n";
    echo "Escolha uma opção:\n";
    echo "1. Venda\n";
    echo "2. Registrar item\n";
    echo "3. Deslogar\n";
    echo "4. Log\n";
    $opcao = readline("Digite sua opção:\n");
    switch ($opcao) {
        case 1:
            $item = readline("Digite o produto: ");
            $preco = readline("Digite o preço: ");
            return Vender($item, $preco);
        case 2:
            return RegistrarProduto( $item, $preco);
            case 3:
            return TelaIncial($usuario, $senha);
        default:
            return "Opção inválida! Tente novamente.\n";
                case 4:
                    return "Log: \n";
    }
}
// Tela inicial 
echo telaIncial($usuario, $senha);
// test
echo TelaVenda($item, $preco);