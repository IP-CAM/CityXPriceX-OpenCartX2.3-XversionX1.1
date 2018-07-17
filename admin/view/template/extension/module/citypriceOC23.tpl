<?php echo $header; ?><?php echo $column_left;
ini_set('display_errors',1);
error_reporting(E_ALL ^E_NOTICE);

?>
 
<div id="content" style="margin-left:50px;">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-category" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <div class="panel panel-default">
    </div>
    <div class="button_product_add">
       <a class="modalbox btn btn-success" href="#inline"><?= $text_button_add; ?></a>
    </div> 
    <div class="bs-example" data-example-id="bordered-table">
   <table class="table table-bordered">
      <thead>
         <tr>
            <th>№</th>
            <th><?= $product_name; ?></th>
            <th><?= $product_price; ?></th>
            <th><?= $product_city; ?></th>
            <th><?= $product_action; ?></th>
         </tr>
      </thead>
      <tbody>

      <?php !empty($products):?> 
        <?php foreach($products as $product):?>  
         <tr>
            <td><?=$product['id'];?></td>
            <td><?=$product['product_name'];?></td>
            <td><?=$product['product_price'];?></td>
            <td><?=$product['product_city'];?></td>
             <td>
              <div class="button_product_update">
                <button type="button" class="btn btn-primary"><?= $text_button_update; ?></button>
              </div>
              <div class="button_product_del">
                <button type="button" class="btn btn-danger"><?= $text_button_del; ?></button>
              </div>
            </td>
         </tr>
         <?php endforeach;?>
      <?php endif;?>   
      </tbody>
   </table>
</div>
  </div>
 </div>
 
 <div id="inline" style="display: none; cursor: auto;">
   <h2><?= $text_button_add; ?></h2>
  <div class="inner contact">
   <!-- Form Area -->
   <div class="contact-form">
      <!-- Form -->
      <form id="contact-us" method="post" action="<?= $action_add;?>">
         <!-- Left Inputs -->
         <div class="col-md-12 wow animated slideInLeft" data-wow-delay=".5s">
            <!-- product_name -->
            <input type="text" name="product_name" id="product_name" required="required" class="form" placeholder="<?= $product_name; ?>" />
            <!-- product_price -->
            <input type="text" name="product_price" id="product_price" required="required" class="form" placeholder="<?= $product_price; ?>" />
            <!-- product_city -->
            <input type="text" name="product_city" id="product_city" required="required" class="form" placeholder="<?= $product_city; ?>" />
         </div>
         <!-- End Left Inputs -->
        <!-- Bottom Submit -->
         <div class="relative fullwidth col-xs-12">
            <!-- Send Button -->
            <button type="submit" id="submit" name="submit" class="form-btn semibold"><?= $button_save; ?></button> 
         </div>
         <!-- End Bottom Submit -->
         <!-- Clear -->
         <div class="clear"></div>
      </form>
    </div>
   <!-- End Contact Form Area -->
</div>
<!-- End Inner -->
</div>


<?php #TODO тут раз написать функцию на php и просто сюда передавать параметры нужные для редактирования, а в цыкл передать вызов функции которая будет рендерить саму форму?>


<?php echo $footer; ?>