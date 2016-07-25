<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * FacultadRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FacultadRepository extends EntityRepository {

   

    public function getFacultadesFilter($parametros = null) {
        $qb = $this->createQueryBuilder('e');

        if (isset($parametros['nombre'])) {
            $qb->andWhere('e.nombre like :nombre')
                    ->setParameter('nombre', "%" . $parametros['nombre'] . "%");
        }
        if (isset($parametros['codigo'])) {
            $qb->andWhere('e.codigo = :codigo')
                    ->setParameter('codigo', $parametros['codigo']);
        }

        return $qb->getQuery()->getResult();
    }

}
