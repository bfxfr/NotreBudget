<?php

namespace Bfxmpl\Bundle\BudgetBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EcritureType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('date')
            ->add('montant')
            ->add('sens')
            ->add('compteBancaire', 'entity',
                array('class' => 'BfxmplBudgetBundle:CompteBancaire', 'property' => 'libelle'));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bfxmpl\Bundle\BudgetBundle\Entity\Ecriture'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bfxmpl_bundle_budgetbundle_ecriture';
    }
}
