<?php 
  require_once('../../private/initialize.php'); 

  $page_title = 'Book'; 
  $direction = 'Library Checkout System > Book'; 
  $page_header = 'Book Information'; 

  if(is_post_request()) {
    $member_id=isset($_POST['member_id'])?$_POST['member_id']:'NULL';
    $keyword=isset($_POST['keyword'])?$_POST['keyword']:'';
    if(!is_member($member_id)){
      redirect_to(url_for('/login_failure.php'));
    }
    $book_set = find_available_books_by_keyword($keyword);
  }else{
    redirect_to(url_for('/index.php'));
  }

?>

<?php include(SHARED_PATH . '/checkout_header.php'); ?>

<table class="mui-table mui-table--bordered" >
  <thead>
    <tr>     
      <th>BookID</th>
      <th>Title</th>
      <th>Category</th>
      <th>Author</th>
      <th>Publishdate</th>
      <th>CopyNum</th>
      <th>&nbsp;</th>
    </tr>
  </thead>

  <tbody>
    <?php while($book = mysqli_fetch_assoc($book_set)) { ?>
      <tr>
        <td><?php echo h($book['bookid']); ?></td>
        <td><?php echo h($book['booktitle']); ?></td>
        <td><?php echo h($book['category']); ?></td>
        <td><?php echo h($book['author']); ?></td>
        <td><?php echo h(substr($book['publishdate'],0,10)); ?></td>
        <td><?php echo h($book['copynum']); ?></td>
        
        <td>
          <a class="action" href="<?php echo url_for('/user_info/index.php?mid=' . h(u($member_id))) . '&bookid=' . h(u($book['bookid'])); ?>" >
            <button type="Search" class="mui-btn mui-btn--small mui-btn--flat">
              Checkout
            </button>
          </a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>


<br><br>
<?php include(SHARED_PATH . '/homepage_botton.php'); ?>

<?php include(SHARED_PATH . '/checkout_footer.php'); ?>
    