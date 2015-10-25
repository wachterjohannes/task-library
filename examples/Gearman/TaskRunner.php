<?php

include_once __DIR__ . "/../bootstrap.php";

$namingFactory = new \Tasks\NamingFactory();
$gearmanWorker = new GearmanWorker();
$gearmanWorker->addServer('127.0.0.1', 4730);
$workerManager = new \Asapo\Tasks\Gearman\TaskRunner($gearmanWorker, $namingFactory);

$workerManager->addWorker(new \ReverseWorker());
$workerManager->run();
