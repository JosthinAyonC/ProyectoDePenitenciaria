<?php

namespace App\Form;

use App\Entity\Recluso;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReclusoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('identificacion')
            ->add('delitos')
            ->add('sentencia')
            ->add('fichaIngreso')
            ->add('estado')
            ->add('idPabellon')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recluso::class,
        ]);
    }
}
