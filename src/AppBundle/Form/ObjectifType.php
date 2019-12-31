<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObjectifType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('annee')
            ->add('valeur',IntegerType::class,['attr'=>['class'=>"form-control",'placeholder'=>"Objectif de la structure", 'autocomplete'=>"off"]])
            //->add('publiePar')->add('modifiePar')->add('publieLe')->add('modifieLe')
            ->add('region', EntityType::class,[
                'attr'=>['class'=>'form-control js-select2'],
                'class'=>'AppBundle\Entity\Region',
                'query_builder'=>function(EntityRepository $er){
                    return $er->liste();
                },
                'choice_label'=>'nom'
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Objectif'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_objectif';
    }


}
