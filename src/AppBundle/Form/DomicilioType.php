<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UbicacionBundle\Form\EventListener\AddDepartamentoFieldSubscriber;
use UbicacionBundle\Form\EventListener\AddLocalidadFieldSubscriber;
use UbicacionBundle\Form\EventListener\AddPaisFieldSubscriber;
use UbicacionBundle\Form\EventListener\AddProvinciaFieldSubscriber;

class DomicilioType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $factory = $builder->getFormFactory();
        $builder
                ->add('tipoDomicilio','entity',array(
                    'class' => 'AppBundle:TipoDomicilio',
                    'attr' => array(
                        'class' => 'tipoDomicilio',
                    ),
                ))
                ->add('calle', 'jqueryautocomplete', array(
                    'class' => 'AppBundle:Calle',
                    'search_method' => 'getCalleByNombreCodigo',
                    'required' => true,
                    'route_name' => 'get_calle_by_nombre_codigo'
                ))
                ->add('numeracion', 'text', array(
                    'label' => 'Num'
                ))
                ->add('piso')
                ->add('departamentoC', 'text', array(
                    'label' => 'Dpto'
                ))
                ->add('fecha', 'date', array(
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
                    'route_name' => 'get_localidad_by_nombre'
                ))



//            ->add('colegiado')                
        ;
//        $builder->addEventSubscriber(new AddPaisFieldSubscriber($factory));
//        $builder->addEventSubscriber(new AddProvinciaFieldSubscriber($factory));
//        $builder->addEventSubscriber(new AddDepartamentoFieldSubscriber($factory));
//        $builder->addEventSubscriber(new AddLocalidadFieldSubscriber($factory));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Domicilio'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_domicilio';
    }

}
