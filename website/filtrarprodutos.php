<?php
if (isset($_GET['pesquisa_produtos'])) {
    $pesquisa_produtos = $_GET['pesquisa_produtos'];

    $produtos = "SELECT produtos.cod_produto, produtos.preco, produtos.nome, produtos.stock, produtos.novidade, produtos.destaques, produtos.estado FROM produtos where produtos.nome LIKE '%$pesquisa_produtos%'";

    if (isset($_GET['cod_categoria'])) {
        $categorias = $_GET['cod_categoria'];

        foreach ($categorias as $index => $value) {
            $produtos .= " AND produtos.cod_produto IN (SELECT cod_produto FROM produto_categoria WHERE cod_categoria='" . $value . "')";
        }
    }

    if (isset($_GET['cod_marca'])) {
        $marcas = $_GET['cod_marca'];

        foreach ($marcas as $index => $value) {
            $produtos .= " AND produtos.cod_produto IN (SELECT cod_produto FROM produto_marca WHERE cod_marca='" . $value . "')";
        }
    }

    if (isset($_GET['valor_minimo']) || isset($_GET['valor_maximo'])) {
        $valor_minimo = $_GET['valor_minimo'];
        $valor_maximo = $_GET['valor_maximo'];

        if ($valor_maximo === "") {
            $valor_maximo = 99999;
        }

        if ($valor_minimo === "") {
            $valor_minimo = 0;
        }

        $produtos .= " AND produtos.preco BETWEEN $valor_minimo AND $valor_maximo";
    }
} else {
    $produtos = "SELECT cod_produto, preco, nome, stock, novidade, destaques, estado FROM produtos";
}

// Executar a consulta SQL e obter os resultados
$resultados = mysqli_query($ligax, $produtos);
$produtos_array = array();

// Iterar sobre os resultados e criar um array associativo
while ($registro = mysqli_fetch_assoc($resultados)) {
    $produtos_array[] = $registro;
}

// Retornar os resultados como JSON
header('Content-Type: application/json');
echo json_encode($produtos_array);
?>
