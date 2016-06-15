<?php

namespace Pages\PagesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RechercheType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('recherche', 'text', array('attr' => array('id' => 'recherche', 'placeholder' => 'Rechercher...')))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pages_pagesbundle_recherche';
    }
}