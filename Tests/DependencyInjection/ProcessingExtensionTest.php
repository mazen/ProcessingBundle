<?php
/*
 * This file is part of the Processing library.
 *
 * (c) Marcel Beerta <marcel@etcpasswd.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Processing\Bundle\ProcessingBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

use Processing\Bundle\ProcessingBundle\DependencyInjection\ProcessingExtension;

/**
 * @author Marcel Beerta <marcel@etcpasswd.de>
 */
class ProcessingExtensionTest extends \PHPUnit_Framework_TestCase
{

    public function testLoadLibrary()
    {
        $container = $this->getContainer();
        $extension = new ProcessingExtension();
        $extension -> load(array(), $container);

        $this->assertTrue($container->hasDefinition('processing.processor'));
    }

    protected function getContainer()
    {
        return new ContainerBuilder(new ParameterBag(array(
            'kernel.debug' => false,
            'kernel.bundles'=> array(),
            'kernel.cache_dir' => sys_get_temp_dir(),
            'kernel.environment' => 'test',
            'kernel.root_dir'    => __DIR__.'/../../'
        )));

    }
}