<?php

namespace BZ\ArchiveBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ArchiveType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                
            ->add('exercice','entity', array('label' => 'Pour le compte de l\'exercice', 
                'class' => 'BZ\BlogBundle\Entity\Exercice',
                'property' => 'annee',
                'empty_value' => '--Choisissez l\'exercice--',
                'multiple' => false,
                'attr' =>array('class' =>'form-control chzn-select'),
                'required' => false,
                'query_builder' => function(EntityRepository $er )  {
                                return $er->createQueryBuilder('e')
                                          ->orderBy('e.annee', 'ASC')
                                          ->where('e.estsupprimer = 0');
                        }))
            ->add('categoriearchive','entity', array('label' => 'Catégorie d\'archive', 
                'class' => 'BZArchiveBundle:CategorieArchive',
                'property' => 'libelle',
                'empty_value' => '--Choisissez la Catégorie--',
                'multiple' => false,
                'attr' =>array('class' =>'form-control chzn-select'),
                'required' => false,
                'query_builder' => function(EntityRepository $er )  {
                                return $er->createQueryBuilder('c')
                                          ->orderBy('c.libelle', 'ASC')
                                          ->where('c.estsupprimer = 0');
                        }))
            ->add('service','entity', array('label' => 'Service de production', 
                'class' => 'BZUserBundle:Service',
                'property' => 'denomination',
                'empty_value' => '--Choisissez le service responsable--',
                'multiple' => false,
                'attr' =>array('class' =>'form-control chzn-select'),
                'required' => true,
                'query_builder' => function(EntityRepository $er )  {
                                return $er->createQueryBuilder('s')
                                          ->orderBy('s.denomination', 'ASC')
                                          ->where('s.estsupprimer = 0');
                        }))
            ->add('objetclassement','entity', array('label' => 'Emplacement de stockage', 
                'class' => 'BZBlogBundle:ObjetClassement',
                'property' => 'emplacementComplet',
                'empty_value' => '--Choisissez l\'emplacement de stockage--',
                'multiple' => false,
                'attr' =>array('class' =>'form-control chzn-select'),
                'required' => true,
                'query_builder' => function(EntityRepository $er )  {
                                return $er->createQueryBuilder('o')
                                          ->orderBy('o.ref', 'ASC')
                                          ->where('o.estsupprimer = 0');
                        }))
            ->add('objetconservation','entity', array('label' => 'Objet de conservation', 
                'class' => 'BZBlogBundle:ObjetConservation',
                'property' => 'libelle',
                'empty_value' => '--Choisissez l\'objet de conservation--',
                'multiple' => false,
                'attr' =>array('class' =>'form-control chzn-select'),
                'required' => true,
                'query_builder' => function(EntityRepository $er )  {
                                return $er->createQueryBuilder('o')
                                          ->orderBy('o.libelle', 'ASC')
                                          ->where('o.estsupprimer = 0');
                        }))
            ->add('dateArchive', 'date', array(
                                                'label' => 'Date Archivage',
                                                'widget' => 'single_text',
                                                'input' => 'datetime',
                                                'format' => 'dd/MM/yyyy',
                                                'attr' => array('class' => 'date form-control '),
                                                ))
           ->add('ref','text',array('label' => 'Référence(s) de l\'archive', 'required' => true,'attr' =>array('class' =>'form-control','placeholder' =>'Entrer les références')))

           ->add('contenu','textarea',array('label' => 'Résumé du contenu', 'required' => true,'attr' =>array('class' =>'form-control')))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BZ\ArchiveBundle\Entity\Archive'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bz_archivebundle_archive';
    }
}
