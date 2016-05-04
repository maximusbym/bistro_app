<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class BonusCardsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('series', IntegerType::class, array(
                'label' => 'Series',
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 3, 'max' => 3, 'exactMessage' => 'the value has to consist of 3 positive digits')),
                ),
            ))
            ->add('expInterval', ChoiceType::class, array(
                'choices'  => array('1 month' => '1m', '6 months' => '6m', 'one year' => '1y'),
                'choices_as_values' => true,
                'label' => 'Expiration period',
                'constraints' => array(
                    new NotBlank()
                ),
            ))
            ->add('amount', IntegerType::class, array('label' => 'Amount',
                'constraints' => array(
                    new NotBlank()
                ),
            ))
            ->add('send', SubmitType::class, array('label' => 'Generate BonusCards'));
    }

}