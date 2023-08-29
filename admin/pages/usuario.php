
<div class="main">
  <div class="main-inner">
    <div class="container">
     <div class="row">
     
     		
            <div class="span12">
            
            <?php
				if(isset($_GET['acao'])){
					$acao = $_GET['acao'];
					if($acao=='welcome'){
						echo 
               '<div class="alert alert-info">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Olá, '.$nomeLogado.'!</strong> Seja Bem vindo ao <strong>Dashboard</strong> !
               </div>';
					}
				}
			 ?>  
      		</div>
            
            
            <div class="span12">	      		
	      		<div id="target-1" class="widget">	      			
	      			<div class="widget-content">	      				
			      		<h1><strong>Seja Bem vindo <?php echo $nomeLogado ?></strong> </h1>			      		
			      		<p> 
		      		</div> <!-- /widget-content -->
	      		</div> <!-- /widget -->
      		</div><!-- span 12 -->
            
            
    </div><!-- row -->  
    <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Últimos Produtos Cadastrados</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-auto table-striped table-bordered">
                <thead>
                  <tr>
                    <th> Codigo</th>
                    <th> Nome do Produto </th>
                    <th> Quantidade</th>
                    <th> Tipo</th>
										<th> Data Cadastro </th>
										<th> Fornecedor </th>
                  </tr>
                </thead>
                <tbody>
<?PHP
include("functions/limita-texto.php");
$select = "SELECT * from produtos ORDER BY id DESC LIMIT 5";
		
		try{
			$result = $conexao->prepare($select);			
			$result->execute();
			$contar = $result->rowCount();
			if($contar>0){
				while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>           
                  <tr>
                  	<td><?php echo $mostra->codproduto;?></td>
                    <td> <?php echo limitarTexto($mostra->descricao, $limite=200)?> </td>
                    <td> <?php echo $mostra->quantidade;?> </td>
										<td> <?php echo $mostra->tipo;?> </td>
										<td> <?php echo $mostra->data;?> </td>
										<td> <?php echo $mostra->nomefornecedor;?> </td>
                  </tr>
<?php
}				
			}else{
				echo '<div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Aviso!</strong> Não há produtos cadastrado em nosso banco de dados.
                </div>';
			}
			
		}catch(PDOException $e){
			echo $e;
		}
?>                  
     


                  
                
                </tbody>
              </table>
            </div>
            <!-- /widget-content --> 
          </div>
          <!-- /widget --> 
          
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
  <!-- Footer -->
 