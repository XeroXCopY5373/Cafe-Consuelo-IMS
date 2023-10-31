<?php
  $page_title = 'Home Page';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn()) { redirect('index.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
 <div class="col-md-12">
    <div class="panel">
      <div class="jumbotron text-center">
         <h1>Welcome to<hr>Cafe Consuelo Inventory Management System</h1>
         <p>You Don't Have a permission to check this</p>
      </div>
    </div>
 </div>
</div>
<?php include_once('layouts/footer.php'); ?>
