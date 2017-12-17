<?php

namespace spec\AppBundle\Form\Type;

use AppBundle\Entity\Category;
use AppBundle\Entity\Stock;
use AppBundle\File\SymfonyUploadedFile;
use AppBundle\Form\Type\UploadedFileType;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Webmozart\Assert\Assert;

class UploadedFileTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UploadedFileType::class);
    }

    function it_can_build_a_form(FormBuilderInterface $builder)
    {
        $this->buildForm($builder, []);

        $builder
            ->add('file', FileType::class, [
                'multiple' => false,
            ])
            ->shouldHaveBeenCalled()
        ;
    }

    function it_can_build_a_view_happy_path(
        FormInterface $parent,
        FormInterface $form,
        Stock $stock
    )
    {
        $stock->getFilename()->willReturn('fake-file.jpg');
        $parent->getData()->willReturn($stock);
        $form->getParent()->willReturn($parent);

        $view = new FormView();
        $view->vars['full_name'] = 'qwerty';

        $this->buildView($view, $form, []);

        Assert::same(
            $view->vars['full_name'],
            'qwerty[file]'
        );

        Assert::same(
            $view->vars['file_uri'],
            '/images/fake-file.jpg'
        );
    }


    function it_will_not_set_a_file_uri_view_var_if_parent_form_data_is_not_a_image(
        FormInterface $parent,
        FormInterface $form,
        Category $category
    )
    {
        $parent->getData()->willReturn($category);
        $form->getParent()->willReturn($parent);
        $view = new FormView();
        $view->vars['full_name'] = 'qwerty';
        $this->buildView($view, $form, []);
        Assert::same(
            $view->vars['full_name'],
            'qwerty[file]'
        );
        Assert::false(
            isset($view->vars['file_uri'])
        );
    }

    function it_will_set_a_file_uri_view_var_of_null_if_image_has_no_filename(
        FormInterface $parent,
        FormInterface $form,
        Stock $stock
    )
    {
        $stock->getFilename()->willReturn(null);
        $parent->getData()->willReturn($stock);
        $form->getParent()->willReturn($parent);
        $view = new FormView();
        $view->vars['full_name'] = 'qwerty';
        $this->buildView($view, $form, []);
        Assert::same(
            $view->vars['full_name'],
            'qwerty[file]'
        );
        Assert::null($view->vars['file_uri']);
    }

    function it_can_correctly_configure_options(
        OptionsResolver $resolver
    )
    {
        $this->configureOptions($resolver);

        $resolver
            ->setDefaults([
                'data_class' => SymfonyUploadedFile::class,
                'file_uri'   => null,
            ])
            ->shouldHaveBeenCalled()
        ;
    }
}