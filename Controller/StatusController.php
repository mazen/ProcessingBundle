<?php
/*
 * This file is part of the Processing library.
 *
 * (c) Marcel Beerta <marcel@etcpasswd.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Processing\Bundle\ProcessingBundle\Controller;

use Processing\Processor;
use Symfony\Bundle\TwigBundle\TwigEngine;

/**
 * Controller for Status details of the processing queues
 *
 * @author Marcel Beerta <marcel@etcpasswd.de>
 */
class StatusController
{
    /**
     * @var \Processing\Processor
     */
    private $processor;

    /**
     * @var \Symfony\Bundle\TwigBundle\TwigEngine
     */
    private $templating;

    /**
     * @param \Processing\Processor                 $processor  Processor used for tasks
     * @param \Symfony\Bundle\TwigBundle\TwigEngine $templating Template engine
     */
    public function __construct(Processor $processor, TwigEngine $templating)
    {
        $this->processor  = $processor;
        $this->templating = $templating;
    }

    /**
     * Renders details of a queue including its jobs and arguments
     *
     * @param string $queue
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailsAction($queue)
    {
        return $this->templating->renderResponse('ProcessingBundle:Index:details.html.twig', array(
            'queue' => $this->processor->getJobs($queue)
        ));
    }

    /**
     * Display an overview page
     *
     * @return Response
     */
    public function indexAction()
    {
        return $this->templating->renderResponse('ProcessingBundle:Index:index.html.twig');
    }

    /**
     * Display sidebar with queues and their sizes
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sidebarAction()
    {
        return $this->templating->renderResponse('ProcessingBundle:Index:sidebar.html.twig', array(
            'queues' => $this->processor->listQueues()
        ));

    }

}
