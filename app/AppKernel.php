<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new AppBundle\AppBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new DCS\OpauthBundle\DCSOpauthBundle(),
            new juzz\CanalesBundle\juzzCanalesBundle(),
            new juzz\ProgramasBundle\juzzProgramasBundle(),
            new juzz\EpisodiosBundle\juzzEpisodiosBundle(),
            new juzz\UsuariosBundle\juzzUsuariosBundle(),
            new Ras\Bundle\FlashAlertBundle\RasFlashAlertBundle(),
            new juzz\FilesBundle\juzzFilesBundle(),
            new juzz\CommentsBundle\juzzCommentsBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new Lopi\Bundle\PusherBundle\LopiPusherBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new juzz\NotificationsBundle\juzzNotificationsBundle(),
            new Braincrafted\Bundle\BootstrapBundle\BraincraftedBootstrapBundle(),
            new Vich\UploaderBundle\VichUploaderBundle(),
            new Hip\MandrillBundle\HipMandrillBundle()
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
