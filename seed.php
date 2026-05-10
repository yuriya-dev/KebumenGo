<?php
require_once __DIR__ . '/app/helpers/functions.php';

try {
    $db = getDB();
    $result = $db->query("SHOW TABLES LIKE 'destinations'")->fetch();
    
    if (!$result) {
        echo "Tables do not exist. Running kebumengo.sql...\n";
        $sql = file_get_contents(__DIR__ . '/database/kebumengo.sql');
        $db->exec($sql);
        echo "Database seeded successfully.\n";
    } else {
        echo "Tables already exist.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
