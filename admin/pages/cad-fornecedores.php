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
	      				<h3>Cadastrar Fornecedor</h3>
	  				</div> <!-- /widget-header -->
                     			
	      			<div class="widget-content">	      				
			      		
                        <?php
	  	if(isset($_POST['cadastrar'])){
            $nomefornecedor 	    	= trim(strip_tags($_POST['nomefornecedor']));
			
					
			$insert = "INSERT into fornecedores (nomefornecedor) VALUES (:nomefornecedor)";
		
		try{
			$result = $conexao->prepare($insert);
            $result->bindParam(':nomefornecedor', $nomefornecedor, PDO::PARAM_STR);
			$result->execute();
			$contar = $result->rowCount();
			if($contar>0){
				echo '<div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Sucesso!</strong> O post foi cadastrado.
                </div>';
			}else{
				echo '<div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Erro ao cadastrar!</strong> Não foi possível cadastrar o post.
                </div>';
			}			
		}catch(PDOException $e){
			echo $e;
		}	
						
	}
	 
	 ?>
     	
                        <div class="tab-pane" id="formcontrols">
								<form id="edit-profile" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
								
										
										<div class="control-group">											
											<label class="control-label" for="username">Nome Fornecedor</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="nomefornecedor" value="" name="nomefornecedor" required>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->                   
                        				<div class="form-actions">
											<input type="reset" onClick="volta()" class="btn" value="Cancelar">
											<input type="submit" name="cadastrar" class="btn" value="Cadastrar">
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