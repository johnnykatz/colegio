<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Circunscripcion;
use AppBundle\Form\CircunscripcionType;

/**
 * Circunscripcion controller.
 *
 */
class CircunscripcionController extends Controller
{

    /**
     * Lists all Circunscripcion entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Circunscripcion')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
        $entities, $request->query->get('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('AppBundle:Circunscripcion:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Circunscripcion entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Circunscripcion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success', 'Circunscripcion creado correctamente.'
            );

            return $this->redirect($this->generateUrl('circunscripcion_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Circunscripcion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Circunscripcion entity.
     *
     * @param Circunscripcion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Circunscripcion $entity)
    {
        $form = $this->createForm(new CircunscripcionType(), $entity, array(
            'action' => $this->generateUrl('circunscripcion_create'),
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
     * Displays a form to create a new Circunscripcion entity.
     *
     */
    public function newAction()
    {
        $entity = new Circunscripcion();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:Circunscripcion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Circunscripcion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Circunscripcion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Circunscripcion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Circunscripcion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Circunscripcion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Circunscripcion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Circunscripcion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Circunscripcion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Circunscripcion entity.
    *
    * @param Circunscripcion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Circunscripcion $entity)
    {
        $form = $this->createForm(new CircunscripcionType(), $entity, array(
            'action' => $this->generateUrl('circunscripcion_update', array('id' => $entity->getId())),
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
     * Edits an existing Circunscripcion entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Circunscripcion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Circunscripcion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success', 'Circunscripcion actualizado correctamente.'
            );

            return $this->redirect($this->generateUrl('circunscripcion_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:Circunscripcion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Circunscripcion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Circunscripcion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Circunscripcion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('circunscripcion'));
    }

    /**
     * Creates a form to delete a Circunscripcion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('circunscripcion_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
