<?php  
    function alertas ( $mensaje ) {
?>
<div class="alert alert-danger d-flex alert-dismissible align-items-center" role="alert">
  
        <?php echo $mensaje; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php } ?>  