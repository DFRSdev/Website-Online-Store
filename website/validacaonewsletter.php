<?php
	if(isset($_GET['email'])){
		$email=$_GET['email'];
		$update="update newsletter set subscricao=1 where email='".$email."'";

		$result=mysqli_query($ligax,$update);
		?>
	<script>
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
                                  "timeOut": "3000",
                                  "extendedTimeOut": "1000",
                                  "showEasing": "swing",
                                  "hideEasing": "linear",
                                  "showMethod": "show",
                                  "hideMethod": "fadeOut"
                            }

                        toastr["success"]("Confirmação realizada com sucesso. Obrigado por subscrever a newsletter!")
	</script>
	<?php
	}
	?>
