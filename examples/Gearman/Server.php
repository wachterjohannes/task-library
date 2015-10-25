<?php

include_once __DIR__ . "/../bootstrap.php";

$namingFactory = new \Tasks\NamingFactory();
$workerManager = new \Asapo\Tasks\Gearman\WorkerManager($namingFactory);

$workerManager->addWorker(new \ReverseWorker());
$workerManager->run();
