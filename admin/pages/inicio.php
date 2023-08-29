<script>

</script>

<?php
function saudacao($nomeLogado = '')
{
    date_default_timezone_set('America/Sao_Paulo');
    $hora = date('H');
    if($hora >= 6 && $hora <= 12) {
        return 'Bom dia' . (empty($nomeLogado) ? '' : ', ' . $nomeLogado);
    } elseif ($hora > 12 && $hora <=18) {
        return 'Boa tarde' . (empty($nomeLogado) ? '' : ', ' . $nomeLogado);
    } else {
        return 'Boa noite' . (empty($nomeLogado) ? '' : ', ' . $nomeLogado);
    }

}
?>



<main>
        <div class="container my-8 bg-base-300 p-6">	      		      				
			    <span class="text-3xl font-sans font-semibold"><?php echo saudacao($nomeLogado) ?> :)</span>			      		
      	</div><!-- span 12 -->
            
            
    </div><!-- row -->  
    
    
   
<?php

    //excluir
    if(isset($_GET['delete'])) {
        $id_delete = $_GET['delete'];

        // seleciona a imagem
        $seleciona = "SELECT * from produtos WHERE id= :id_delete";
        try {
            $result = $conexao->prepare($seleciona);
            $result->bindParam('id_delete', $id_delete, PDO::PARAM_INT);
            $result->execute();
            $contar = $result->rowCount();
            if($contar>0) {
                $loop = $result->fetchAll();
                foreach ($loop as $exibir) {
                }


                // exclui o registo
                $seleciona = "DELETE from produtos WHERE id=:id_delete";
                try {
                    $result = $conexao->prepare($seleciona);
                    $result->bindParam('id_delete', $id_delete, PDO::PARAM_INT);
                    $result->execute();
                    $contar = $result->rowCount();
                    if($contar>0) {
                        echo '<div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Sucesso!</strong> O post foi excluído.
                </div>';
                    } else {
                        echo '<div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Erro!</strong> Não foi possível excluir o post.
                </div>';
                    }

                } catch (PDOException $erro) {
                    echo $erro;
                }
            }
        } catch (PDOException $erro) {
            echo $erro;
        }

    }

?> 

           
     
        
          <div class="font-semibold uppercase">
            <div class="inline text-center">
				      <span class=""><i class="fa fa-list"></i> Últimos Produtos Cadastrados</span>
            </div>
            <div class="overflow-x-auto pt-6">
              <table class="table table-xs table-zebra border-collapse border border-base-300 text-center">
                <thead>
                  <tr class="border border-slate-600">
                    <th class="border border-slate-600 "> Codigo</th>
                    <th class="border border-slate-600"> Descrição</th>
                    <th class="border border-slate-600 p-1"> Qtd</th>
                    <th class="border border-slate-600"> Tipo</th>
					          <th class="border border-slate-600 "> Data Cadastro</th>
					          <th class="border border-slate-600 p-1"> Fornecedor</th>
                    <th class="border border-slate-600">Editar/Remover </th>
                  </tr>
                </thead>
                <tbody>
<?php
include("functions/limita-texto.php");
$select = "SELECT * from produtos ORDER BY id DESC LIMIT 5";

try {
    $result = $conexao->prepare($select);
    $result->execute();
    $contar = $result->rowCount();
    if($contar>0) {
        while($mostra = $result->FETCH(PDO::FETCH_OBJ)) {
            ?>           
                  <tr class="border border-slate-600">
                  	<td class="border border-slate-600"><?php echo $mostra->codproduto;?></td>
                    <td class="border border-slate-600"> <?php echo limitarTexto($mostra->descricao, $limite=200)?> </td>
                    <td class="border border-slate-600"> <?php echo $mostra->quantidade;?> </td>
										<td class="border border-slate-600"> <?php echo $mostra->tipo;?> </td>
										<td class="border border-slate-600"> <?php echo $mostra->data;?> </td>
										<td class="border border-slate-600"> <?php echo $mostra->nomefornecedor;?> </td>
                    <td class="border border-slate-600"><a href="home.php?editar=id()" onClick="my_modal_2.showModal()" class="btn w-5 btn-primary"><i class="fa fa-edit p-0"> </i></a>
                    <a href="home.php?delete=<?php echo $mostra->id;?>" class="btn btn-warning w-5" onClick="return confirm('Deseja realmente excluir o post?')"><i class="fa fa-remove"> </i></a></td>
                  </tr>
<?php
        }
    } else {
        echo '<div class="alert alert-error">
                      <strong>Aviso!</strong> Não há produtos cadastrado em nosso banco de dados.
                </div>';
    }

} catch(PDOException $e) {
    echo $e;
}
?>                  
                  
                
                </tbody>
              </table>
			</main>

            <dialog id="my_modal_2" class="modal">
                <form method="get" class="modal-box">
                    
                    <h3 class="font-bold text-lg">Editar Produto</h3>
                    <?php

						$id = $_GET['id'];
                        $select = "SELECT * from produtos WHERE id=:id";
                        $contagem=1;
                        try {
                            $result = $conexao->prepare($select);
                            $result->bindParam(':id', $id, PDO::PARAM_INT);
                            $result->execute();
                            $contar = $result->rowCount();
                            if($contar>0) {
                                while($mostra = $result->FETCH(PDO::FETCH_OBJ)) {
                                    $idProd 		= $mostra->id;
                                    $codproduto 	= $mostra->codproduto;
                                    $descricao 		= $mostra->descricao;
                                    $quantidade	 	= $mostra->quantidade;
                                    $tipo 			= $mostra->tipo;
                                    $nomefornecedor = $mostra->nomefornecedor;
                                    $data 			= $mostra->data;
                                }
                            } else {
                                echo '<div class="alert alert-danger">
                      <strong>Aviso!</strong> Não há dados cadastrados com o id informado.
                </div>';
                                exit;
                            }

                        } catch(PDOException $e) {
                            echo $e;
                        }
                        if(isset($_POST['atualizar'])) {
                            $codproduto 		= trim(strip_tags($_POST['codproduto']));
                            $descricao 			= trim(strip_tags($_POST['descricao']));
                            $quantidade 		= trim(strip_tags($_POST['quantidade']));
                            $tipo 				= trim(strip_tags($_POST['tipo']));
                            $nomefornecedor		= trim(strip_tags($_POST['nomefornecedor']));
                            $data 				= trim(strip_tags($_POST['data']));

                            $update = "UPDATE produtos SET codproduto=:codproduto, descricao=:descricao, quantidade=:quantidade, tipo=:tipo, nomefornecedor=:nomefornecedor, data=:data WHERE id=:id";
                            try {
                                $result = $conexao->prepare($update);
                                $result->bindParam(':id', $id, PDO::PARAM_INT);
                                $result->bindParam(':codproduto', $codproduto, PDO::PARAM_INT);
                                $result->bindParam(':descricao', $descricao, PDO::PARAM_STR);
                                $result->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
                                $result->bindParam(':tipo', $tipo, PDO::PARAM_STR);
                                $result->bindParam(':nomefornecedor', $nomefornecedor, PDO::PARAM_STR);
                                $result->bindParam(':data', $data, PDO::PARAM_STR);
                                $result->execute();
                                $contar = $result->rowCount();
                                if($contar>0) {
                                    echo '<div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Sucesso!</strong> O produto foi atualizado.
                </div>';
                                } else {
                                    echo '<div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Erro ao editar!</strong> Não foi possível atualizar o produto.
                </div>';
                                }
                            } catch(PDOException $e) {
                                echo $e;
                            }

                        }
                        ?>
     	
		 <div class="tab-pane" id="formcontrols">
								<form id="edit-profile" class="form-horizontal" action="" method="post" enctype="multipart/form-descricao">
								
										
										<div class="control-group">											
											<label class="control-label" for="username">Codigo do produto</label>
											<div class="controls">
												<input type="text" class="span2" id="codproduto" value="<?php echo $codproduto ?>" name="codproduto">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="firstname">Nome do Produto</label>
											<div class="controls">
												<input type="text" class="span6" id="nomeproduto" value="<?php echo $descricao ?>" name="descricao">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										<div class="control-group">											
											<label class="control-label" for="username">Quantidade</label>
											<div class="controls">
												<input type="number" class="span2" id="quantidade" value="<?php echo $quantidade ?>" name="quantidade">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        
                                        <div class="control-group">											
											<label class="control-label" for="username">Tipo</label>
											<div class="controls">
												<select class="span2" id="tipo" name="tipo" value="<?php echo $tipo ?>">
												<option  value="<?php echo $tipo ?>"><?php echo $tipo ?></option>
                                                	<option>Material</option>
													<option>Brinde</option>
                                                </select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="email">Fornecedor</label>
											<div class="controls">
												<select class="span2" id="nomefornecedor" name="nomefornecedor" value="<?php echo $nomefornecedor?>">
													<option value="<?php echo $nomefornecedor?>"><?php echo $nomefornecedor?></option>
													<?php
                                                                       $sql = "SELECT id, nomefornecedor from fornecedores ORDER BY id ASC";

                        $resultado = $conexao->query($sql);

                        while($dados = $resultado->fetch()) {
                            echo "<option value=",$dados['nomefornecedor'],">", $dados['nomefornecedor'],"</option>";
                        }
                        ?>
												</select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="firstname">Data</label>
											<div class="controls">
												<input type="text" class="span2" id="date" value="<?php $data = date("d,m,Y");
												echo "$data"; ?>" name="data">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
                        				<div class="form-actions">
											<input type="reset" onClick="volta()" class="btn btn-danger" value="Voltar">
											<input type="submit" name="atualizar" class="btn btn-success" value="Editar">
										</div> <!-- /form-actions -->


                  				</form>
                    </div>
                </form>
                </dialog>