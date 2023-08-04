<?php

namespace App\Form;

use App\Entity\Memberships;
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

class MembershipForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        /** @var TranslatorInterface $translator */
        $translator = $options['translator'];

        $builder
            ->add('membership_number', TextType::class, ['label' => $translator->trans('backend.membership.membershipNumber')])
            ->add('contact_phone_number', TextType::class, ['label' => $translator->trans('backend.membership.telephone')])
            ->add('street', TextType::class, ['label' => $translator->trans('backend.membership.numberStreet')])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('translator');
        $resolver->setDefaults([
            'data_class' => Memberships::class,
        ]);
    }
}
