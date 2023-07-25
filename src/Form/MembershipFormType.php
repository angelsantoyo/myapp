<?php

namespace App\Form;

use App\Entity\MembershipTypes;
use App\Entity\Partners;
use App\Entity\User;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Contracts\Translation\TranslatorInterface;

class MembershipFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        /** @var TranslatorInterface $translator */
        $translator = $options['translator'];

        $builder
            ->add('membershipNumber', TextType::class, ['label' => $translator->trans('backend.membership.membershipNumber')])
            ->add('f', TextType::class, ['label' => $translator->trans('backend.membership.name1')])
            ->add('max_members', NumberType::class, ['label' => $translator->trans('backend.mt.max_members')])
            ->add('annual_cost', NumberType::class, ['label' => $translator->trans('backend.mt.annual_cost')])
            ->add('monthly_amount', NumberType::class, ['label' => $translator->trans('backend.mt.monthly_amount')])
            ->add('monthly_amount', NumberType::class, ['label' => $translator->trans('backend.partenrs.firstName')])
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
