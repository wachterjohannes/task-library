<?php

namespace Tasks;

interface WorkerInterface
{
    public function run(TaskInterface $task);

    public function getNamespace();

    public function getName();
}
