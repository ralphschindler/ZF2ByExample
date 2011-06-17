<?php

function _main_() {
    
    $config = new Zend\Config\Ini(__DIR__ . '/../config-mysqli.ini');
    
    $mysqliDbAdapter = new Zend\Db\Adapter($config->db->toArray());
    
    $stmt = $mysqliDbAdapter->query('SELECT * FROM artist');
    $result = $stmt->execute();
    foreach ($result as $rowData) {
        var_dump($rowData);
    }
}