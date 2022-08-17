<?php

namespace App\Form;
use App\Entity\Ville;
use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom' ,TypeTextType::class,[
               'label'=>'votre nom',
               'attr' => [
                'placeholder' => 'votre Non',
            ],
           ])
            ->add('prenom',TypeTextType::class,[
                'label'=>'votre prenom',
                'attr' => [
                 'placeholder' => 'votre prenom',
             ],
            ])

            ->add('date')
            ->add('ville',EntityType::class,[
                'class'=>Ville::class,
                'label'=>"nom",
                'placeholder'=>'choisisez un nom dans la liste',
                'autocomplete'=>true,

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
