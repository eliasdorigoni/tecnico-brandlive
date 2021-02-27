<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')

            // Define required = false para testear reglas de validación
            ->add('firstName', TextType::class, [
                'label' => 'Nombre',
                'required' => false,
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Apellido',
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => false,
            ])
            ->add('observations', TextareaType::class, [
                'label' => 'Observaciones',
                'required' => false,
            ])
            ->add('save', SubmitType::class, ['label' => 'Crear cliente'])
        ;
    }
}