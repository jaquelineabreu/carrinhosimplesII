<?php
	session_start();
	if(!isset($_SESSION['itens']))
	{
		$_SESSION['itens'] = array();
	}

	//adiciona ao carrinho
	if(isset($_GET['add']) && $_GET['add'] == "carrinho"){

		$idProduto = $_GET['id'];
		if(!isset($_SESSION['itens'][$idProduto])){// se não adicionou o produto ainda

			$_SESSION['itens'][$idProduto] = 1; //adiciona o produto pela primeira vez caso nao tenha sido adicionado

		}else{

			$_SESSION['itens'][$idProduto] +=1; //caso tenha adiciona somando ao carrinho
		}

	}


	//Exibe o carrinho
	if(count($_SESSION['itens']) == 0){
		echo 'Carrinho Vazio<br><a href="index.php">Adicionar itens</a>';
	}else{
		$conexao = new PDO('mysql:host=localhost;dbname=meusprodutos',"root", "");
		foreach ($_SESSION['itens'] as $idProduto => $quantidade) {	
			$select = $conexao->prepare("select * from produtos where id=?");
			$select->bindParam(1,$idProduto);
			$select->execute();
			$produtos = $select->fetchAll();//tras todas as linhas
			$total = $quantidade * $produtos[0]["preco"];
			echo 
				'Nome: '. $produtos[0]["nome"].'<br/>
				 Preço: ' . number_format($produtos[0]["preco"],2,",",".").'<br/>
			     Quantidade: '.$quantidade.'<br/>
			     Total: ' . number_format($total,2,",",".") . '<br/>			    
			     <a href="remover.php?remover=carrinho&id='.$idProduto.'">Remover</a>
			     <hr/>	';	
		}
	}
?>