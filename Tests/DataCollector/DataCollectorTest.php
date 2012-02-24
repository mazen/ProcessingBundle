<?php
/*
 * This file is part of the Processing library.
 *
 * (c) Marcel Beerta <marcel@etcpasswd.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Processing\Bundle\ProcessingBundle\Tests\DataCollector;

use Processing\Bundle\ProcessingBundle\DataCollector\ProcessingDataCollector;

use Symfony\Component\HttpFoundation\Request,
Symfony\Component\HttpFoundation\Response;

/**
 * @author Marcel Beerta <marcel@etcpasswd.de>
 */
class DataCollectorTest extends \PHPUnit_Framework_TestCase
{

    public function testCollect()
    {
        $queues = array('test' => 1);
        $jobs = array(
            0 => array(
                'job' => 'foo',
                'arguments' => array()
            )
        );

        $processor = $this->getProcessor();
        $processor
            ->expects($this->once())
            ->method('listQueues')
            ->will($this->returnValue($queues));

        $processor -> expects($this->once())
            ->method('getJobs')
            ->with('test')
            ->will($this->returnValue($jobs));

        $collector = new ProcessingDataCollector($processor);

        $this->assertEquals('processing', $collector->getName());

        $collector->collect(new Request(), new Response());

        $this->assertEquals($queues, $collector->getQueue());
        $this->assertEquals(1, $collector->getQueueSize());
        $this->assertEquals(array('test' => $jobs), $collector->getItems());
    }

    private function getProcessor()
    {
        return $this->getMock('Processing\Processor', array(), array(), '', false);
    }

}
