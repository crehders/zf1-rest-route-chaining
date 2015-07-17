<?php

class Api_ApiController extends Zend_Rest_Controller
{

    public function init()
    {
        $this->setParam('time', date('Y-m-d H:i:s'));
    }

    public function indexAction()
    {
        $this->_helper->json($this->getAllParams());
    }

    public function getAction()
    {
        $this->_helper->json($this->getAllParams());
    }

    public function headAction()
    {
        $this->_helper->json($this->getAllParams());
    }

    public function postAction()
    {
        $this->_helper->json($this->getAllParams());
    }

    public function putAction()
    {
        $this->_helper->json($this->getAllParams());
    }

    public function deleteAction()
    {
        $this->_helper->json($this->getAllParams());
    }

}