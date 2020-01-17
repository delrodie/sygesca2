<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScoutDeletedType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule')
            ->add('nom')
            ->add('prenoms')
            ->add('datenaiss')
            ->add('lieunaiss')
            ->add('sexe')
            ->add('branche')
            ->add('fonction')
            ->add('contact')
            ->add('contactParent')
            ->add('email')
            ->add('carte')
            ->add('cotisation')
            ->add('urgence')
            ->add('slug')
            ->add('publieLe')
            ->add('supprimeLe')
            ->add('statut')
            ->add('groupe')
            ->add('district')->add('region')->add('montant')->add('montantSansFrais')->add('ristourne');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ScoutDeleted'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_scoutdeleted';
    }


}
