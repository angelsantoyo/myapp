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

class PartnersFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        /** @var TranslatorInterface $translator */
        $translator = $options['translator'];

        $builder
            ->add('firstName', TextType::class, ['label' => $translator->trans('backend.partenrs.firstName')])
            ->add('lastName', TextType::class, ['label' => $translator->trans('backend.partenrs.lastName')])
            ->add('relationship', NumberType::class, ['label' => $translator->trans('backend.partenrs.relationship')])
            ->add('birthdate', NumberType::class, ['label' => $translator->trans('backend.partenrs.birthdate')])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('translator');
        $resolver->setDefaults([
            'data_class' => Partners::class,
        ]);
    }
}
