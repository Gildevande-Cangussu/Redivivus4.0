<?php

    require_once(__DIR__."/../vendor/autoload.php");
    use App\model\formulario;
    use App\pesistence\formularioDAO;
    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;


$db_host='aws.connect.psdb.cloud';
$db_name='bdredivivus';
$db_user='83xqsjjtbqei0o26axm3';
$db_password='pscale_pw_tE1vLnEq5OA6vGDNE3lxNl5M1busm9gxf5WRC6xTdef';

function get_connection($host, $dbname, $username, $password) {
    $dsn = "mysql:host=$host;dbname=$dbname; charset=utf8mb4";
    $options = [
        PDO::MYSQL_ATTR_SSL_CA => '../gilde/Download/cacert-2023-05-30.pem',
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
    ];
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $connection;
}

$db_conn= get_connection($db_host,$db_name,$db_user,$db_password);

var_dump($db_conn);