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
       <a class="modalbox btn btn-success" href="#form-add"><?= $text_button_add; ?></a>
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

      <?php if(!empty($products)):?> 
        <?php foreach($products as $product):?>  
         <tr>
            <td><?=$product_id_val = $product['id'];?></td>
            <td><?=$product_name_val = $product['product_name'];?></td>
            <td><?=$product_price_val = $product['product_price'];?></td>
            <td><?=$product_city_val = $product['product_city'];?></td>
             <td>
              <div class="button_product_update">
                <a class="modalbox btn btn-primary" onclick='form_update("<?=$product_id_val;?>","<?=$product_name_val;?>","<?=$product_price_val;?>","<?=$product_city_val;?>")' href="#form-update"><?= $text_button_update; ?></a>
              </div>
              <div class="button_product_del">
                 <a class="btn btn-danger button_del" href='<?=$action_del."&id=$product_id_val";?>'><?= $text_button_del; ?></a>
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
<div class="row">
  <div class="col-sm-6 text-right"><?php echo $pagination; ?></div>
</div>


<!-- Form Add !--> 
<div id="form-add" style="display: none; cursor: auto;">
   <h2><?= $text_button_add; ?></h2>
  <div class="inner contact">
   <!-- Form Area -->
   <div class="contact-form">
      <!-- Form -->
      <form id="contact-us-add" method="post" action="<?= $action_add;?>">
         <!-- Left Inputs -->
         <div class="col-md-12 wow animated slideInLeft" data-wow-delay=".5s">
            <!-- product_name -->
            <input type="text" name="product_name" id="product_name-add" required="required" class="form product_name_search" placeholder="<?= $product_name; ?>" />
            <!-- product_price -->
            <input type="text" name="product_price" id="product_price-add" required="required" class="form" placeholder="<?= $product_price; ?>" />
            <!-- product_city -->
            <input type="text" name="product_city" id="product_city-add" required="required" class="form product_city_search" placeholder="<?= $product_city; ?>" />
         </div>
         <!-- End Left Inputs -->
        <!-- Bottom Submit -->
         <div class="relative fullwidth col-xs-12">
            <!-- Send Button -->
            <button type="submit" id="submit-add" name="submit" class="form-btn semibold"><?= $button_save; ?></button> 
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



<!-- Form Update !-->
<div id="form-update" style="display: none; cursor: auto;">
   <h2><?= $text_button_update; ?> № <span class="update_id"></span></h2>
  <div class="inner contact">
   <!-- Form Area -->
   <div class="contact-form">
      <!-- Form -->
      <form id="contact-us-update" method="post" action="<?= $action_update;?>">
         <!-- Left Inputs -->
         <div class="col-md-12 wow animated slideInLeft" data-wow-delay=".5s">
            <!-- product_id -->
            <input type="hidden" name="id" id="product_id-update" class="form" />
            <!-- product_name -->
            <input type="text" name="product_name" id="product_name-update" required="required" class="form product_name_search" placeholder="<?= $product_name; ?>" />
            <!-- product_price -->
            <input type="text" name="product_price" id="product_price-update" required="required" class="form" placeholder="<?= $product_price; ?>" />
            <!-- product_city -->
            <input type="text" name="product_city" id="product_city-update" required="required" class="form product_city_search" placeholder="<?= $product_city; ?>" />
         </div>
         <!-- End Left Inputs -->
        <!-- Bottom Submit -->
         <div class="relative fullwidth col-xs-12">
            <!-- Send Button -->
            <button type="submit" id="submit-update" name="submit" class="form-btn semibold"><?= $button_save; ?></button> 
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
 
<script>
  $(document).ready(function() {
   //подключаем плагин fancybox 
   $(".modalbox").fancybox();

  //живой поиск товара
  $( ".product_name_search" ).autocomplete({
      source: function( request, response ) {
        $.ajax({
          url: "index.php?route=extension/module/citypriceOC23/SearchLiveProduct&token=<?=$_GET['token'];?>",
          dataType: "json",
          data: {
            q: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
    },
  });

  //живой поиск города
  $( ".product_city_search" ).autocomplete({
      source: function( request, response ) {
        $.ajax({
          url: "index.php?route=extension/module/citypriceOC23/SearchLiveCity&token=<?=$_GET['token'];?>",
          dataType: "json",
          data: {
            q: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
    },
  });
 
});
</script>

<?php echo $footer; ?>