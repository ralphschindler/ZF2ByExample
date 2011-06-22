<?php

function _main_() {
    
    
    $config = new Zend\Config\Ini(__DIR__ . '/../config-pdo-sqlsrv.ini');
    
    try {
        
        $sqlsrvDbAdapter = new Zend\Db\Adapter($config->db->toArray());
        
        $stmt = $sqlsrvDbAdapter->query('SELECT * FROM artist');
        $result = $stmt->execute();
        foreach ($result as $rowData) {
            var_dump($rowData);
        }
    } catch (Exception $e) {
        var_dump($e);
    }
}
