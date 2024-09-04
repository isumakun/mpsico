<ul class="sidebar-menu">
    	<li class="header">Menú</li>
        
        <?php if (validarAdmin()) { ?>
        <li class="menulink"><a href="index.php">
            <i class="fa fa-home"></i> <span>Inicio</span>
        </a></li>

        <li class="menulink">
            <a href="empresas.php">
        		<i class="fa fa-home"></i> <span>Empresas</span>
        	</a>
        </li>

        <li class="menulink">
            <a href="aspirantes.php">
        		<i class="fa fa-users"></i> <span>Aspirantes</span>
        	</a>
        </li>

        <li class="menulink">
            <a href="informes.php">
        		<i class="fa fa-table"></i> <span>Informes</span>
        	</a>
        </li>

        <li class="menulink">
            <a href="configurarPruebas.php">
        		<i class="fa fa-home"></i> <span>Pruebas</span>
        	</a>
        </li>
        <?php }else{ ?>

        <li class="menulink">
            <a href="pruebas.php">
                <i class="fa fa-home"></i> <span>Pruebas</span>
            </a>
        </li>

        <?php } ?>
        
</ul>