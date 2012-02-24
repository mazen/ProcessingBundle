<?php
/*
 * This file is part of the Processing library.
 *
 * (c) Marcel Beerta <marcel@etcpasswd.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Processing\Bundle\ProcessingBundle\DataCollector;

use Symfony\Component\HttpKernel\DataCollector\DataCollector,
Symfony\Component\HttpFoundation\Request,
Symfony\Component\HttpFoundation\Response;

class ProcessingDataCollector extends DataCollector
{
    protected $processor;

    public function __construct(\Processing\Processor $processor)
    {
        $this->processor = $processor;
    }

    public function getQueue()
    {
        return $this->data['queues'];
    }

    public function getQueueSize()
    {
        return array_sum($this->data['queues']);
    }

    public function getItems()
    {
        return $this->data['jobs'];
    }

    /**
     * Collects data for the given Request and Response.
     *
     * @param Request    $request   A Request instance
     * @param Response   $response  A Response instance
     * @param \Exception $exception An Exception instance
     *
     * @api
     */
    function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data['queues'] = $this->processor->listQueues();
        foreach ($this->data['queues'] as $queue => $size) {
            $this->data['jobs'][$queue] = $this->processor->getJobs($queue);
        }
    }

    /**
     * Returns the name of the collector.
     *
     * @return string The collector name
     *
     * @api
     */
    function getName()
    {
        return 'processing';
    }

}
