<?php

include_once __DIR__ . "/../bootstrap.php";

$namingFactory = new \Tasks\NamingFactory();
$scheduler = new \Asapo\Tasks\Gearman\Scheduler($namingFactory);

echo('Result: ' . $scheduler->run(new \Tasks\Task('example.reverse', 'Hello!')));

$scheduler->schedule(new \Tasks\Task('example.reverse', 'Background ...'));

echo("\nEND ...\n");
