<?php

namespace App\Form;

use App\Entity\PaymentTypes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Contracts\Translation\TranslatorInterface;

class PTFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        /** @var TranslatorInterface $translator */
        $translator = $options['translator'];

        $builder
            ->add('name', TextType::class, ['label' => $translator->trans('backend.pt.name')])
            ->add('description', TextType::class, ['label' => $translator->trans('backend.pt.description')])
            ->add('prefix', TextType::class, ['label' => $translator->trans('backend.pt.description')])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('translator');
        $resolver->setDefaults([
            'data_class' => PaymentTypes::class,
        ]);
    }
}
