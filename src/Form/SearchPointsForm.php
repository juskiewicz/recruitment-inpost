<?php

declare(strict_types=1);

namespace App\Form;

use App\Form\DataTransformer\CityNameTransformer;
use App\Validator\RequiresPostalCode;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class SearchPointsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('street', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length(['min' => 3, 'max' => 64])
                ]
            ])
            ->add('city', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\Length(['min' => 3, 'max' => 64]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('postalCode', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^\d{2}-\d{3}$/',
                        'message' => 'The postal code format should be XX-XXX.'
                    ]),
                ]
            ])
            ->add('search', SubmitType::class)
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $data = $event->getData();
                $form = $event->getForm();

                if ($data['postalCode'] === '01-234') {
                    $form->add('name', TextType::class, ['mapped' => false]);
                }
            })
        ;

        $builder->get('city')->addModelTransformer(new CityNameTransformer());
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
            'attr' => [
                'novalidate' => 'novalidate',
            ],
            'constraints' => [
                new RequiresPostalCode(),
            ]
        ]);
    }
}
