<?php
require "Model/index.php";
require "View/index.php";

class Controller
{
  public function monta_home() {
    $view = new View();

    $view->render_header();
  }

  public function monta_listagem_pedidos() {
    $view = new View();
    $model = new Model();

    $pedidos = $model->get_pedidos()->fetchAll(PDO::FETCH_NUM);

    $view->render_header();
    echo "<main class='container'>";
    $view->render_table(["ID", "Data do Pedido", "Cliente"], $pedidos);
    echo "</main>";
  }

  public function monta_solicita_pedido() {
    $view = new View();
    $model = new Model();

    $clientes = $model->get_clientes()->fetchAll(PDO::FETCH_NUM);
    $produtos = $model->get_produtos()->fetchAll(PDO::FETCH_NUM);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_cliente"]) && isset($_POST["produtos"])) {
      $id_cliente = $_POST["id_cliente"];
      $lista_produtos = $_POST["produtos"];
      $model->post_pedido($id_cliente, $lista_produtos);
      // Redireciona para evitar reenvio do formulário ao recarregar a página
      header("Location: " . $_SERVER['REQUEST_URI']);
      exit();
    }

    $view->render_header();
    echo "<main class='container'>";
    $view->render_form_pedido($clientes, $produtos);
    echo "</main>";
  }

  public function monta_registra_itens() {
    $view = new View();
    $model = new Model();

    $produtos = $model->get_produtos()->fetchAll(PDO::FETCH_NUM);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nome_item"]) && isset($_POST["quantidade"])) {
      $nome_item = $_POST["nome_item"];
      $quantidade = $_POST["quantidade"];
      $model->post_produto($nome_item, $quantidade);
      // Redireciona para evitar reenvio do formulário ao recarregar a página
      header("Location: " . $_SERVER['REQUEST_URI']);
      exit();
    }

    $view->render_header();
    echo "<main class='container'>";
    $view->render_table(["ID", "Nome do Produto", "Quantidade"], $produtos);
    $view->render_form_produto();
    echo "</main>";
  }
  
}
