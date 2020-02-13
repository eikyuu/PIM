<?php


namespace ContactPim\Controller;

use Tags\Model\TagsQuery;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Model\ProductQuery;
use Thelia\Model\ConfigQuery;

class ContactPimController extends BaseAdminController
{
    public function sendEmail()
    {
        $subject = "yep";
        $message = \Swift_Message::newInstance($subject)
            ->addFrom(ConfigQuery::getStoreEmail())
            ->addTo("vduguet@avidsen.com")
            ->setBody("message");
        $this->getMailer()->send($message);
    }
}