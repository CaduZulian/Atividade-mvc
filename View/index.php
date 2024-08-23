<?php

class View{
  public function render_header() {
    echo "
      <nav class='header'>
        <ul>
          <li><a href='index.php'>Home</a></li>
          <li><a href='listagem_pedidos.php'>Pedidos</a></li>
          <li><a href='registra_itens.php'>Produtos</a></li>
          <li><a href='solicita_pedido.php'>Criar Pedido</a></li>
        </ul>
      </nav>
    ";
  }

  public function render_table($colunas, $dados) {
    echo "<table class='table-container'>";
    echo "<tr>";
    foreach ($colunas as $coluna) {
      echo "<th>$coluna</th>";
    }
    echo "</tr>";

    foreach ($dados as $dado) {  
      echo "<tr>";
      for ($i = 0; $i < count($dado); $i++) {
        echo "<td>$dado[$i]</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  }

  public function render_form_produto() {
    echo "
      <form action='registra_itens.php' method='post' class='form-column'>
        <div class='input-container'>
          <label for='nome_item'>Nome do Item</label>
          <input type='text' id='nome_item' name='nome_item'>
        </div>

        <div class='input-container'>
          <label for='quantidade'>Quantidade</label>
          <input type='text' id='quantidade' name='quantidade'>
        </div>

        <input type='submit' value='Enviar' class='button'>
      </form>
    ";
  }

  public function render_form_pedido($clientes, $produtos) {
    echo "
      <form action='solicita_pedido.php' method='post' class='form-column'>
        <div class='input-container'>
          <label for='id_cliente'>Cliente</label>
          <select id='id_cliente' name='id_cliente'>
            <option value=''>Selecione um cliente</option>
    ";
    foreach ($clientes as $cliente) {
      echo "<option value='$cliente[0]'>$cliente[1]</option>";
    }
    echo "
        </select>
      </div>
      <div class='input-container'>
        <label for='produtos'>Produtos</label> 
    ";
    foreach ($produtos as $produto) {
      echo "
      <div class='checkbox-container'>
        <input type='checkbox' name='produtos[]' value='$produto[0]'>
        <label>$produto[1]</label>
      </div>
      ";
      
    }
    echo "
    </div>
        <input type='submit' value='Enviar' class='button'>
      </form>
    ";
  }
}

?>