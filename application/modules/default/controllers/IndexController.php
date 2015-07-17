<?php

class Default_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $this->setParam('time', date('Y-m-d H:i:s'));
    }

    public function indexAction()
    {

        $this->view->assign(
            'examples',
            array(
                array(
                    'code' => '$router->addRoute(\'flex\', $defaultRoute);',
                    'url' => '/default/index/test',
                ),
                array(
                    'code' => '$router->addRoute(\'langflex\', $langRoute->chain($defaultRoute));',
                    'url' => '/en/default/index/test',
                ),
                array(
                    'code' => '$router->addRoute(\'api\', $restRoute);',
                    'url' => '/api/api',
                ),
                array(
                    'code' => '$router->addRoute(\'langapi\', $langRoute->chain($restRoute));',
                    'url' => '/en/api/api',
                ),
                array(
                    'code' => '(fixed) $router->addRoute(\'restapi\', $apiRoute->chain($restRoute));',
                    'url' => '/rest/test',
                ),
                array(
                    'code' => '(fixed) $router->addRoute(\'langrestapi\', $langRoute->chain($apiRoute)->chain($restRoute));',
                    'url' => '/en/rest/test',
                ),
            )
        );
    }

    public function testAction()
    {
        $this->_helper->json($this->getAllParams());
    }

}

