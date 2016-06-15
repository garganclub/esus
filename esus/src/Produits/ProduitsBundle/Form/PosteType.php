<?php

namespace Produits\ProduitsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PosteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('atelier', 'entity', array(
            	'class' => 'Produits\ProduitsBundle\Entity\Atelier', 'property' => 'nomAtelier',
            	'label' => 'Ateliers'
            ))
            ->add('numeroPoste')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Produits\ProduitsBundle\Entity\Poste'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'produits_produitsbundle_poste';
    }
}
