<?php
// src/BZ/UserBundle/Form/ImageType.php
namespace BZ\UserBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', 'file',array('label' => false));
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
        'data_class' => 'BZ\UserBundle\Entity\Image'));
    }
    public function getName()
    {
        return 'sdz_userbundle_imagetype';
    }
}