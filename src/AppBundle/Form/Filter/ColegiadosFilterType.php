<?php

namespace AppBundle\Form\Filter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ColegiadosFilterType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('apellido','text',array(
                    'required'=>false
                ))
                ->add('numeroDocumento','integer',array(
                    'required'=>false
                ))
                ->add('matricula','integer',array(
                    'required'=>false
                ))
//                ->add('estado', 'choice', array(
//                    'choices' => array(
//                        'pendiente' => 'Pendiente',
//                        'iniciado' => 'Iniciado',
//                        'patentado' => 'Patentado',
//                    ),
//                    'expanded' => false,
//                    'multiple' => false,
//                    'required' => true,
//                ))
                ->add('situacion', 'entity', array(
                    'class' => 'AppBundle:Situacion',
                    'choice_label' => 'descripcion',
                    'required' => false,
                ))
//                ->add('rango', 'text', array(
//                    'attr' => array('class' => 'daterange fecha-rango hidden'),
//                    'label_attr' => array('class' => 'fecha-rango hidden'),
//                     'required' => false,
//                ))

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'csrf_protection' => false
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_colegiados_filter';
    }

}
