<?php


namespace ContactPim\Controller;

use Tags\Model\TagsQuery;
use Thelia\Controller\Front\BaseFrontController;
use Thelia\Model\ProductQuery;
use Thelia\Model\ConfigQuery;
use Thelia\Tools\URL;

class ContactPimController extends BaseFrontController
{
    public function sendAction()
    {

        $subject = "Probleme sur le P.I.M";
        
        $text = $this->getRequest()->get("contact_pim");
        $email = $this->getRequest()->get("email_contact");
        $viewMail = $this->render("mail", 
        [
            'text' => $text,
            'email'=> $email
        ]);
        $message = \Swift_Message::newInstance($subject)
            ->addFrom(ConfigQuery::getStoreEmail())
            ->addTo("vduguet@avidsen.com")
            ->setBody($viewMail,
                "text/html");

        $this->getMailer()->send($message);
        
        $flashMessageSuccess = "Votre message a été envoyé avec succès";
        $this->getSession()->getFlashBag()->set('flashMessageSuccess', $flashMessageSuccess);

        if (null != $successUrl = $this->getRequest()->get('current_url')) {
            $response = $this->generateRedirect(
                URL::getInstance()->absoluteUrl($successUrl)
            );

            return $response;
        }
        exit();
        
    }
}