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

/**
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

    public function __construct(\Processing\Processor $processor, \Symfony\Bundle\TwigBundle\TwigEngine $templating)
    {
        $this->processor  = $processor;
        $this->templating = $templating;
    }

    public function detailsAction($queue)
    {
        $details = $this->processor->getJobs($queue);

        return $this->templating->renderResponse('ProcessingBundle:Index:details.html.twig', array(
            'queue' => $details
        ));

    }


    /**
     * @return Response
     */
    public function indexAction()
    {
        return $this->templating->renderResponse('ProcessingBundle:Index:index.html.twig');
    }

    public function sidebarAction()
    {
        return $this->templating->renderResponse('ProcessingBundle:Index:sidebar.html.twig', array(
            'queues' => $this->processor->listQueues()
        ));

    }

}
