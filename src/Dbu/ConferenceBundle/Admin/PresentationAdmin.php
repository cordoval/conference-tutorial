<?php

namespace Dbu\ConferenceBundle\Admin;

use Dbu\ConferenceBundle\Document\Speaker;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Cmf\Bundle\SimpleCmsBundle\Admin\PageAdmin;

class PresentationAdmin extends PageAdmin
{
    private $speakersPath;

    public function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);

        $formMapper
            ->with('form.group_general')
                ->add(
                    'parent',
                    'phpcr_document',
                    array(
                        'choices' => $this->getRooms(),
                        'class' => 'Dbu\ConferenceBundle\Document\Room',
                        'property' => 'title',
                ))
                ->add(
                    'speakers',
                    'phpcr_odm_reference_collection',
                    array(
                        'choices' => $this->getSpeakers(),
                        'referenced_class' => 'Dbu\ConferenceBundle\Document\Speaker',
                ))
            ->end()
        ;
    }

    public function setSpeakersPath($speakersPath)
    {
        $this->speakersPath = $speakersPath;
    }

    private function getRooms()
    {
        return $this->getModelManager()->getDocumentManager()->find(null, $this->getRootPath())->getChildren();
    }

    private function getSpeakers()
    {
        return $this->getModelManager()->getDocumentManager()->find(null, $this->speakersPath)->getChildren()->toArray();
    }
}
