<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UsuariosBundle\Controller\TokenAuthenticatedController;
use AppBundle\Entity\Situacion;
use AppBundle\Form\SituacionType;
use AppBundle\Form\Filter\SituacionesFilterType;
/**
 * Situacion controller.
 *
 */
class SituacionController extends Controller implements TokenAuthenticatedController 
{

    /**
     * Lists all Situacion entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

         $form = $this->createForm(new SituacionesFilterType());
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $entities = $em->getRepository('AppBundle:Situacion')->getSituacionesFilter($data);
            }
        } else {
             $entities = $em->getRepository('AppBundle:Situacion')->getSituacionesFilter();
        }

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
        $entities, $request->query->get('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('AppBundle:Situacion:index.html.twig', array(
            'entities' => $entities,
            'form' => $form->createView(),
        ));
    }
    /**
     * Creates a new Situacion entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Situacion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success', 'Situacion creado correctamente.'
            );

            return $this->redirect($this->generateUrl('situacion_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Situacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Situacion entity.
     *
     * @param Situacion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Situacion $entity)
    {
        $form = $this->createForm(new SituacionType(), $entity, array(
            'action' => $this->generateUrl('situacion_create'),
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
     * Displays a form to create a new Situacion entity.
     *
     */
    public function newAction()
    {
        $entity = new Situacion();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:Situacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Situacion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Situacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Situacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Situacion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Situacion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Situacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Situacion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Situacion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Situacion entity.
    *
    * @param Situacion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Situacion $entity)
    {
        $form = $this->createForm(new SituacionType(), $entity, array(
            'action' => $this->generateUrl('situacion_update', array('id' => $entity->getId())),
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
     * Edits an existing Situacion entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Situacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Situacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success', 'Situacion actualizado correctamente.'
            );

            return $this->redirect($this->generateUrl('situacion_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:Situacion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Situacion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Situacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Situacion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('situacion'));
    }

    /**
     * Creates a form to delete a Situacion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('situacion_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
