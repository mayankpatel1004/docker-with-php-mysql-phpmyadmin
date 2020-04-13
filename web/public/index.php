<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Docker</title>
    </head>
    <body>
        <h1>Docker Hello World 22</h1>
        <?php
            $servername = "mysql";
            $username = "root";
            $password = "root";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connected successfully";
                }
            catch(PDOException $e)
                {
                echo "Connection failed: " . $e->getMessage();
                }


                $stmt = $conn->prepare("SELECT * FROM idemo");
                $stmt->execute();
                // set the resulting array to associative
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                foreach($stmt->fetchAll() as $k=>$v) {
                    echo "<pre>";print_r($v);
                }
            ?>
    </body>
</html>
