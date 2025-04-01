<?php
require_once "conecta.php";

function listarProdutos(PDO $conexao):array {
    //$sql = "SELECT * FROM produtos";
    $sql = "SELECT 
        produtos.id, produtos.nome AS produto,
        produtos.preco, produtos.quantidade,
        fabricantes.nome AS fabricante
        FROM produtos INNER JOIN fabricantes
        ON produtos.fabricante_id = fabricantes.id
        ORDER BY produto";
    try {
        $consulta = $conexao->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die("Erro ao carregar proodutos: ".$erro->getMessage());
    }
};


function inserirProduto(
    PDO $conexao, string $nome, float $preco, int $quantidade, int $fabricante, string $descricao):void {

        $sql = "INSERT INTO produtos(nome, descricao, preco, quantidade, fabricante_id)
        VALUES(:nome, :descricao, :preco, :quantidade, :fabricante_id)";
    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":nome", $nome, PDO::PARAM_STR);
        $consulta->bindValue(":descricao", $descricao, PDO::PARAM_STR);
        $consulta->bindValue(":preco", $preco, PDO::PARAM_STR);
        $consulta->bindValue(":quantidade", $quantidade, PDO::PARAM_INT);
        $consulta->bindValue(":fabricante_id", $fabricante, PDO::PARAM_INT);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro ao inserir produto: ".$erro->getMessage());
    }
}