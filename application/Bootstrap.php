<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initRoutes()
    {
        $frontController = Zend_Controller_Front::getInstance();
        /* @var $router Zend_Controller_Router_Rewrite */
        $router = $frontController->getRouter();

        $restRoute = new Zend_Rest_Route(
            $frontController,
            array(),
            array(
                'api' => array('api')
            )
        );

        $defaultRoute = new Zend_Controller_Router_Route_Static(
            '/',
            array(
                'module' => 'default',
                'controller' => 'index',
                'action' => 'index',
            )
        );

        $flexRoute = new Zend_Controller_Router_Route(
            ':module/:controller/:action/:input',
            array(
                'action' => 'index',
                'input' => 'test',
            )
        );

        $langRoute = new Zend_Controller_Router_Route_Regex(
            '(\w{2})',
            array(
                'lang' => 'en',
            ),
            array(
                '1' => 'lang',
            )
        );

        $apiRoute = new Zend_Controller_Router_Route(
            'rest',
            array(
                'module' => 'api',
                'controller' => 'api',
            )
        );


        // / -> default/index/index
        $router->addRoute('default', $defaultRoute);

        // /en -> default/index/index, lang=en
        $router->addRoute('langdefault', $langRoute->chain($defaultRoute));

        // /default/index -> default/index/index, input=test
        $router->addRoute('flex', $flexRoute);

        // /en/default/index -> default/index/index, input=test, lang=en
        $router->addRoute('langflex', $langRoute->chain($flexRoute));

        // /api/api -> /api/api (restful)
        $router->addRoute('api', $restRoute);

        // /en/api/api -> /api/api, lang=en (restful)
        $router->addRoute('langapi', $langRoute->chain($restRoute));

        // before fix: /rest -> rest (rest not found)
        // after fix: /rest -> api/api (restful)
        // before fix: /rest/test -> rest/test (using flexRoute, route overlay)
        // after fix: /rest/test -> api/api, id=test (restful)
        $router->addRoute('restapi', $apiRoute->chain($restRoute));

        // before fix: /en/rest -> en/rest (rest not found, using flexRoute, route overlay)
        // after fix: /en/rest -> api/api, lang=en (restful)
        // before fix: /en/rest/test -> en/rest/test (rest not found, using flexRoute, route overlay)
        // after fix: /en/rest/test -> api/api, lang=en, id=test
        $router->addRoute('langrestapi', $langRoute->chain($apiRoute)->chain($restRoute));

    }

}

