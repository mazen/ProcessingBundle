<?php
/*
 * This file is part of the Processing library.
 *
 * (c) Marcel Beerta <marcel@etcpasswd.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Processing\Bundle\ProcessingBundle\Tests\Controller;

use Symfony\Component\DependencyInjection\ContainerBuilder,
Symfony\Component\HttpFoundation\ParameterBag;

use Processing\Bundle\ProcessingBundle\Controller\StatusController;

class StatusControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testDetailsAction()
    {
        $processor  = $this->getProcessor();
        $templating = $this->getTwigEngine();
        $controller = new StatusController($processor, $templating);

        $jobs = array(
            0 => array(
                'job'       => 'test',
                'arguments' => array()
            )
        );

        $processor
            ->expects($this->once())
            ->method('getJobs')
            ->with('test')
            ->will($this->returnValue($jobs));

        $templating
            ->expects($this->once())
            ->method('renderResponse')
            ->with('ProcessingBundle:Index:details.html.twig', array('queue' => $jobs));

        $controller->detailsAction('test');
    }

    public function testIndexAction()
    {
        $processor  = $this->getProcessor();
        $templating = $this->getTwigEngine();
        $controller = new StatusController($processor, $templating);
        $templating
            ->expects($this->once())
            ->method('renderResponse')
            ->with('ProcessingBundle:Index:index.html.twig', array());
        $controller->indexAction();
    }

    public function testSidebarAction()
    {
        $processor  = $this->getProcessor();
        $templating = $this->getTwigEngine();
        $controller = new StatusController($processor, $templating);

        $queue = array(
            'test' => 12,
        );

        $processor
            ->expects($this->once())
            ->method('listQueues')
            ->will($this->returnValue($queue));

        $templating
            ->expects($this->once())
            ->method('renderResponse')
            ->with('ProcessingBundle:Index:sidebar.html.twig', array('queues' => $queue));
        $controller->sidebarAction();
    }

    private function getTwigEngine()
    {
        return $this->getMock('Symfony\Bundle\TwigBundle\TwigEngine', array(), array(), '', false);
    }

    private function getProcessor()
    {
        return $processor = $this->getMock('Processing\Processor', array(), array(), '', false);
    }
}
