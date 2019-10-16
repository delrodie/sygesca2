<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScoutType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('matricule')
            ->add('nom', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>"Le nom du scout", 'autocomplete'=>"off"]])
            ->add('prenoms', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>"les prenoms", 'autocomplete'=>"off"]])
            ->add('datenaiss', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>"La datenaissance", 'autocomplete'=>"off"]])
            ->add('lieunaiss', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>"Le lieu de naissance", 'autocomplete'=>"off"]])
            ->add('sexe', ChoiceType::class,[ 'attr'=>['class'=>'form-control'],
                'choices' => ['Masculin'=>'M', 'Feminin'=>'F']
            ])
            ->add('branche', ChoiceType::class,['attr'=>['class'=>'form-control', 'placeholder'=>"La branche du scout", 'autocomplete'=>"off"],
                'choices'=>['-- Selectionnez la branche --'=>'','Meute'=>'Meute', 'Troupe'=>'Troupe', 'Generation'=>'Generation', 'Communaute'=>'Communaute'], 'required'=>false
            ])
            ->add('fonction', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>"La fonction encours", 'autocomplete'=>"off"], 'required'=>false])
            ->add('contact', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>"Le contact telephonique", 'autocomplete'=>"off"]])
            ->add('contactParent', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>"Le contact de la personne a contacter en cas d'urgance", 'autocomplete'=>"off"]])
            ->add('email', EmailType::class,['attr'=>['class'=>'form-control', 'placeholder'=>"L'adresse email", 'autocomplete'=>"off"], 'required'=>false])
            //->add('cotisation')
            //->add('slug')->add('publiePar')->add('modifiePar')->add('publieLe')->add('modifieLe')
            ->add('statut', EntityType::class,[
                'attr'=>['class'=>'form-control js-select2'],
                'class'=>'AppBundle\Entity\Statut',
                'query_builder'=>function(EntityRepository $er){
                    return $er->liste();
                },
                'choice_label'=>'libelle'
            ])
            ->add('groupe', EntityType::class,[
                'attr'=>['class'=>'form-control js-select2'],
                'class'=>'AppBundle\Entity\Groupe',
                'query_builder'=>function(EntityRepository $er){
                    return $er->liste();
                },
                'choice_label'=>'paroisse'
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Scout'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_scout';
    }


}
