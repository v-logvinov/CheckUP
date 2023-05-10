<?php


namespace App;

use PDO;

class CheckUp
{
    private $connection;

    function __construct(string $dbdata, string $user, string $password)
    {
        $this->connection = new PDO($dbdata, $user, $password);
    }

    function index()
    {
        $command = "
        SELECT checkUp.name as name, SUM(analyzes.price) * (1-(checkUp.sale_procent * 0.01)) as checkUp_price, GROUP_CONCAT(TRIM(analyzes.name) SEPARATOR '|') `analizes`, checkUp.sale_procent  as sale, SUM(analyzes.price) as total_price, checkUp.image as img
        FROM checkUp
        INNER JOIN check_up_analyzes on checkUp.id = check_up_analyzes.check_up_id
        INNER JOIN analyzes on check_up_analyzes.analyzes_id = analyzes.id
        GROUP BY name;
        ";

        $state = $this->connection->prepare($command);

        $state->execute();

        $data = $state->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
}
