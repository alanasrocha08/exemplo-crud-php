<?php
require_once "conecta.php";

/* Lógica/Funções para o CRUD de Fabricantes*/

// listarabricantes: usada pela página frabricantes/visualizar.php
function listarFabricantes($conexao):array {
    $sql = "SELECT * FROM fabricantes ORDER BY nome";

    /*preparando o comando SQL ANTES de executar no servidos e guardando em memória (variável consulta ou query) */
    $consulta = $conexao->prepare($sql);

    /*Executar o comando no banco de dados */
    $consulta->execute();

    /*Busca/Retorna todos os dados provenientes da execução da conculta e os transforma em um array associativo(ASSOC) */
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

