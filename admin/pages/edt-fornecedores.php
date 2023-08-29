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
	      				<h3>Editar Fornecedor</h3>
	  				</div> <!-- /widget-header -->
                     			
	      			<div class="widget-content">	      				
			      		
                      <?php
//RECUPERA OS DADOS
if(!isset($_GET['id'])){ header("Location: home.php?acao=ver-fornecedores"); exit;}
$id = $_GET['id'];
$select = "SELECT * from fornecedores WHERE id=:id";
$contagem=1;		
		try{
			$result = $conexao->prepare($select);
			$result->bindParam(':id', $id, PDO::PARAM_INT);			
			$result->execute();
			$contar = $result->rowCount();
			if($contar>0){
				while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
					$idForn 		= $mostra->id;
					$nomefornecedor = $mostra->nomefornecedor;

				}				
			}else{
				echo '<div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Aviso!</strong> Não há dados cadastrados com o id informado.
                </div>';exit;
			}
			
		}catch(PDOException $e){
			echo $e;
		}		
		if(isset($_POST['atualizar'])){
			$nomefornecedor		= trim(strip_tags($_POST['nomefornecedor']));
			$update = "UPDATE fornecedores SET nomefornecedor=:nomefornecedor WHERE id=:id";
		try{
			$result = $conexao->prepare($update);
			$result->bindParam(':id', $id, PDO::PARAM_INT);
			$result->bindParam(':nomefornecedor', $nomefornecedor, PDO::PARAM_STR);
			$result->execute();
			$contar = $result->rowCount();
			if($contar>0){
				echo '<div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Sucesso!</strong> O fornecedor foi atualizado.
                </div>';
			}else{
				echo '<div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Erro ao editar!</strong> Não foi possível atualizar o fornecedor.
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
												<input type="text" class="span6" id="nomefornecedor" value="<?php echo $nomefornecedor?>" name="nomefornecedor" required>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->                   
                        				<div class="form-actions">
											<input type="reset" onClick="volta()" class="btn btn-danger" value="Cancelar">
											<input type="submit" name="atualizar" class="btn btn-success" value="Atualizar">
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