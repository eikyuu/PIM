<?php


namespace ContactPim\Controller;

use Tags\Model\TagsQuery;
use Thelia\Controller\Front\BaseFrontController;
use Thelia\Model\ProductQuery;
use Thelia\Model\ConfigQuery;

class ContactPimController extends BaseFrontController
{
    public function sendAction()
    {

        $subject = "Probleme sur le P.I.M";
        
        $text = $this->getRequest()->get("contact_pim");
        $email = $this->getRequest()->get("email_contact");

        $message = \Swift_Message::newInstance($subject)
            ->addFrom(ConfigQuery::getStoreEmail())
            ->addTo("vduguet@avidsen.com")
            ->setBody($this->render("mail", 
                [
                    'text' => $text,
                    'email'=> $email
                ]), 
                "text/html");
        $this->getMailer()->send($message);
        header('Location: /');
        exit();
        
    }
}