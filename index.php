	<?php
	$conexao = new PDO('mysql:host=localhost;dbname=meusprodutos',"root", "");

	$select = $conexao->prepare("select * from produtos");
	$select->execute();
	$fecth = $select->fetchall();//tras todas as linhas


	foreach ($fecth as $produto) {
		
		echo 'Nome do produto: ' .$produto['nome'].' &nbsp;
		Quantidade: '.$produto['quantidade'].'
		<a href="carrinho.php?add=carrinho&id='.$produto['id'].'">Adicionar ao carrinho</a>
		<br/>';
		
	}


	?>

	