<?php

/** @namespace */
namespace My;

class DiDefinition extends \Zend\Di\Definition\ArrayDefinition
{

    public function __construct()
    {
        parent::__construct(array (
          'My\\DbAdapter' => 
          array (
            'superTypes' => 
            array (
            ),
            'instantiator' => '__construct',
            'injectionMethods' => 
            array (
              '__construct' => 
              array (
                'username' => NULL,
                'password' => NULL,
              ),
            ),
          ),
          'My\\Definition' => 
          array (
            'superTypes' => 
            array (
              0 => 'Zend\\Di\\Definition\\ArrayDefinition',
            ),
            'instantiator' => '__construct',
            'injectionMethods' => 
            array (
            ),
          ),
          'My\\EntityA' => 
          array (
            'superTypes' => 
            array (
            ),
            'instantiator' => NULL,
            'injectionMethods' => 
            array (
            ),
          ),
          'My\\Mapper' => 
          array (
            'superTypes' => 
            array (
            ),
            'instantiator' => '__construct',
            'injectionMethods' => 
            array (
              'setDbAdapter' => 
              array (
                'dbAdapter' => 'My\\DbAdapter',
              ),
            ),
          ),
          'My\\RepositoryA' => 
          array (
            'superTypes' => 
            array (
            ),
            'instantiator' => '__construct',
            'injectionMethods' => 
            array (
              'setMapper' => 
              array (
                'mapper' => 'My\\Mapper',
              ),
            ),
          ),
          'My\\RepositoryB' => 
          array (
            'superTypes' => 
            array (
              0 => 'RepositoryA',
            ),
            'instantiator' => NULL,
            'injectionMethods' => 
            array (
            ),
          ),
        ));
    }


}

