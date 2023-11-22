<?php
	if(isset($_GET['codigo'])){
		$id=$_GET['codigo'];
		$update="update users set perfil=1,estado=1 where id='".$id."'";

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
    "hideDuration": "5000", // Alteração para 5000
    "timeOut": "5000", // Alteração para 5000
    "extendedTimeOut": "5000", // Alteração para 5000
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "show",
    "hideMethod": "fadeOut"
}

toastr["success"]("Confirmação realizada com sucesso. Efetue login!");

		
	</script>
	<?php
	}
	?>
