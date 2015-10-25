<?php

include_once __DIR__ . "/../bootstrap.php";

$namingFactory = new \Tasks\NamingFactory();
$workerManager = new \Asapo\Tasks\InMemory\TaskRunner($namingFactory);
$scheduler = new \Asapo\Tasks\InMemory\Scheduler($workerManager);

$workerManager->addWorker(new ReverseWorker());

echo('Result: ' . $scheduler->run(new \Tasks\Task('example.reverse', 'Hello!')));

$scheduler->schedule(new \Tasks\Task('example.reverse', 'Background ...'));

echo("\nEND ...\n");

$workerManager->run();
