<?php

declare(strict_types=1);

namespace KejawenLab\ApiSkeleton\Form;

use KejawenLab\ApiSkeleton\Entity\User;
use KejawenLab\ApiSkeleton\Security\Validator\PasswordHistory;
use KejawenLab\ApiSkeleton\Security\Validator\PasswordLength;
use KejawenLab\ApiSkeleton\Security\Validator\PasswordMatch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 */
final class UpdateProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fullName', TextType::class, ['required' => true]);
        $builder->add('email', EmailType::class, ['required' => true]);
        $builder->add('oldPassword', PasswordType::class, [
            'required' => false,
            'mapped' => false,
            'constraints' => [new PasswordMatch()],
        ]);
        $builder->add('newPassword', PasswordType::class, [
            'required' => false,
            'mapped' => false,
            'constraints' => [new PasswordHistory(), new PasswordLength()],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
