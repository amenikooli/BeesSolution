<?php

namespace TestBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use TestBundle\Form\EventListener\AddUserListener;

class PersonType extends AbstractType {
    private $addUserListener;
     public function __construct(AddUserListener $subscriber)
    {
        $this->addUserListener = $subscriber;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', null, array("required" => true, "label" => "Nom"))
                ->add('email', EmailType::class, array("required" => true))
                ->add('address', null, array("required" => true, "label" => "Adresse"))
                ->add('city', TextType::class, array("required" => true, "label" => "Ville"))
                ->add('tags', EntityType::class, array('class'=>'TestBundle:Tag','required' => true,'multiple' => true))
                ->add('save', SubmitType::class, array("label" => "Ajouter une personne"))
                ->addEventSubscriber($this->addUserListener);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'TestBundle\Entity\Person'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'testbundle_person';
    }

}
