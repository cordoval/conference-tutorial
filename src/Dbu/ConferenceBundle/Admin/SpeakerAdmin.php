<?php

namespace Dbu\ConferenceBundle\Admin;

use Dbu\ConferenceBundle\Document\Speaker;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Cmf\Bundle\SimpleCmsBundle\Admin\PageAdmin;

class SpeakerAdmin extends PageAdmin
{
    public function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);

        $formMapper
            ->with('form.group_general')
                ->remove('parent')
                ->add('title', null, array('label' => 'Full name'))
            ->end()
        ;
    }

    public function getNewInstance()
    {
        /** @var $new Speaker */
        $new = parent::getNewInstance();

        $new->setParent($this->getModelManager()->getDocumentManager()->find(null, $this->getRootPath()));

        return $new;
    }
}
