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
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $setting_module; ?></h3>
        </div>
        <div class="panel-body">
            <div id="tabs" class="htabs">
              <a href="#tab-setting"><?php echo $text_tab_setting; ?></a>  
              <a href="#tab-import"><?php echo $text_tab_import; ?></a>
              <a href="#tab-orders"><?php echo $text_tab_orders; ?></a>
              <a href="#tab-author"><?php echo $text_tab_author; ?></a>
            </div>
        </div>
         <div id="tab-setting">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-category" class="form-horizontal">
               <table class="form">
                    <tr>
                      <td><?php echo $entry_username; ?></td>
                      <td><input name="moyskladOC23Synch12_username" type="text" value="<?php echo $moyskladOC23Synch12_username; ?>" /></td>
                    </tr>
                    <tr>
                      <td><?php echo $entry_password; ?></td>
                      <td><input name="moyskladOC23Synch12_password" type="password" value="<?php echo $moyskladOC23Synch12_password; ?>" /></td>
                    </tr>
                    <tr>
                    <td><?php echo $entry_order_status_to_exchange; ?></td>
                    <td>
                      <select name="moyskladOC23Synch12_order_status_to_exchange">
                        <option value="0" <?php echo ($moyskladOC23Synch12_order_status_to_exchange == 0)? 'selected' : '' ;?>><?php echo $entry_order_status_to_exchange_not; ?></option>
                        <?php foreach ($order_statuses as $order_status) { ?>
                        <option value="<?php echo $order_status['order_status_id'];?>" <?php echo ($moyskladOC23Synch12_order_status_to_exchange == $order_status['order_status_id'])? 'selected' : '' ;?>><?php echo $order_status['name']; ?></option>
                        <?php } ?>
                      </select>
                    </td>
                    </tr>
               </table>   
            </form>
            
        </div>
        <div id="tab-import">
            <table>
              <tr>
                <td>
                  <form action="<?php echo $action_import; ?>" method="post" enctype="multipart/form-data"  class="form-inline">
                  <div class="form-group">
                    <span><?php echo $import_text; ?></span>
                  </div>
                <button type="submit" name="start" value="true" class="btn btn-primary importProduct" style="margin-left: 30px;" onclick="anime()"><?php echo $import_button; ?></button>
                </form>
                </td>
              </tr>
             <tr>
                <td>
               <form action="<?php echo $action_get_images; ?>" method="post" enctype="multipart/form-data" class="form-inline">
                <div class="form-group">
                <span style="margin-right: 30px;"><?php echo $download_image.": ". $count_image; ?></span>
                </div>
                <div class="form-group mx-sm-3">
                  <input type="text" name="count_images" class="form-control" value="0">
                </div>
                <button type="submit" class="btn btn-primary" style="margin-left: 30px;" onclick="anime()"><?php echo $download;?></button>
              </form>
              </td>
             </tr>    
          </table> 
            
            
        </div>
        <div id="tab-orders">
            <table>
              <tr>
                <td>
                  <form action="<?php echo $action_get_orders; ?>" method="post" enctype="multipart/form-data" class="form-inline">
                    <div class="form-group">
                    <span style="margin-right: 30px;"><?php echo $text_order; ?></span>
                    </div>
                    <button type="submit" name="get_orders" class="btn btn-primary" style="margin-left: 30px;" onclick="anime()"><?php echo $export_order;?></button>
                  </form>
                </td>
              </tr>
            </table>
        </div>
        <div id="tab-author">
            <table>
                 <tr>
                   <td><span style="color: black;margin-left: 30px;font-size: 25px;">
                           <a href="http://isyms.ru/">created by Artur Legusha</a>
                       </span></td>
                  </tr>
            </table>    
        </div>
    </div>
  </div>
   <!-- start animation loading !-->
        <div class="ball"></div>
        <div class="ball1"></div>
        <!-- end animation loading !-->
</div>

<script type="text/javascript"><!--
    $('#tabs a').tabs();
 //--></script>

 <script>
  //функция которая активирует анимацию загрузки
   function anime(){
     //вкл. анимацию загрузки
     $('.ball').css('display','block');
     $('.ball1').css('display','block');
  };
 </script>

<?php echo $footer; ?>