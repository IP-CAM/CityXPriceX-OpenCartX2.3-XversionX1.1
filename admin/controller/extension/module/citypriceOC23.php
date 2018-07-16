<?php
ini_set('display_errors',1);
error_reporting(E_ALL ^E_NOTICE);

class ControllerextensionmoduleCitypriceOC23 extends Controller {
 
 #TODO надо юзать эту таблицу для формирования строк во view
 #https://getbootstrap.com/docs/3.3/css/#tables-bordered
 
    public function index() {
        
        $this->load->language('extension/module/citypriceOC23');
        
        $this->document->addStyle('view/stylesheet/citypriceOC23.css');
        //$this->document->addScript('view/javascript/jquery/tabs.js');
        
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

        //используем ссылку в форме для импорта товара
        $data['action_import'] = $this->url->link('extension/module/citypriceOC23/getMethodImport', 'token=' . $this->session->data['token'], true);

        //используем ссылку в форме для загрузки картинок
        $data['action_get_images'] = $this->url->link('extension/module/citypriceOC23/downloadImage', 'token=' . $this->session->data['token'], true);

        //используем ссылку в форме для выгрузки заказов
        $data['action_get_orders'] = $this->url->link('extension/module/citypriceOC23/getOrders', 'token=' . $this->session->data['token'], true);
 
        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

       

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
}
?>