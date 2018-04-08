<?php 

  require_once('../../private/initialize.php'); 

  if(!isset($_GET['mid'])) {
    redirect_to(url_for('/index.php'));
  }
  if(!isset($_GET['bookid'])) {
    redirect_to(url_for('/book_info/index.php'));
  }

  $mid = $_GET['mid'];
  $bookid = $_GET['bookid'];
  $copyid_set = find_available_copy_by_bookid($bookid);
  $copyid = mysqli_fetch_assoc($copyid_set);
  $copyid = $copyid['copyid'];

  if ($copyid==''){
    redirect_to(url_for('/index.php'));
  }

  $checkout = [];
  $checkout['copyid'] = $copyid;
  $checkout['mid'] = $mid;
  $checkout['status'] = 'Holding';
  $r = insert_ckeckout($checkout);
  
  $page_title = 'User'; 
  $direction = 'Library Checkout System > User History'; 
  $page_header = 'Checkout History'; 
  $record_set = find_mid_checkout($mid);
?>

<?php include(SHARED_PATH . '/checkout_header.php'); ?>

<table class="mui-table mui-table--bordered" >
  <thead>
    <tr>     
      <th>CopyID</th>
      <th>CheckoutDate</th>
      <th>DueDate</th>
      <th>status</th>
    </tr>
  </thead>

  <tbody>
    <?php while($record = mysqli_fetch_assoc($record_set)) { ?>
      <tr>
        <td><?php echo h($record['copyid']); ?></td>
        <td><?php echo h(substr($record['checkoutDate'],0,10)); ?></td>
        <td><?php echo h(substr($record['dueDate'],0,10)); ?></td>
        <td><?php echo h($record['status']); ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>



<br><br>
<?php include(SHARED_PATH . '/homepage_botton.php'); ?>

<?php include(SHARED_PATH . '/checkout_footer.php'); ?>