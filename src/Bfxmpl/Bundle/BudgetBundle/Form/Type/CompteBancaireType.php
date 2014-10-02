<?php

namespace Bfxmpl\Bundle\BudgetBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompteBancaireType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('banque')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bfxmpl\Bundle\BudgetBundle\Entity\CompteBancaire'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bfxmpl_bundle_budgetbundle_comptebancaire';
    }
}
