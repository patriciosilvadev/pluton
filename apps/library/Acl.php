<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - beforeExecuteRoute()
* Classes list:
* - Acl extends \
*/
use \Phalcon\Events\Event;
use \Phalcon\Mvc\Dispatcher;

class Acl extends \Phalcon\Mvc\User\Component {

    protected $_module;

    public function __construct($module) {
        $this->_module = $module;
    }

    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher) {

    }
}
