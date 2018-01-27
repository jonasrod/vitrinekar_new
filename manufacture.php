<?php
require_once "bootstrap.php";


$manufacture = $entityManager->getRepository("entities\Entitie");

echo '<pre>';
print_r($manufacture);