<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'Homepage'; ?>
<?php $direction = 'Library Checkout System'; ?>
<?php $page_header = 'Homepage'; ?>

<?php include(SHARED_PATH . '/checkout_header.php'); ?>

<br><br>

<form 
  class="mui-form" 
  action="<?php echo url_for('/book_info/index.php'); ?>" 
  method="post"
>
  
  <legend>Member ID</legend>
  <div class="mui-textfield">
    <input 
      type="text" 
      name="member_id"
      placeholder="Please input your ID" 
      value="<?php echo h($member_id); ?>"
    >
  </div>
    
  <br>

  <legend>Keyword</legend>
  <div class="mui-textfield">
    <input 
      type="text" 
      name="keyword"
      placeholder="Please input book title or category" 
      value="<?php echo h($keyword); ?>"
    >
  </div>

  <br><br>
        
  <div class="mui--text-center">
    <button type="submit" class="mui-btn mui-btn--raised" >
      Submit
    </button>
  </div>
  
</form>

<?php include(SHARED_PATH . '/checkout_footer.php'); ?>
    
