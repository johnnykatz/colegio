<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UsuariosBundle\Controller\TokenAuthenticatedController;
use AppBundle\Entity\Calle;
use AppBundle\Form\CalleType;
use AppBundle\Form\Filter\CallesFilterType;

/**
 * Calle controller.
 *
 */
class CalleController extends Controller implements TokenAuthenticatedController
{

    /**
     * Lists all Calle entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new CallesFilterType());
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $entities = $em->getRepository('AppBundle:Calle')->getCallesFilter($data);
            }
        } else {
            $entities = $em->getRepository('AppBundle:Calle')->getCallesFilter();
        }
        

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
        $entities, $request->query->get('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('AppBundle:Calle:index.html.twig', array(
            'entities' => $entities,
            'form'=>$form->createView(),
        ));
    }
    /**
     * Creates a new Calle entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Calle();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success', 'Calle creado correctamente.'
            );

            return $this->redirect($this->generateUrl('calle_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Calle:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Calle entity.
     *
     * @param Calle $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Calle $entity)
    {
        $form = $this->createForm(new CalleType(), $entity, array(
            'action' => $this->generateUrl('calle_create'),
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
     * Displays a form to create a new Calle entity.
     *
     */
    public function newAction()
    {
        $entity = new Calle();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:Calle:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Calle entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Calle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Calle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Calle:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Calle entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Calle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Calle entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Calle:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Calle entity.
    *
    * @param Calle $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Calle $entity)
    {
        $form = $this->createForm(new CalleType(), $entity, array(
            'action' => $this->generateUrl('calle_update', array('id' => $entity->getId())),
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
     * Edits an existing Calle entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Calle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Calle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success', 'Calle actualizado correctamente.'
            );

            return $this->redirect($this->generateUrl('calle_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:Calle:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Calle entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Calle')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Calle entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('calle'));
    }

    /**
     * Creates a form to delete a Calle entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('calle_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
