<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Hoja;
use AppBundle\Form\HojaType;

/**
 * Hoja controller.
 *
 */
class HojaController extends Controller
{

    /**
     * Lists all Hoja entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Hoja')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
        $entities, $request->query->get('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('AppBundle:Hoja:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Hoja entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Hoja();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success', 'Hoja creado correctamente.'
            );

            return $this->redirect($this->generateUrl('hoja_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Hoja:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Hoja entity.
     *
     * @param Hoja $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Hoja $entity)
    {
        $form = $this->createForm(new HojaType(), $entity, array(
            'action' => $this->generateUrl('hoja_create'),
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
     * Displays a form to create a new Hoja entity.
     *
     */
    public function newAction()
    {
        $entity = new Hoja();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:Hoja:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Hoja entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Hoja')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Hoja entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Hoja:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Hoja entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Hoja')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Hoja entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Hoja:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Hoja entity.
    *
    * @param Hoja $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Hoja $entity)
    {
        $form = $this->createForm(new HojaType(), $entity, array(
            'action' => $this->generateUrl('hoja_update', array('id' => $entity->getId())),
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
     * Edits an existing Hoja entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Hoja')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Hoja entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success', 'Hoja actualizado correctamente.'
            );

            return $this->redirect($this->generateUrl('hoja_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:Hoja:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Hoja entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Hoja')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Hoja entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('hoja'));
    }

    /**
     * Creates a form to delete a Hoja entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('hoja_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
