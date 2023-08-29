<?php include("includes/header.php");?>
<?php include("includes/topo.php");?>
</head>
<body >


<main>
	<?php

        if($nivelLogado ==0) {
            if($acao=='welcome' || $acao=='home') {
                include("pages/usuario.php");
            }

            // exibir produto
            if($acao=='ver-produto') {
                include("pages/ver-produto.php");
            }

            // exibir pedidos
            if($acao=='cad-novopedido') {
                include("pages/cad-novopedido.php");
            }

            // exibir pedidos
            if($acao=='ver-pedido') {
                include("pages/ver-pedido.php");
            }
        } elseif($nivelLogado ==1) {
            if(isset($_GET['acao'])) {
                $acao = $_GET['acao'];

                if($acao=='welcome' || $acao=='home') {
                    include("pages/inicio.php");
                }

                // cadastro produto
                if($acao=='cad-produto') {
                    include("pages/cad-produto.php");
                }

                // exibir produto
                if($acao=='ver-produto') {
                    include("pages/ver-produto.php");
                }

                // editar produto
                if($acao=='editar-produto') {
                    include("pages/edt-produto.php");
                }

                //cadastrar usuario
                if($acao=='cad-usuarios.php') {
                    include("pages/cad-usuarios.php");
                }



                //cadastrar fornecedores
                if($acao=='cad-fornecedores') {
                    include("pages/cad-fornecedores.php");
                }

                //exibir fornecedores
                if($acao=='ver-fornecedores') {
                    include("pages/ver-fornecedores.php");
                }

                //editar fornecedores
                if($acao=='edt-fornecedores') {
                    include("pages/edt-fornecedores.php");
                }



            } else {
                include("pages/inicio.php");
            }
        }
?>
</main>



<?php include("includes/footer.php");?>
</body>
</html>
