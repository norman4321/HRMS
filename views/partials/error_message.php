<?php if (!empty($error_message)) : ?>
    <div class="alert alert-danger alert-dismissible fade show mb-3">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error! </strong> <?php echo $error_message; ?>
    </div>
<?php endif; ?>