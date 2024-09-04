<html lang="es">

    <head>
        <title>Login</title>
        <?php require './headLogin.php'; ?>  
        <style>
            .form-signin {
                max-width: 400px;
                padding: 15px;
                margin: 0 auto;
            }

            .vertical-align{
                position: relative;
                top: 50%;
                transform: translateY(-50%);
            }

            .bglogin{
                background-color: #1f2d42;
            }
            .bgcontainer{
                background-color: white;
                padding: 40px 20px 40px 20px;
            }
        </style>
    </head>

    <body class="bglogin">
        <div class="site_wrapper">

            <section class="sec-padding">
                <div class="container smart-forms form-signin bgcontainer">
                    <form method="POST" action="log.php">
                        <div class="col-xs-12 text-center">
                            <h3 class="uppercase">Login</h3>
                            <div class="title-line-4 blue less-margin align-center"></div>

                        </div>
                        <div class="section">
                            <label class="field prepend-icon">
                                <input type="text" name="usuario" id="usuario" class="gui-input" placeholder="Ingrese su Usuario">
                                <span class="field-icon"><i class="glyphicon glyphicon-user"></i></span> </label>
                        </div>
                        <div class="section">
                            <label class="field prepend-icon">
                                <input type="password" name="password" id="password" class="gui-input" placeholder="Ingrese su Contraseña">
                                <span class="field-icon"><i class="glyphicon glyphicon-asterisk"></i></span> </label>
                        </div>

                        <button class="btn btn-blue col-lg-12" type="submit">Entrar</button>
                    </form>

                </div>
            </section>
            <!-- end section -->
        </div>
        <!-- end site wraper --> 
        <?php require 'footer.php' ?>

    </body>

</html>
