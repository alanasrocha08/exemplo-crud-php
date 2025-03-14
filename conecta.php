<?php
/* Parâmetros de conexão em ambiente de desenvolvimento, no nosso caso, o XAMPP */ 
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "vendas";

/* Configurações para conexão ao banco de dados */

// Criando conexão com o banco usando a classe PDO
// PDO (PDO PHP Data Object): Classe para manipulação de banco de dados
$conexao = new PDO(
    "mysql:host=$servidor;dbname=$banco;charset=utf8",
    $usuaro, $senha 
);