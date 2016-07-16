<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\TipoDocumentoExpediente;
use AppBundle\Form\TipoDocumentoExpedienteType;

/**
 * TipoDocumentoExpediente controller.
 *
 */
class TipoDocumentoExpedienteController extends Controller
{

    /**
     * Lists all TipoDocumentoExpediente entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:TipoDocumentoExpediente')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
        $entities, $request->query->get('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('AppBundle:TipoDocumentoExpediente:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TipoDocumentoExpediente entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TipoDocumentoExpediente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success', 'TipoDocumentoExpediente creado correctamente.'
            );

            return $this->redirect($this->generateUrl('tipo_documento_expediente_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:TipoDocumentoExpediente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TipoDocumentoExpediente entity.
     *
     * @param TipoDocumentoExpediente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TipoDocumentoExpediente $entity)
    {
        $form = $this->createForm(new TipoDocumentoExpedienteType(), $entity, array(
            'action' => $this->generateUrl('tipo_documento_expediente_create'),
            'method' => 'POST',
            'attr' => array('class' => 'box-body')
        ));

        $form->add('submit', 'submit', array(
            'label' => 'Crear',
            'attr' => array('class' => 'btn btn-primary pull-right')
        ));

        return $form;
    }

    /**
     * Displays a form to create a new TipoDocumentoExpediente entity.
     *
     */
    public function newAction()
    {
        $entity = new TipoDocumentoExpediente();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:TipoDocumentoExpediente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TipoDocumentoExpediente entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TipoDocumentoExpediente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoDocumentoExpediente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:TipoDocumentoExpediente:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TipoDocumentoExpediente entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TipoDocumentoExpediente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoDocumentoExpediente entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:TipoDocumentoExpediente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TipoDocumentoExpediente entity.
    *
    * @param TipoDocumentoExpediente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoDocumentoExpediente $entity)
    {
        $form = $this->createForm(new TipoDocumentoExpedienteType(), $entity, array(
            'action' => $this->generateUrl('tipo_documento_expediente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('class' => 'box-body')
        ));

        $form->add(
            'submit',
            'submit',
            array(
                'label' => 'Actualizar',
                'attr' => array('class' => 'btn btn-primary pull-right'),
            )
        );

        return $form;
    }
    /**
     * Edits an existing TipoDocumentoExpediente entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TipoDocumentoExpediente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoDocumentoExpediente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success', 'TipoDocumentoExpediente actualizado correctamente.'
            );

            return $this->redirect($this->generateUrl('tipo_documento_expediente_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:TipoDocumentoExpediente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TipoDocumentoExpediente entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:TipoDocumentoExpediente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoDocumentoExpediente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipo_documento_expediente'));
    }

    /**
     * Creates a form to delete a TipoDocumentoExpediente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipo_documento_expediente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
