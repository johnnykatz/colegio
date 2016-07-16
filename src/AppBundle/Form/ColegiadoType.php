<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UbicacionBundle\Form\EventListener\AddDepartamentoFieldSubscriber;
use UbicacionBundle\Form\EventListener\AddLocalidadFieldSubscriber;
use UbicacionBundle\Form\EventListener\AddPaisFieldSubscriber;
use UbicacionBundle\Form\EventListener\AddProvinciaFieldSubscriber;

class ColegiadoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $factory = $builder->getFormFactory();
        $builder
                ->add('apellido')
                ->add('nombre')
                ->add('matricula')
                ->add('fechaMatricula', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(
                        'class' => 'datepicker',
                    ),
                ))
                ->add('libro')
                ->add('folio')
                ->add('legajo')
                ->add('tipoDocumento')
                ->add('numeroDocumento')
                ->add('cuilCuit')
                ->add('fechaNacimiento', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(
                        'class' => 'datepicker',
                    ),
                ))
                ->add('localidad', 'jqueryautocomplete', array(
                    'class' => 'UbicacionBundle:Localidad',
                    'search_method' => 'getLocalidadByNombre',
                    'required' => true,
                    'label' => 'Localidad de nacimiento',
                    'route_name' => 'get_localidad_by_nombre'
                ))
                ->add('matriculaFederal')
                ->add('fechaFederal', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(
                        'class' => 'datepicker',
                    ),
                ))
                ->add('libroFederal')
                ->add('folioFederal')
                ->add('fechaInactividad', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(
                        'class' => 'datepicker',
                    ),
                ))
                ->add('cargo')
                ->add('fechaCargo', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(
                        'class' => 'datepicker',
                    ),
                ))
                ->add('fechaTitulo', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(
                        'class' => 'datepicker',
                    ),
                ))
                ->add('observacion')
                ->add('denuncias')
                ->add('telefono1')
                ->add('telefono2')
                ->add('telefono3')
                ->add('mail')
                ->add('foto')
                ->add('sexo')
                ->add('facultad')
                ->add('circunscripcion')
                ->add('situacion')
//                ->add('domicilios', 'collection', array(
//                    'type' => new DomicilioType(),
//                    'allow_add' => true,
//                    'allow_delete' => true,
//                    'prototype_name' => '__domicilio__'
//                ))
                ->add('domicilios', 'bootstrapcollection', array(
                    'type' => new DomicilioType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => true,
                        )
                )

//               ->add('domicilios', 'collection', array(
//                    'type' => new DomicilioType(),
//                    'allow_add' => true,
//                    'allow_delete' => true,
//                ))
        ;
        $builder->addEventSubscriber(new AddPaisFieldSubscriber($factory));
        $builder->addEventSubscriber(new AddProvinciaFieldSubscriber($factory));
        $builder->addEventSubscriber(new AddDepartamentoFieldSubscriber($factory));
        $builder->addEventSubscriber(new AddLocalidadFieldSubscriber($factory));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Colegiado'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_colegiado';
    }

}
