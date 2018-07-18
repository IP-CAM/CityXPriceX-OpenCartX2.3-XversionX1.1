$(document).ready(function() {
   //подключаем плагин fancybox	
   $(".modalbox").fancybox();

   /*По клику вызываем окно которое подтверждает удаление*/
    $('.button_del').click(function(){
        if (confirm("Вы подтверждаете удаление?")) {

            return true;

        } else {

            return false;

        }

    });

});

//функция которая подставляет нужные данные в форму form-update
function form_update(id,product_name,product_price,product_city){
	$("#form-update .update_id").text(id);
	$("#form-update #product_id-update").val(id);
	$("#form-update #product_name-update").val(product_name);
   	$("#form-update #product_price-update").val(product_price);
   	$("#form-update #product_city-update").val(product_city);
}