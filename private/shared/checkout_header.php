
<?php
  if(!isset($page_title)) { $page_title = 'Title Area'; }
  if(!isset($direction)) { $direction = 'Direction Area'; }
  if(!isset($page_header)) { $page_header = 'Header Area'; }
?>

<!doctype html>

<html lang="en">
  <head>
    <title>LCS - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//cdn.muicss.com/mui-0.9.39-rc1/css/mui.min.css" rel="stylesheet" type="text/css" />
    <script src="//cdn.muicss.com/mui-0.9.39-rc1/js/mui.min.js"></script>
    <link href="<?php echo url_for('/stylesheets/checkout.css'); ?>"  rel="stylesheet" type="text/css" />
  </head>

  <body>
    <div 
      id = "app-bar" 
      class="mui--text-light mui--text-title mui--z1" 
      style="background-color:#8ba6ac;" 
      margin: "0 0 10px 0;"
    >
      <table width="100%">
        <tr style="vertical-align:middle;">
          <td class="mui--appbar-height">
            <?php echo h($direction); ?>
          </td>
        </tr>
      </table>
    </div>
    
    <div class="mui--text-center mui--text-dark-secondary mui--text-display2">
      <br>
      <header>
        <?php echo h($page_header); ?>
      </header>
    </div>

    <div id = "content-wrapper" >