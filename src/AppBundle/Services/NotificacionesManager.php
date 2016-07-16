<?php


namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerAware;

class NotificacionesManager {

    /** @var $container Container */
    private $container;
    /* @var $em EntityManager */
    private $em;

    public function __construct($container) {
        $this->container = $container;
        $this->em = $container->get('doctrine')->getManager();
    }

//    public function getNotificacionesAgenda( $usuario ) {
//        $em= $this->em;
//
//        $entregas = $em->getRepository('VehiculosBundle:AgendaEntrega')->getEntregasDelDia($usuario);
//
//        return $entregas;
//
//    }
}
