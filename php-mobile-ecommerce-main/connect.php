<?php




try{

    $dbServerName = 'localhost';
    $dbUserName = 'root';
    $dbPassword = '';
    $dbName = 'mobile';
    // set DSN (Data Source Name) :string has the associated data structure to describe a connection to the data source.
    $dsn = "mysql:host=$dbServerName;dbname=$dbName";
   
    // create PDO instance
    $pdo = new PDO($dsn,$dbUserName,$dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}

catch (PDOException $e){

    echo "Connection failed: " . $e->getMessage();
}

?>