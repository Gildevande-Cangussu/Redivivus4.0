<?php
$db_host = 'aws.connect.psdb.cloud';
$db_name = 'bdredivivus';
$db_user = '83xqsjjtbqei0o26axm3';
$db_password = 'pscale_pw_tE1vLnEq5OA6vGDNE3lxNl5M1busm9gxf5WRC6xTdef';

function get_connection($host, $dbname, $username, $password)
{
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::MYSQL_ATTR_SSL_CA => "../model/cacert-2023-05-30.pem",
    ];
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $connection;
}

try {
    $db_conn = get_connection($db_host, $db_name, $db_user, $db_password);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se os campos obrigatórios foram preenchidos
        if (empty($_POST['star']) || empty($_POST['comment']) || empty($_POST['name'])) {
            $errorMessage = "Por favor, preencha todos os campos obrigatórios.";
        } else {
            // Recupera os dados do formulário
            $star = $_POST['star'];
            $comment = $_POST['comment'];
            $name = $_POST['name'];

            // Prepara a consulta SQL
            $sql = "INSERT INTO Avaliacao (estrelas, comentario, nome_usuario, data_publicacao) 
                    VALUES (:estrelas, :comentario, :nome_usuario, NOW())";
            $stmt = $db_conn->prepare($sql);

            // Executa a consulta
            $stmt->execute([
                ':estrelas' => $star,
                ':comentario' => $comment,
                ':nome_usuario' => $name
            ]);

            $successMessage = "Avaliação salva com sucesso!";
        }
    }

    var_dump($db_conn);
} catch (PDOException $e) {
    $errorMessage = "Erro ao salvar a avaliação: " . $e->getMessage();
}
?>
