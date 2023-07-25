<?php

namespace App\Form;

use App\Entity\MembershipTypes;
use App\Entity\User;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Contracts\Translation\TranslatorInterface;

class MTFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        /** @var TranslatorInterface $translator */
        $translator = $options['translator'];

        $builder
            ->add('name', TextType::class, ['label' => $translator->trans('backend.mt.name')])
            ->add('description', TextType::class, ['label' => $translator->trans('backend.mt.description')])
            ->add('max_members', NumberType::class, ['label' => $translator->trans('backend.mt.max_members')])
            ->add('annual_cost', NumberType::class, ['label' => $translator->trans('backend.mt.annual_cost')])
            ->add('monthly_amount', NumberType::class, ['label' => $translator->trans('backend.mt.monthly_amount')])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('translator');
        $resolver->setDefaults([
            'data_class' => MembershipTypes::class,
        ]);
    }
}
