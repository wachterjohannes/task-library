<?php

include_once __DIR__ . "/../bootstrap.php";

class ReverseWorker implements \Tasks\WorkerInterface
{
    public function run(\Tasks\TaskInterface $task)
    {
        $workload = $task->getWorkload();
        $workload_size = strlen($workload);

        // This status loop is not needed, just showing how it works
        for ($x = 0; $x < $workload_size; $x++) {
            echo "Sending status: " . ($x + 1) . "/$workload_size complete\n";
            sleep(1);
        }

        $result = strrev($workload);
        echo "Result: $result\n";

        // Return what we want to send back to the client.
        return $result;
    }

    public function getNamespace()
    {
        return 'example';
    }

    public function getName()
    {
        return 'reverse';
    }
}

$namingFactory = new \Tasks\NamingFactory();
$workerManager = new \Asapo\Tasks\Gearman\WorkerManager($namingFactory);

$workerManager->addWorker(new ReverseWorker());
$workerManager->run();
