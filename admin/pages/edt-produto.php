<script type="text/javascript">
jQuery(function($){
   $("#date").mask("99/99/9999",{placeholder:"dd/mm/yyyy"});
});
</script>
<div class="main">
  <div class="main-inner">
    <div class="container">
     <div class="row">
     	  
            <div class="span12">	      		
	      		<div id="target-1" class="widget">	 
                
                <div class="widget-header">
	      			<i class="icon-file"></i>
	      			<h3>Editar Produto</h3>
	  			</div> <!-- /widget-header -->
                     			
	      			<div class="widget-content">	      				
			      		
                    <?php
						//RECUPERA OS DADOS
						if(!isset($_GET['id'])) {
							header("Location: home.php?acao=ver-produto");
							exit;
						}
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
                      <button type="button" class="close" data-dismiss="alert">×</button>
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
                        
                        
		      		</div> <!-- /widget-content -->
	      		</div> <!-- /widget -->
      		</div><!-- span 12 -->
            
            
    </div><!-- row -->        
     
      
          
        </div>
        <!-- /span6 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->
<script>
    function volta(){
        window.history.back();
    }
</script>