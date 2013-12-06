<?php

namespace Dbu\ConferenceBundle\Admin;

use Dbu\ConferenceBundle\Document\Room;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Cmf\Bundle\SimpleCmsBundle\Admin\PageAdmin;

class RoomAdmin extends PageAdmin
{
    public function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);

        $formMapper
            ->with('form.group_general')
                ->remove('parent')
                ->add('description')
            ->end()
        ;
    }

    public function getNewInstance()
    {
        /** @var $new Room */
        $new = parent::getNewInstance();

        $new->setParent($this->getModelManager()->getDocumentManager()->find(null, $this->getRootPath()));

        return $new;
    }
}
