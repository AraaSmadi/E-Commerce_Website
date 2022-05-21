<?php
$user="root" ;
$pass= '' ;

try 
{
    $con = new PDO ('mysql:host=localhost;dbname=mobile' , $user, $pass );
    
}
catch (PDOException $e){
    echo "Faild"  . $e->getMessage() . "<br/>";
}

?>