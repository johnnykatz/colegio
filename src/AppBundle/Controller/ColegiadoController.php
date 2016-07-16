<?php

namespace AppBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Colegiado;
use AppBundle\Entity\Expediente;
use AppBundle\Form\ColegiadoType;
use AppBundle\Form\ExpedienteType;
use UsuariosBundle\Controller\TokenAuthenticatedController;
/**
 * Colegiado controller.
 *
 */
class ColegiadoController extends Controller implements TokenAuthenticatedController{

    /**
     * Lists all Colegiado entities.
     *
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Colegiado')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $entities, $request->query->get('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('AppBundle:Colegiado:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Colegiado entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Colegiado();
        $form = $this->createCreateForm($entity);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            if ($entity->getDomicilios()->count() > 0) {
                foreach ($entity->getDomicilios() as $domicilio) {
                    $domicilio->setColegiado($entity);
                }
            }
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success', 'Colegiado creado correctamente.'
            );

            return $this->redirect($this->generateUrl('colegiado_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Colegiado:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Colegiado entity.
     *
     * @param Colegiado $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Colegiado $entity, $type = null, $route = null, $submitLabel = 'Crear') {
        if (!$type) {
            $type = new ColegiadoType();
        }

        if (!$route) {
            $route = $this->generateUrl('colegiado_create');
        }
        $form = $this->createForm(
                $type, $entity, array(
            'action' => $route,
            'method' => 'POST',
            'attr' => array('class' => 'box-body')
                )
        );


        $form->add('submit', 'submit', array(
            'label' => $submitLabel,
            'attr' => array('class' => 'btn btn-primary pull-right')
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Colegiado entity.
     *
     */
    public function newAction() {
        $entity = new Colegiado();
        $form = $this->createCreateForm($entity);

        return $this->render('AppBundle:Colegiado:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Colegiado entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Colegiado')->find($id);
        $expediente = $entity->getExpedientes()->first();
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Colegiado entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Colegiado:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Colegiado entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Colegiado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Colegiado entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Colegiado:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Colegiado entity.
     *
     * @param Colegiado $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Colegiado $entity) {
        $form = $this->createForm(new ColegiadoType(), $entity, array(
            'action' => $this->generateUrl('colegiado_update', array('id' => $entity->getId())),
//            'method' => 'PUT',
            'attr' => array('class' => 'box-body')
        ));

        $form->add(
                'submit', 'submit', array(
            'label' => 'Actualizar',
            'attr' => array('class' => 'btn btn-primary pull-right'),
                )
        );

        return $form;
    }

    /**
     * Edits an existing Colegiado entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Colegiado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Colegiado entity.');
        }

        $originalDomicilios = new ArrayCollection();

        // Create an ArrayCollection of the current Tag objects in the database
        foreach ($entity->getDomicilios() as $domicilio) {
            $originalDomicilios->add($domicilio);
        }

//        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
//        ->handleRequest($request);e
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {

            foreach ($originalDomicilios as $domicilio) {
                if (false === $entity->getDomicilios()->contains($domicilio)) {
                    $em->remove($domicilio);
                }
            }
            if ($entity->getDomicilios()->count() > 0) {

                foreach ($entity->getDomicilios() as $domicilio) {
                    $domicilio->setColegiado($entity);
                }
            }
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success', 'Colegiado actualizado correctamente.'
            );

            return $this->redirect($this->generateUrl('colegiado_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:Colegiado:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
//                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Colegiado entity.
     *
     */
    public function deleteAction(Request $request, $id) {
//        $form = $this->createDeleteForm($id);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $entity = $em->getRepository('AppBundle:Colegiado')->find($id);
//
//            if (!$entity) {
//                throw $this->createNotFoundException('Unable to find Colegiado entity.');
//            }
//
//            $em->remove($entity);
//            $em->flush();
//        }
//
//        return $this->redirect($this->generateUrl('colegiado'));

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Colegiado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Preisliste entity.');
        }

        $em->remove($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('colegiado'));
    }

    /**
     * Creates a form to delete a Colegiado entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('colegiado_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

    public function actualizarExpedienteAction(Request $request, $colegiadoId) {
        $em = $this->getDoctrine()->getManager();
        $colegiado = $em->getRepository('AppBundle:Colegiado')->find($colegiadoId);
        if (count($colegiado->getExpedientes()) > 0) {
            $expediente = $colegiado->getExpedientes()->first();
        } else {
            $expediente = new Expediente();
            $expediente->setColegiado($colegiado);
            $expediente->setMatricula($colegiado->getMatricula());
        }

        $ruta = $this->generateUrl('actualizar_expediente', array('colegiadoId' => $colegiadoId));

        $documentosOriginal = new ArrayCollection();
        $hojasOriginal = new ArrayCollection();

        // Create an ArrayCollection of the current Tag objects in the database
        foreach ($expediente->getDocumentos() as $documento) {
            foreach ($documento->getHojas() as $hoja) {
                $hojasOriginal->add($hoja);
            }
            $documentosOriginal->add($documento);
        }

        $form = $this->expedienteCreateCreateForm($expediente, new ExpedienteType(), $ruta, 'Guardar');

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->persist($expediente);
                $colegiadosManager = $this->get('manager.colegiados');

//                $tipoEstadoDanioGm = $em->getRepository('VehiculosBundle:TipoEstadoDanioGm')->findOneBySlug(
//                        'registrado'
//                );

                if ($colegiadosManager->guardarExpediente($expediente, $documentosOriginal, $hojasOriginal)) {

                    $this->get('session')->getFlashBag()->add(
                            'success', 'Datos del Expediente fueron actualizados correctamente.'
                    );
                }
            }
        }

        return $this->render('AppBundle:Colegiado:editExpediente.html.twig', array(
                    'edit_form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Expediente entity.
     *
     * @param Colegiado $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function expedienteCreateCreateForm(Expediente $entity, $type = null, $route = null, $submitLabel = 'Crear') {
        if (!$type) {
            $type = new ExpedienteType();
        }

//        if (!$route) {
//            $route = $this->generateUrl('colegiado_create');
//        }
        $form = $this->createForm(
                $type, $entity, array(
            'action' => $route,
            'method' => 'POST',
            'attr' => array('class' => 'box-body')
                )
        );


        $form->add('submit', 'submit', array(
            'label' => $submitLabel,
            'attr' => array('class' => 'btn btn-primary pull-right')
        ));

        return $form;
    }
    
    
    	public function pdfHojaAction( $url ) {
//		$form = $this->createForm( new AutosVendidosPorVendedorFilterType() );
//
//		$entities = array();

		$reportesManager = $this->get( 'manager.reportes' );

//		if ( $request->getMethod() == 'POST' ) {

//			$form->handleRequest( $request );

//			$formData = $form->getData();

//			$vendedor = $formData['vendedor'];
//			if ( $formData['rango'] ) {
//				$aFecha = explode( ' - ', $formData['rango'] );
//
//				$fechaDesde = \DateTime::createFromFormat( 'd/m/Y', $aFecha[0] );
//				$fechaHasta = \DateTime::createFromFormat( 'd/m/Y', $aFecha[1] );

//				$entities = $reportesManager->getAutosVendidosPorVendedor( $vendedor, $fechaDesde, $fechaHasta );
//			} else {
//				$fechaDesde = null;
//				$fechaHasta = null;
//				$entities   = $reportesManager->getAutosVendidosPorVendedor( $vendedor );
//			}
//		}

		$title = 'Hoja';

		$html = $this->renderView(
			'VehiculosBundle:Reporte:reporteAutosVendidosPorVendedor.pdf.twig',
			array(
				'url'   => $url,
			)
		);

		return new Response(
			$reportesManager->imprimir( $html )
			, 200, array(
				'Content-Type'        => 'application/pdf',
				'Content-Disposition' => 'inline; filename="' . $title . '.pdf"'
			)
		);
	}

}
