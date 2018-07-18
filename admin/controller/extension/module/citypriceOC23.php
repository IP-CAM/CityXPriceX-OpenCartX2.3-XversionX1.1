<?php
ini_set('display_errors',1);
error_reporting(E_ALL ^E_NOTICE);

class ControllerextensionmoduleCitypriceOC23 extends Controller {
    
    public function index() {
        
        $this->load->language('extension/module/citypriceOC23');
        
        $this->document->addStyle('view/stylesheet/jquery-ui.css');
        $this->document->addStyle('view/stylesheet/jquery.fancybox.min.css');
        $this->document->addScript('view/js/jquery.fancybox.min.js');
        $this->document->addScript('view/js/jquery-ui.js');


        $this->document->addStyle('view/stylesheet/citypriceOC23.css');
        $this->document->addStyle('view/stylesheet/form.css');
        $this->document->addScript('view/js/func.js');
        
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('extension/module');

        $this->load->model('setting/setting');
         
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('citypriceOC23', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)); 
            
        }

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['product_name'] = $this->language->get('product_name');
        $data['product_price'] = $this->language->get('product_price');
        $data['product_city'] = $this->language->get('product_city');
        $data['product_action'] = $this->language->get('product_action');

        $data['text_button_add'] = $this->language->get('text_button_add');
        $data['text_button_update'] = $this->language->get('text_button_update');
        $data['text_button_del'] = $this->language->get('text_button_del');
 
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        }
        else {
            $data['error_warning'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/citypriceOC23', 'token=' . $this->session->data['token'], true)
        );
        $data['token'] = $this->session->data['token'];

        $data['action'] = $this->url->link('extension/module/citypriceOC23', 'token=' . $this->session->data['token'], true);
 
        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

        //ссылка созданию строки в таблице
        $data['action_add'] = $this->url->link('extension/module/citypriceOC23/add', 'token=' . $this->session->data['token'], true);

        //ссылка редактированию строки в таблице
        $data['action_update'] = $this->url->link('extension/module/citypriceOC23/update', 'token=' . $this->session->data['token'], true);
 
        //ссылка по удалению строки в таблице
        $data['action_del'] = $this->url->link('extension/module/citypriceOC23/del', 'token=' . $this->session->data['token'], true);
 
        //содержим весь товар
        $data['products'] = $this->getProductPrice();
       

        //получаем доступ к модели модуля и создаем таблицы в базе
        $this->load->model('tool/citypriceOC23');
        $this->model_tool_citypriceOC23->createTables();
 
        // Группы
        $this->load->model('customer/customer_group');
        $data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();
 
        $this->template = 'extension/module/citypriceOC23.tpl';
        $this->children = array(
            'common/header',
            'common/footer' 
        );

        $url = "";
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        if (isset($this->request->get['page'])) {
            $url = '&page=' . $this->request->get['page'];
        }
 

        //выводим пагинацию
        $pagination = new Pagination();
        $pagination->total = (int)$this->model_tool_citypriceOC23->countProduct();
        $pagination->page = $page;
        $pagination->limit = 5;
        $pagination->url = $this->url->link('extension/module/citypriceOC23', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

        $data['pagination'] = $pagination->render();

        $data['heading_title'] = $this->language->get('heading_title');
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('extension/module/citypriceOC23.tpl', $data));

        //$this->response->setOutput($this->render(), $this->config->get('config_compression'));
    }

    private function validate() {

        if (!$this->user->hasPermission('modify', 'extension/module/citypriceOC23')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;

    }

    //Метод по созданию новой записи
    public function add(){
        $this->load->model('tool/citypriceOC23');
        
        //делаем проверку, что бы при добавлении новой строки были все данные
        if(!empty($_POST['product_name']) && !empty($_POST['product_price']) && !empty($_POST['product_city'])){
 
            $data = [
                'product_id' => $this->model_tool_citypriceOC23->FindProductID($_POST['product_name'])['product_id'],
                'city_id' => $this->model_tool_citypriceOC23->FindCityID($_POST['product_city'])['zone_id'],
                'price' => $_POST['product_price'],
            ];
            
            //заносим в базу только что полученные данные
            $this->model_tool_citypriceOC23->AddNew($data);

            //после добавления строки делаем редирект в сам модуль
            $this->response->redirect($this->url->link('extension/module/citypriceOC23','token=' . $this->session->data['token'] . '&type=module', true)); 
        
        }else{
            return false;
        }
 
    }


    //функция по редактированию записей
    public function update(){
        $this->load->model('tool/citypriceOC23');
        
        //делаем проверку, что бы при редактировании строки были все данные
        if(!empty($_POST['id']) && !empty($_POST['product_name']) && !empty($_POST['product_price']) && !empty($_POST['product_city'])){
 
            $data = [
                'id' => (int)$_POST['id'],
                'product_id' => $this->model_tool_citypriceOC23->FindProductID($_POST['product_name'])['product_id'],
                'city_id' => $this->model_tool_citypriceOC23->FindCityID($_POST['product_city'])['zone_id'],
                'price' => $_POST['product_price'],
            ];
            
            //заносим в базу только что полученные данные (редактирование)
            $this->model_tool_citypriceOC23->updateInfo($data);

            //после добавления строки делаем редирект в сам модуль
            $this->response->redirect($this->url->link('extension/module/citypriceOC23','token=' . $this->session->data['token'] . '&type=module', true)); 
        
        }else{
            return false;
        }

    }

    //метод по удалению строки
    public function del(){
        $this->load->model('tool/citypriceOC23');

        $id = (int)$_GET['id'];

        if(!empty($id)){
            $this->model_tool_citypriceOC23->delID($id);

            //делаем редирект в модуль
            $this->response->redirect($this->url->link('extension/module/citypriceOC23','token=' . $this->session->data['token'] . '&type=module', true)); 
        }

        return true;
    }

    //получаем весь список товара добавленого в таблицу oc_city_price и выводим во view
    public function getProductPrice(){
        $this->load->model('tool/citypriceOC23');

        $products = $this->model_tool_citypriceOC23->getAllProducts();
        $data = [];

        //формируем массив для отображения в view файле
        foreach($products as $product){
            $data[] = [
                'id' => $product['id'],
                'product_name' => $this->model_tool_citypriceOC23->FindProductName($product['product_id'])['name'],
                'product_price' => $product['price'],
                'product_city' => $this->model_tool_citypriceOC23->FindCityName($product['city_id'])['name'],
            ];
        }

         return $data;
    }

    //живой поиск по имени товара
    public function SearchLiveProduct(){
        $this->load->model('tool/citypriceOC23');
 
        $q = addslashes($_GET['q']);
        $products = $this->model_tool_citypriceOC23->FindLiveProduct($q);

        $mas = [];
        foreach($products as $product){
            $mas[] = $product['name'];
        }
            
        echo json_encode($mas);

        return true;
 
    }

    //живой поиск по имени города
    public function SearchLiveCity(){
        $this->load->model('tool/citypriceOC23');
 
        $q = addslashes($_GET['q']);
        $citys = $this->model_tool_citypriceOC23->FindLiveCity($q);

        $mas = [];
        foreach($citys as $city){
            $mas[] = $city['name'];
        }
            
        echo json_encode($mas);

        return true;
 
    }
 
}
?>