<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Contracts\Translation\TranslatorInterface;

class MTFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        /** @var TranslatorInterface $translator */
        $translator = $options['translator'];

        $builder
            ->add('name', TextType::class, ['label' => $translator->trans('backend.user.name')])
            ->add('descriptions', TextType::class, ['label' => $translator->trans('backend.user.name')])
            ->add('max_members', IntegerType::class, ['label' => $translator->trans('backend.user.name')])
            ->add('status', BooleanType::class, ['label' => $translator->trans('backend.user.name')])
            ->add('annual_cost', FloatType::class, ['label' => $translator->trans('backend.user.name')])
            ->add('monthly_amount', FloatType::class, ['label' => $translator->trans('backend.user.name')])
            ->add('monthly_amount', FloatType::class, ['label' => $translator->trans('backend.user.name')])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('translator');
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
