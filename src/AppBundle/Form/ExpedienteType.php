<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExpedienteType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('matricula','text',array(
                    'attr' => array('readonly' => 'readonly')
                ))
                ->add('fechaCreacion', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(
                        'class' => 'datepicker',
                    ),
                ))
                ->add('observacion')
                ->add('colegiado')
                ->add('documentos', 'bootstrapcollection', array(
                    'type' => new DocumentoType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype_name' => '__documento__',
        ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Expediente'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_expediente';
    }

}
