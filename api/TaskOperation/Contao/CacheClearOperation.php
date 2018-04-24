<?php

namespace Contao\ManagerApi\TaskOperation\Contao;

use Contao\ManagerApi\Process\ConsoleProcessFactory;
use Contao\ManagerApi\Task\TaskStatus;
use Contao\ManagerApi\TaskOperation\AbstractProcessOperation;

class CacheClearOperation extends AbstractProcessOperation
{
    /**
     * Constructor.
     *
     * @param ConsoleProcessFactory $processFactory
     * @param string                $processId
     */
    public function __construct(ConsoleProcessFactory $processFactory, $processId = 'cache-clear')
    {
        try {
            parent::__construct($processFactory->restoreBackgroundProcess($processId));
        } catch (\Exception $e) {
            parent::__construct($processFactory->createContaoConsoleBackgroundProcess(['cache:clear', '--no-warmup'], $processId));
        }
    }

    public function updateStatus(TaskStatus $status)
    {
        $status->setSummary('Clearing application cache …');

        $this->addConsoleStatus($status);
    }
}
