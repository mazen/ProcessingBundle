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

use Processing\Processor;

/**
 * Data collector to fetch queue information from the processing library
 *
 * @author Marcel Beerta <marcel@etcpasswd.de>
 */
class ProcessingDataCollector extends DataCollector
{
    /**
     * Processor instance
     *
     * @var \Processing\Processor
     */
    protected $processor;

    /**
     * @param \Processing\Processor $processor
     */
    public function __construct(Processor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * Return details about a queue
     *
     * @return mixed
     */
    public function getQueue()
    {
        return $this->data['queues'];
    }

    /**
     * Return the size of a given queue
     *
     * @return number
     */
    public function getQueueSize()
    {
        return array_sum($this->data['queues']);
    }

    /**
     * Returns a list of items within all queues
     *
     * @return mixed
     */
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
