<?php
require_once "conecta.php";

/* Lógica/Funções para o CRUD de Fabricantes*/

// listarfabricantes: usada pela página fabricantes/visualizar.php
function listarFabricantes($conexao):array {
    $sql = "SELECT * FROM fabricantes ORDER BY nome";

    try {
        /*preparando o comando SQL ANTES de executar no servidos e guardando em memória (variável consulta ou query) */
         $consulta = $conexao->prepare($sql);

        /*Executar o comando no banco de dados */
        $consulta->execute();

        /*Busca/Retorna todos os dados provenientes da execução da conculta e os transforma em um array associativo(ASSOC) */
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $erro) {
        die("Erro: ".$erro->getMessage());
    }
}

// inserirFabricante: usada pela página fabricantes/inserir.php
//void indica que não tem retorno
function inserirFabricante(PDO $conexao, string $nomeDoFabricante):void {
    /* :named parameter (parâmetro nomeado)
    Usamos este recuros do PDO para 'reservar' um espaço seguro em memória para colocação do dado. NUNCA passe de forma direta valores para comandos SQL.*/
    $sql = "INSERT INTO fabricantes(nome) VALUES(:nome)";

    try{
        $consulta = $conexao->prepare($sql);

        /* bindValue() -> permite vincular o valor do parâmetro à consulta que será executada. É necessario indicar qual é o parâmetro (:nome), de onde vem o valor ($nomeDoFabricante) e de que tipo ele é (PDO:PARAM_STR) */
        $consulta->bindValue(":nome", $nomeDoFabricante, PDO::PARAM_STR);
        $consulta->execute();
    } catch (Exception $erro){
        die("Erro ao inserir: ".$erro->getMessage());
    }
}

//listarUmFabricante: usada pela página fabricantes/atualizar.php
function listarUmFabricante(PDO $conexao, int $idFabricante):array {
    $sql = "SELECT * FROM fabricantes WHERE id = :id";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":id", $idFabricante, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die("Erro ao carregar fabricante: ".$erro->getMessage());
    }
}

//atualizarFabricante: usada em fabricantes/atualizar.php
function atualizarFabricante($conexao, $idFabricante, $nomeDoFabricante) :void {
    $sql = "UPDATE fabricantes SET nome = :nome WHERE id = :id";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":nome", $conexao, PDO::PARAM_STR);
        $consulta->bindValue(":id", $conexao, PDO::PARAM_INT);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro ao atualizar fabricante: " . $erro->getMessage());
    }
}

