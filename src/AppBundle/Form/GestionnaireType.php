<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GestionnaireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,['attr'=>['class'=>"form-control", 'placeholder'=>"Le nom ", 'autcomplete'=>"off"]])
            ->add('prenoms', TextType::class,['attr'=>['class'=>"form-control", 'placeholder'=>"Le prenoms", 'autcomplete'=>"off"]])
            ->add('contact', TextType::class,['attr'=>['class'=>"form-control", 'placeholder'=>"Le contact", 'autcomplete'=>"off"],'required'=>false])
            //->add('slug')->add('publiePar')->add('modifiePar')->add('publieLe')->add('modifieLe')
            ->add('user', EntityType::class,[
                'attr'=>['class'=>'form-control js-select2'],
                'class'=>'AppBundle\Entity\User',
                'query_builder'=>function(EntityRepository $er){
                    return $er->liste();
                },
                'choice_label'=>'username'
            ])
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
            'data_class' => 'AppBundle\Entity\Gestionnaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_gestionnaire';
    }


}
