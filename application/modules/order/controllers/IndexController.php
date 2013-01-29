<?php
class Order_IndexController extends Custom_Base
{
    public function indexAction()
    {
        $form = new Order_Form_Order();
        if ($this->_request->isPost())
        {
            if ($form->isValid($this->_request->getPost()))
            {
                $model = new Order_Model_Order();
                if($model->create_order($this->_request->getPost())){ $this->view->translate = Custom_Base::translateAction();}
            }
        }
        $this->view->form = $form;
    }
    public function orderlistAction(){
        $translate = Custom_Base::translateAction();
        $model = new Order_Model_Order();
        $list = $model->order_list($this->_request->getParam("client"));
        if(count($list) > 0 ){
        $this->view->list = $list;
        }
        else {die ($translate->translate("have_no_orders"));}
    }
    public function countryAction(){
        $model = new Order_Model_Order();
        $countries =   $model->country_list();
        $this->view->countries = $countries;
    }
    public function orderscountryAction(){
        $model = new Order_Model_Order();
        $country =  $this->_request->getParam("country");
        $list = $model->orderscountry_list($country);
        $this->view->list = $list;
        $this->view->image = $this->flickrAction($country);

    }
    public function cityAction(){
        $model = new Order_Model_Order();
        $list = $model->ordercityes_list();
        $this->view->translate = Custom_Base::translateAction();
        $this->view->list = $list;
    }
    public function orderscityAction(){
        $model = new Order_Model_Order();
        $city = $this->_request->getParam("city");
        $list = $model->orderscity_list($city);
        $this->view->list = $list;
        $this->view->image = $this->flickrAction($city);
    }
    public function flickrAction($word){
        $config = Zend_Registry::get("config");
        $flickr = new Zend_Service_Flickr( $config->flickr->key);
        $results = $flickr->tagSearch($word);
        return $results->current()->Medium->uri;
    }
    public function twitterAction(){
        $word = $this->_request->getParam("word");
        $twitterSearch  = new Zend_Service_Twitter_Search('json');
        $searchResults  = $twitterSearch->search($word , array('lang' => 'en'));
        $this->view->list =  $searchResults["results"];
    }
    public function ebayAction(){
        $config = Zend_Registry::get("config");
        $ebay = new Zend_Service_Ebay_Finding( $config->ebay->key);
        $result =  $ebay->findItemsByKeywords( $word = $this->_request->getParam("word"));
        $list = array();
        $i = 0;
        foreach ($result->searchResult->item as $item) {
            $list[$i]["title"] = $item->title;
            $list[$i]["img"] = $item->galleryURL;
            $i++;
        }
        $this->view->list = $list;
}
}

