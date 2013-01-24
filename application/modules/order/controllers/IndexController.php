<?php
require_once APPLICATION_PATH."/modules/default/controllers/IndexController.php";
class Order_IndexController extends Default_IndexController
{
    public function indexAction()
    {
        $form = new Order_Form_Order();
        if ($this->_request->isPost())
        {
            if ($form->isValid($this->_request->getPost()))
            {
                $model = new Order_Model_Order();
                if($model->create_order($this->_request->getPost())){ $this->view->translate = Default_IndexController::translateAction();}
            }
        }
        $this->view->form = $form;
    }
    public function orderlistAction(){
        $translate = Default_IndexController::translateAction();
        $this->_helper->layout()->disableLayout();
        $model = new Order_Model_Order();
        $list = $model->order_list($this->_request->getParam("client"));
        if(count($list) > 0 ){
            $this->view->translate = Default_IndexController::translateAction();
        $this->view->list = $list;
        }
        else {die ($translate->translate("have_no_orders"));}
    }
    public function countryAction(){
        $model = new Order_Model_Order();
        $countries =   $model->country_list();
        $this->view->translate = Default_IndexController::translateAction();
        $this->view->countries = $countries;
    }
    public function orderscountryAction(){
        $this->_helper->layout()->disableLayout();
        $model = new Order_Model_Order();
        $country =  $this->_request->getParam("country");
        $list = $model->orderscountry_list($country);
        $this->view->translate = Default_IndexController::translateAction();
        $this->view->list = $list;
        $this->view->image = $this->flickrAction($country);

    }
    public function cityAction(){
        $model = new Order_Model_Order();
        $list = $model->ordercityes_list();
        $this->view->translate = Default_IndexController::translateAction();
        $this->view->list = $list;
    }
    public function orderscityAction(){
        $this->_helper->layout()->disableLayout();
        $model = new Order_Model_Order();
        $city = $this->_request->getParam("city");
        $list = $model->orderscity_list($city);
        $this->view->translate = Default_IndexController::translateAction();
        $this->view->list = $list;
        $this->view->image = $this->flickrAction($city);
    }
    public function flickrAction($word){

        $flickr = new Zend_Service_Flickr('942ee295f63f996a37e6eb132fd91a71');
        $results = $flickr->tagSearch($word);
        return $results->current()->Medium->uri;


    }
    public function twitterAction(){
        $this->_helper->layout()->disableLayout();
        $word = $this->_request->getParam("word");
        $twitterSearch  = new Zend_Service_Twitter_Search('json');
        $searchResults  = $twitterSearch->search($word , array('lang' => 'en'));
        $this->view->list =  $searchResults["results"];

    }
    public function ebayAction(){
        $this->_helper->layout()->disableLayout();
        $ebay = new Zend_Service_Ebay_Finding("home0a748-f0bf-4780-8e75-6072192de85");
       $result =  $ebay->findItemsByKeywords( $word = $this->_request->getParam("word"));
        $list = array();
        for($i = 0;$i < 10 ; $i++) {
            $list[$i]["title"] =  $result->searchResult->item->current()->title;
            $list[$i]["img"] =  $result->searchResult->item->current()->galleryURL;
            $result->searchResult->item->next();
        }
        $this->view->list = $list;
}
}

