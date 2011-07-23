<?php

namespace My {

    class A
    {
        protected $params = null; 
        public function __construct($username, $password) { $this->params = $username . '/' . $password; }
        public function __toString() {
            return '    Class ' . get_class($this) 
                . ' with params: ' . $this->params . PHP_EOL;
        }
    }
    
    class B
    {
        protected $a = null;
        public function __construct(A $a) { $this->a = $a; }
        public function __toString() {
            return '    Class ' . get_class($this) . ' with hash ' . spl_object_hash($this)
                . PHP_EOL . '        with -> ' . $this->a->__toString();
        }
    }
    
    class C
    {
        protected $b = null;
        public function __construct(B $b) { $this->b = $b; }
        public function __toString() {
            return '    Class ' . get_class($this) . ' with hash ' . spl_object_hash($this) 
                . PHP_EOL . '        with -> ' . $this->b->__toString();
        }
    }
}



namespace {

    function _main_() {
        $di = new Zend\Di\DependencyInjector();
        $di->getInstanceManager()->setParameters(
            'My\A',
            array(
                'username' => 'foo',
                'password' => 'bar',
            )
        );
        $c = $di->get('My\C');
        echo $c;
        $d = $di->get('My\C');
        echo $d;
        echo PHP_EOL . PHP_EOL;
    }

}
