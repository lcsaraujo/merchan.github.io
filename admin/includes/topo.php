<style>
  .logo{
    align-items: center !important;
    display: flex !important;
    justify-content: center !important;
  }
</style>
<nav class="navbar lg:menu-horizontal bg-base-300 text-base-content border-y-4 border-neutral"> 
    
      <ul class=" menu menu-horizontal text-base-content focus:text-base-content font-semibold">
        <li class="ms-10 justify-center lg:m-0 hover:border-b-2 hover:border-base-content"> <a href="home.php"><i class="fa fa-home"></i><span class="hidden md:block lg:block font-sans uppercase">Inicio</span> </a> </li>
          <li class="dropdown dropdown-hover justify-center lg:m-0 dropdown-end  mx-12 hover:border-b-2 hover:border-base-content "><a href="javascript:;"><i class="fa-solid fa-shop focus:text-base-content"></i> <span class="hidden md:block lg:block font-sans uppercase focus:text-base-content">Produtos</span> <b class="caret"></b></a>
            <ul class="menu dropdown-content mt-3 bg-base-300 rounded w-36 ">
              <li><a href="home.php?acao=ver-produto">Visualizar</a></li>
              <li><a href="home.php?acao=cad-produto">Cadastrar</a></li>
            </ul>
          </li>
          <li class="dropdown dropdown-hover justify-center lg:m-0 dropdown-end hover:border-b-2 hover:border-base-content"><a href="javascript:;"> <i class="fa-solid fa-truck-field"></i><span class="hidden md:block lg:block font-sans uppercase">Fornecedores</span> <b class="caret"></b></a>
            <ul class="menu dropdown-content mt-3 drop-shadow shadow-white bg-base-300 rounded w-36">
              <li><a href="home.php?acao=ver-fornecedores">Visualizar</a></li>
              <li><a href="home.php?acao=cad-fornecedores">Cadastrar</a></li>
            </ul>
          </li>
      </ul>    
</nav>

