               </section>

               <div id="footer" class="container"></div>


             </section>

           </div>

           <!-- ============ JS FILES ============ --> 
           
           <script src="js/jquery.min.js"></script>
           <script src="js/bootstrap.min.js"></script>
           <script src="admin/js/adminlte.min.js"></script>
           <!--TEMPLATE JavaScript -->
           <script src="admin/js/app.min.js"></script>
           <!-- AdminLTE for demo purposes -->
           <script src="admin/js/demo.js"></script>

           <script src="js/jquery-ui.min.js"></script>
           <script src="js/zebra_datepicker.min.js"></script>
           <script src="js/chosen.jquery.min.js"></script>
           <script type="text/javascript" src="js/select2.min.js"></script>
           <script src="js/sweetalert2.all.js"></script> 
           <script type="text/javascript" src="js/highcharts.js"></script><script type="text/javascript" src="js/exporting.js"></script> 
           <!-- DataTables -->
           <script type="text/javascript" charset="utf8" src="js/jquery.dataTables.js"></script>
           <!-- DataTables Plugin -->
           <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css">
           <script type="text/javascript" charset="utf8" src="js/dataTables.bootstrap.js"></script>


           <script type="text/javascript">
            $('form').submit(function(e){

              $('button[type=submit], input[type=submit]').prop('disabled',true);
              return true;
            })
            $(document).ready(function() { 
              $(".select2").select2(); 
            });
          </script>
        </body>

        </html>
        <?php

        if (isset($_GET['estado'])) {
          if ($_GET['estado'] == 'logout') {
            if (isset($_SESSION['estado'])) {
              unset($_SESSION['estado']);
              unset($_SESSION['usuario']);
              unset($_SESSION['password']);
            }
          } else if ($_GET['estado'] == "nousuario") {
            echo "<script> swal(
              'Error!',
              'El usuario no existe',
              'error'
            ) </script>";
          } else if ($_GET['estado'] == "contra") {
            echo "<script> swal(
              'Error!',
              'El usuario y contraseña no coinciden!',
              'error'
            ) </script>";
          } else if ($_GET['estado'] == "guardado") {
            echo "<script> swal(
              'Perfecto!',
              'Tus datos han sido guardados!',
              'success'
            ) </script>";
          } else if ($_GET['estado'] == "error") {
            echo "<script> swal(
              'Advertencia!',
              'Revise el formato del archivo, debe ser exel 97-2003!',
              'warning'
            ) </script>";
          }
        }