<?php
//(SELECT b.copyid FROM (SELECT * FROM (SELECT * FROM CheckedOut ORDER BY checkoutDate DESC) a GROUP BY a.copyid) b WHERE b.status='holding' OR b.status='overdue')
  define("CHECKOUT_RECORD_SQL", "(SELECT * FROM (SELECT * FROM CheckedOut ORDER BY checkoutDate DESC) a GROUP BY a.copyid)");
  define("UNAVALABLE_COPY_SQL", "(SELECT b.copyid FROM " . CHECKOUT_RECORD_SQL . " b WHERE b.status='holding' OR b.status='overdue')");

  function find_all_available_books(){
    global $db;
    $sql = "SELECT * FROM Book NATURAL JOIN BookCopy WHERE copyid NOT IN " . UNAVALABLE_COPY_SQL;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }
  
  function find_available_books_by_keyword($keyword){
    global $db;
    $sql = "SELECT COUNT(*) copynum, bookid, booktitle, category, author, publishdate ";
    $sql .= "FROM Book NATURAL JOIN BookCopy ";
    $sql .= "WHERE copyid NOT IN " . UNAVALABLE_COPY_SQL . " AND (booktitle LIKE '%" . db_escape($db, $keyword) . "%' OR category LIKE '%" . db_escape($db, $keyword) . "%') ";
    $sql .= "GROUP BY bookid";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_available_copy_by_bookid($bookid){
    global $db;
    $sql = "SELECT copyid ";
    $sql .= "FROM BookCopy ";
    $sql .= "WHERE copyid NOT IN " . UNAVALABLE_COPY_SQL . " AND bookid='" . db_escape($db, $bookid) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }
  
  /* 
  function find_can_return_copy_by_mid($mid){
    global $db;
    $sql = "SELECT * ";
    $sql .= "FROM " . CHECKOUT_RECORD_SQL . " NATURAL JOIN BookCopy NATURAL JOIN Book";
    $sql .= "WHERE mid='" . $mid . "' AND (status='holding' OR status='overdue')";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }
  */

  function find_mid_checkout($mid){
    global $db;
    $sql = "SELECT * ";
    $sql .= "FROM " . CHECKOUT_RECORD_SQL . " b ";
    $sql .= "WHERE b.mid='" . db_escape($db, $mid) . "' AND (status='holding' OR status='overdue')";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_all_books() {
    global $db;
    $sql = "SELECT * FROM Book";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function insert_ckeckout($checkout) {
    global $db;
    $sql = "INSERT INTO CheckedOut ";
    $sql .= "(copyid, mid, checkoutDate, dueDate, status) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $checkout['copyid']) . "',";
    $sql .= "'" . db_escape($db, $checkout['mid']) . "',";
    $sql .= "now(), date_add(now(), interval 2 month),";
    $sql .= "'" . db_escape($db, $checkout['status']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function is_member($id){
    global $db;
    $sql = "SELECT * FROM Member ";
    $sql .= "WHERE mid='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    if (mysqli_num_rows($result)==0){
      return false;
    }else{
      return true;
    }
  }

  function find_book_by_keyword($keyword){
    global $db;
    $sql = "SELECT * FROM Book ";
    $sql .= "WHERE booktitle LIKE '%" . db_escape($db, $keyword) . "%' OR category LIKE '%" . db_escape($db, $keyword) . "%'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }
  
?>