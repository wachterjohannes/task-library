<?php

namespace Tasks;

interface TaskInterface
{
    public function getWorkerName();

    public function getWorkload();
}
