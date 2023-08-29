<?php
ob_start();
session_start();
if(isset($_SESSION['usuariowva']) && (isset($_SESSION['senhawva']))) {
    header("Location: admin/home.php");
    exit;
}
include("admin/conexao/conecta.php");
?>
<!DOCTYPE html>
<html lang="br">
  
<head>
    <meta charset="utf-8">
    <title>Login - CDE MERCHAN </title>
	<!-- <link href="https://cdn.jsdelivr.net/npm/daisyui@3.1.0/dist/full.css" rel="stylesheet" type="text/css" /> -->
	<link rel="stylesheet" href="admin/css/style.css">
	<link rel="stylesheet" href="node_modules/daisyui/dist/full.css">
	<link rel="stylesheet" href="admin/css/output.css">
	<script src="admin/css/teste.js"></script>
	<!-- <script src="https://cdn.tailwindcss.com"></script> -->
	<!-- <script src="https://kit.fontawesome.com/6f555f06ed.js" crossorigin="anonymous"></script> -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/theme-change@2.0.2/index.js"></script> -->
	<script src="admin/js/tailwind.config.js"></script>
	<script src="admin/js/style.js"></script>
</head>

<body  class="flex items-align justify-center overflow-hidden">
	<div class="flex flex-auto justify-center items-center container">
		<form class="text-center h-screen w-screen sm:h-full sm:w-full pt-32" action="#" method="post" enctype="multipart/form-data">
			<div class="flex flex-auto items-center mx-auto justify-center relative h-28 w-40">
				<img class="absolute top-0 right-0" src="admin/img/logo.png"></img>
			</div>
			
			<div class=" font-bold aliasing font-sans bg-clip-text text-transparent bg-gradient-to-r from-red-500 to-yellow-600 ">

					<h1 class="flex flex-auto items-center justify-center text-2xl uppercase prose-h1">controle de estoque</h1>
					<h1 class="flex flex-auto items-center justify-center text-4xl   uppercase prose">merchan matriz</h1>
				</div>

		<?php
            if(isset($_GET['acao'])) {

                if(!isset($_POST['logar'])) {

                    $acao = $_GET['acao'];
                    if($acao=='negado') {
                        echo '<div class="alert alert-error flex flex-auto justify-center mx-auto items-center w-80 py-2">
						<svg xmlns="http://www.w3.org/2000/svg" class=" stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
						<span>Erro! Você precisa estar logado para acessar o sistema.</span>
					</div>';
                    }
                }
            }
            // se clicar no botão entrar no sistema
?>	
			<?php
        if(isset($_POST['logar'])) {
            // RECUPERAR DADOS FORM
            $usuario = trim(strip_tags($_POST['usuario']));
            $senha	 = trim(strip_tags($_POST['senha']));

            // SELECIONAR BANCO DE DADOS

            $select = "SELECT * from login WHERE BINARY usuario=:usuario AND BINARY senha=:senha ";

            try {
                $result = $conexao->prepare($select);
                $result->bindParam(':usuario', $usuario, PDO::PARAM_STR);
                $result->bindParam(':senha', $senha, PDO::PARAM_STR);
                $result->execute();
                $contar = $result->rowCount();
                if($contar>0) {
                    $usuario = $_POST['usuario'];
                    $senha	 = $_POST['senha'];
                    $_SESSION['usuariowva'] = $usuario;
                    $_SESSION['senhawva'] = $senha;

                    echo '<div class="alert alert-success flex flex-auto justify-center mx-auto items-center w-80 py-2">
							<svg xmlns="http://www.w3.org/2000/svg" class=" stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
							<span>Logado com sucesso!</span>
						</div>';

                    header("Refresh: 1, admin/home.php?acao=welcome");
                } else {
                    echo '
					<div class="alert alert-error flex flex-auto justify-center mx-auto items-center w-80 py-2">
						<svg xmlns="http://www.w3.org/2000/svg" class=" stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
						<span>Erro! Usuario ou senha incorretos.</span>
					</div>';
                }

            } catch(PDOException $e) {
                echo $e;
            }



        }
?>

				<!--<span class="inline-block ps-12 px-32 border bg-red-400 "></span>-->
				<div class="py-8">
				<span>Usuario</span>
					<div class="mb-4 flex flex-auto justify-center ">
					
						<input type="text" id="username" name="usuario" value="" class="bg-white/0 hover:bg-white/0 px-16 mt-0 block rounded text-center apperance-none px-0.5  text-red-700 border-0 border-b-2 border-red-400 hover:border-b-4 focus:border-red-600 focus:outline-none" />
					</div> <!-- /field -->
					<span>Senha</span>
					<div class="mb-4 flex flex-auto justify-center">
						<input type="password" id="password" name="senha" value="" class="bg-white/0 px-16 mt-0 block rounded text-center apperance-none px-0.5  text-red-700 border-0 border-b-2 border-red-400 hover:border-b-4 focus:border-red-600 focus:outline-none"/>
					</div> <!-- /password -->
					
				</div> <!-- /login-fields -->
				
				<div class="w-full flex flex-auto items-center justify-center ">
										
					<button type="submit" name="logar" class="mb-32 py-4 px-14 text-white bg-red-600/40 hover:bg-red-700 text-xl font-sans hover:font-semibold rounded-full  ">Entrar no Sistema</button>
					
				</div> <!-- .actions -->
			</form>
			
		</div> <!-- /content -->
		
	</div> <!-- /account-container -->



</body>

</html>
