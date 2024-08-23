<?php
  include "conexao_bd.php";

  class Model {
    public function get_pedidos(){
      $database = new Database();
      $conn = $database->connect();

        $query = "SELECT pedido.id, pedido.data_pedido, cliente.nome FROM pedido 
        JOIN cliente ON pedido.id_cliente = cliente.id ORDER BY data_pedido DESC";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function post_pedido($id_cliente, $produtos){
      $database = new Database();
      $conn = $database->connect();

        $query = "INSERT INTO pedido (id_cliente) VALUES (:id_cliente)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();
        
        $id_pedido = $conn->lastInsertId();

        foreach ($produtos as $produto) {
          $query = "INSERT INTO itens_do_pedido (id_pedido, id_produto) VALUES (:id_pedido, :id_produto)";
          $stmt = $conn->prepare($query);
          $stmt->bindParam(':id_pedido', $id_pedido);
          $stmt->bindParam(':id_produto', $produto);
          $stmt->execute();
        }
    }

    public function get_produtos(){
      $database = new Database();
      $conn = $database->connect();

        $query = "SELECT * FROM produto";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function post_produto($nome_item, $quantidade){
      $database = new Database();
      $conn = $database->connect();

        $query = "INSERT INTO produto (nome_item, quantidade) VALUES (:nome_item,:quantidade)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nome_item', $nome_item);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->execute();
    }

    public function get_clientes(){
      $database = new Database();
      $conn = $database->connect();

        $query = "SELECT * FROM cliente";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }   
}
?>