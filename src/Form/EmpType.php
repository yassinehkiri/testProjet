<?php

namespace App\Form;

use App\Entity\Dept;
use App\Entity\Emp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class EmpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('empno',NumberType::class)
            ->add('ename',TextType::class)
            ->add('job',TextType::class)
            ->add('hiredate',DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ])
            ->add('sal',NumberType::class)
            ->add('comm',NumberType::class)
            ->add('mgr',EntityType::class,
                ['class'=>Emp::class,
                    'choice_label'=>'ename',
                    'multiple'=>false,
                ])
            ->add('deptno',EntityType::class,
                ['class'=>Dept::class,
                    'choice_label'=>'deptno',
                    'multiple'=>false,
                ])
            ->add('save',SubmitType::class)
            ->add('reset',ResetType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emp::class,
        ]);
    }
}
