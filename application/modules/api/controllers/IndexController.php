<?php

class Api_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $this->setParam('time', date('Y-m-d H:i:s'));
    }

    public function indexAction()
    {
        $this->_helper->json($this->getAllParams());
    }

    public function postAction()
    {
        $this->_helper->json($this->getAllParams());
    }

}

