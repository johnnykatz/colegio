<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UsuariosBundle\Controller\TokenAuthenticatedController;
use AppBundle\Entity\Facultad;
use AppBundle\Form\FacultadType;

/**
 * Facultad controller.
 *
 */
class FacultadController extends Controller implements TokenAuthenticatedController
{

    /**
     * Lists all Facultad entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Facultad')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
        $entities, $request->query->get('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('AppBundle:Facultad:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Facultad entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Facultad();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success', 'Facultad creado correctamente.'
            );

            return $this->redirect($this->generateUrl('facultad_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Facultad:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Facultad entity.
     *
     * @param Facultad $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Facultad $entity)
    {
        $form = $this->createForm(new FacultadType(), $entity, array(
            'action' => $this->generateUrl('facultad_create'),
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
     * Displays a form to create a new Facultad entity.
     *
     */
    public function newAction()
    {
        $entity = new Facultad();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:Facultad:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Facultad entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Facultad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facultad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Facultad:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Facultad entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Facultad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facultad entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Facultad:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Facultad entity.
    *
    * @param Facultad $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Facultad $entity)
    {
        $form = $this->createForm(new FacultadType(), $entity, array(
            'action' => $this->generateUrl('facultad_update', array('id' => $entity->getId())),
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
     * Edits an existing Facultad entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Facultad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facultad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success', 'Facultad actualizado correctamente.'
            );

            return $this->redirect($this->generateUrl('facultad_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:Facultad:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Facultad entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Facultad')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Facultad entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('facultad'));
    }

    /**
     * Creates a form to delete a Facultad entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('facultad_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
