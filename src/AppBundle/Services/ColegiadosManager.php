<?php

namespace AppBundle\Services;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Doctrine\ORM\EntityManager;

class ColegiadosManager {

    private $container;
    /* @var $em EntityManager */
    private $em;

    public function __construct($container) {
        $this->container = $container;
        $this->em = $container->get('doctrine')->getManager();
    }

    public function guardarExpediente($expediente, $documentosOriginal = array(), $hojasOriginal = array(), $operacion = null) {
        $em = $this->em;

//        if (!$vehiculo->getRemito()->getUsuarioReceptor()) {
//            $vehiculo->getRemito()->setUsuarioReceptor($this->container->get('security.token_storage')->getToken()->getUser());
//        }

        foreach ($hojasOriginal as $hoja) {
            $delete = true;
            foreach ($expediente->getDocumentos() as $documento) {
                if ($documento->getHojas()->contains($hoja)) {
                    $delete = false;
                    break;
                }
            }
            if ($delete) {
//                $hojaTmp = $em->getRepository("AppBundle:Hoja")->find($hoja->getId());
//                $hojaTmp->setDocumento($documento);
                $em->remove($hoja);
            }
        }


        foreach ($documentosOriginal as $item) {
            if (false === $expediente->getDocumentos()->contains($item)) {
                $em->remove($item);
            }
        }
        if ($expediente->getDocumentos()->count() > 0) {

            foreach ($expediente->getDocumentos() as $documento) {
                $documento->setExpediente($expediente);

                foreach ($documento->getHojas() as $hoja) {
                    $hoja->setDocumento($documento);
                }
            }
        }
//        if ($operacion != 'editar') {
//            $tipoEstadoVehiculo = $em->getRepository('VehiculosBundle:TipoEstadoVehiculo')->findOneBySlug(
//                    'recibido'
//            );
//
//
//            $this->setEstadoActualVehiculo($vehiculo, $tipoEstadoVehiculo);
//        }
//        $em->persist();
        $em->flush();

        return true;
    }

}
