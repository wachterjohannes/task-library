<?php

include_once __DIR__ . "/../bootstrap.php";

$gearmanClient = new GearmanClient();
$gearmanClient->addServer($this->host, $this->port);
$namingFactory = new \Tasks\NamingFactory();
$scheduler = new \Asapo\Tasks\Gearman\Scheduler($gearmanClient, $namingFactory);

echo('Result: ' . $scheduler->run(new \Tasks\Task('example.reverse', 'Hello!')));

$scheduler->schedule(new \Tasks\Task('example.reverse', 'Background ...'));

echo("\nEND ...\n");
