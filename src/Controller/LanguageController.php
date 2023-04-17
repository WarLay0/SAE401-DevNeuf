<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LanguageController extends AbstractController
{
/**
* @Route("/language/{locale}", name="set_language")
*/
public function setLanguage(Request $request, $locale)
{
$request->getSession()->set('_locale', $locale);

return $this->redirect($request->headers->get('referer'));
}
}
