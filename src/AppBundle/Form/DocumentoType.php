<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('descripcion')
                ->add('fechaIngreso', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(
                        'class' => 'datepicker',
                    ),
                ))
//                ->add('expediente')
                ->add('tipoDocumentoExpediente','entity',array(
                    'class'=>'AppBundle:TipoDocumentoExpediente',
                    'required'=>true
                ))
                ->add('hojas', 'collection', array(
                    'type' => new HojaType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype_name' => '__hoja__'
                ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Documento'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_documento';
    }

}
