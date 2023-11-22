<?php
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass_encriptada = md5($pass);
    $procura = "SELECT * FROM users WHERE email='".$email."' AND pass='".$pass_encriptada."';";
    $result = mysqli_query($ligax, $procura);
    $nregistos = mysqli_num_rows($result);
    $registo = mysqli_fetch_assoc($result);

    if ($nregistos == 1) {
        $perfil = $registo['perfil'];

        if ($perfil == -1) { // the administrator deactivated the user's account
            echo '<script>
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "1200",
                    "hideDuration": "3000",
                    "timeOut": "3500",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "show",
                    "hideMethod": "fadeOut"
                };

                toastr["error"]("Por favor, entre em contato com o administrador", "Conta desativada");
            </script>';
        } elseif ($perfil == 0) { // the user is registered but hasn't activated their account yet
            echo '<script>
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "1200",
                    "hideDuration": "3000",
                    "timeOut": "3500",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "show",
                    "hideMethod": "fadeOut"
                };

                toastr["error"]("Ainda não ativou  a sua conta!");
            </script>';
        } else {
            $_SESSION["id"] = $registo["id"];
            $_SESSION["name"] = $registo["name"];
            $_SESSION["email"] = $registo["email"];
            $_SESSION["perfil"] = $registo["perfil"];

            echo '<script>
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "1200",
                    "hideDuration": "3000",
                    "timeOut": "3500",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "show",
                    "hideMethod": "fadeOut"
                };

                toastr["success"]("Conta iniciada com sucesso");


   
   
            </script>
            ';
        }
    } else {
        echo '<script>
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "1200",
                "hideDuration": "3000",
                "timeOut": "3500",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "show",
                "hideMethod": "fadeOut"
            };

            toastr["warning"]("Os dados estão incorretos");
        </script>';
    }
?>
