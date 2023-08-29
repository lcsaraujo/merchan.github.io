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
	      				<h3>Cadastrar Usuário</h3>
	  				</div> <!-- /widget-header -->
                     			
	      			<div class="widget-content">	      				
			      		
                        <?php
	  	if(isset($_POST['cadastrar'])){
            $nome 	    	= trim(strip_tags($_POST['nome'])); 
            $usuario    	= trim(strip_tags($_POST['usuario']));
            $senha		    = trim(strip_tags($_POST['senha']));
            $nivel      	= trim(strip_tags($_POST['nivel']));
					
			$insert = "INSERT into login (nome, usuario, senha, nivel) VALUES (:nome, :usuario, :senha, :nivel)";
		
		try{
			$result = $conexao->prepare($insert);
            $result->bindParam(':nome', $nome, PDO::PARAM_STR);
            $result->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $result->bindParam(':senha', $senha, PDO::PARAM_STR);
			$result->bindParam(':nivel', $nivel, PDO::PARAM_STR);
			$result->execute();
			$contar = $result->rowCount();
			if($contar>0){
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>Sucesso!</strong> O usuario foi cadastrado.
                	  </div>';
			}else{
				echo '<div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Erro ao cadastrar!</strong> Não foi possível cadastrar o usuário.
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
											<label class="control-label" for="username">Nome</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="nome" value="" name="nome" required>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										<div class="control-group">											
											<label class="control-label" for="lastname">Usuário</label>
											<div class="controls">
												<input type="text" multiple class="span6 fileinput" id="usuario" name="usuario" required>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
											<label class="control-label" for="lastname">Senha</label>
											<div class="controls">
												<input type="password" multiple class="span6 fileinput" id="senha" name="senha" required>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

                                        <div class="control-group">											
											<label class="control-label" for="username">Nível</label>
											<div class="controls">
												<select class="span2" id="nivel"  name="nivel" required>
                                                	<option value="0">Usuario</option>
                                                    <option value="1">Administrador</option>
                                                </select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                        
                        
                        				<div class="form-actions">
											<input type="reset" onclick="volta()" class="btn" value="Cancelar">
											<input type="submit" name="cadastrar" class="btn btn-primary" value="Salvar">
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