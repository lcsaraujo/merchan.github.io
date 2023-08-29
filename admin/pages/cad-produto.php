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
	      				<h3>Cadastrar Produto</h3>
	  				</div> <!-- /widget-header -->
                     			
	      			<div class="widget-content">	      				
			      		
                        <?php
	  	if(isset($_POST['cadastrar'])){
			$codproduto 		= trim(strip_tags($_POST['codproduto']));
			$descricao 			= trim(strip_tags($_POST['descricao']));
			$quantidade 		= trim(strip_tags($_POST['quantidade']));
			$tipo 				= trim(strip_tags($_POST['tipo']));
			$nomefornecedor		= trim(strip_tags($_POST['nomefornecedor']));
			$data 			= trim(strip_tags($_POST['data']));
			
			
			$insert = "INSERT into produtos (codproduto, descricao, quantidade, tipo, nomefornecedor, data ) VALUES (:codproduto, :descricao, :quantidade, :tipo, :nomefornecedor, :data)";
		
		try{
			$result = $conexao->prepare($insert);
			$result->bindParam(':codproduto', $codproduto, PDO::PARAM_STR);
			$result->bindParam(':descricao', $descricao, PDO::PARAM_STR);
			$result->bindParam(':quantidade', $quantidade, PDO::PARAM_STR);
			$result->bindParam(':tipo', $tipo, PDO::PARAM_STR);
			$result->bindParam(':nomefornecedor', $nomefornecedor, PDO::PARAM_STR);
			$result->bindParam(':data', $data, PDO::PARAM_STR);
			$result->execute();
			$contar = $result->rowCount();
			if($contar>0){
				echo '<div class="alert alert-success">
                      <button type="button" class="close" dat-dismiss="alert">×</button>
                      <strong>Sucesso!</strong> O produto foi cadastrado.
                </div>';
			}else{
				echo '<div class="alert alert-danger">
                      <button type="button" class="close" dat-dismiss="alert">×</button>
                      <strong>Erro ao cadastrar!</strong> Não foi possível cadastrar o produto.
                </div>';
			}			
		}catch(PDOException $e){
			echo $e;
		}
	}
	 ?>
     	
                        <div class="tab-pane" id="formcontrols">
								<form id="edit-profile" class="form-horizontal" action="" method="post" enctype="multipart/form-descricao">
								
										
										<div class="control-group">											
											<label class="control-label" for="username">Codigo do produto</label>
											<div class="controls">
												<input type="text" class="span2" id="codproduto" value="" name="codproduto">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="firstname">Nome do Produto</label>
											<div class="controls">
												<input type="text" class="span6" id="nomeproduto" value="" name="descricao" onChange="javascript:this.value=this.value.toUpperCase();">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										<div class="control-group">											
											<label class="control-label" for="username">Quantidade</label>
											<div class="controls">
												<input type="number" class="span2" id="quantidade" value="" name="quantidade">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        
                                        <div class="control-group">											
											<label class="control-label" for="username">Tipo</label>
											<div class="controls">
												<select class="span2" id="tipo"  name="tipo">
                                                	<option>Material</option>
													<option>Brinde</option>
                                                </select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="email">Fornecedor</label>
											<div class="controls">
												<select class="span2" id="nomefornecedor" name="nomefornecedor">
													<option></option>
													<?php

													$sql = "SELECT id, nomefornecedor from fornecedores ORDER BY id ASC";

													$resultado = $conexao->query($sql);

													while($dados = $resultado->fetch()){
														echo "<option value=",$dados['nomefornecedor'],">", $dados['nomefornecedor'],"</option>";
													}
													?>
												</select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="firstname">Data</label>
											<div class="controls">
												<input type="data" class="span2" id="date" value="<?php $data = date("d,m,Y"); echo "$data"; ?>" name="data">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
                        				<div class="form-actions">
											<input type="reset" onclick="volta()" class="btn btn-danger" value="Cancelar">
											<input type="submit" name="cadastrar" class="btn btn-success" value="Salvar">
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