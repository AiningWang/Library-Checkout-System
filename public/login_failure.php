<?php require_once('../private/initialize.php'); ?>

<?php 
  $page_title = 'Login'; 
  $direction = 'Library Checkout System > Login'; 
  $page_header = 'Opps..'; 
?>

<?php include(SHARED_PATH . '/checkout_header.php'); ?>

<div class="mui--text-center mui--text-dark-secondary mui--text-subhead">
  <br><br><br>
  <header>
    <?php echo 'Fail to log in.. Please enter member ID again.'; ?>
  </header>
</div>

<br><br><br><br><br><br>
<?php include(SHARED_PATH . '/homepage_botton.php'); ?>

<?php include(SHARED_PATH . '/checkout_footer.php'); ?>