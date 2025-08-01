<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('companyName', TextType::class, [
                'attr' => [
                    'placeholder' => 'M2i',
                    'class' => 'form-control',
                ],
                'label' => 'Nom de la société',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'help' => 'Entrez le nom de votre société'
            ])
            ->add('contactName', TextType::class, [
                'attr' => [
                    'placeholder' => 'Toto',
                    'class' => 'form-control',
                ],
                'label' => 'Nom du contact',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'help' => 'Entrez le nom de votre contact'
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'example@ex.fr',
                    'class' => 'form-control',
                ],
                'label' => 'Email de contact',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'help' => 'Entrez l\'email de contact'
            ])
            ->add('phone', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => '0688888888',
                    'class' => 'form-control',
                ],
                'label' => 'Téléphone du contact',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'help' => 'Entrez le téléphone de votre contact'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
