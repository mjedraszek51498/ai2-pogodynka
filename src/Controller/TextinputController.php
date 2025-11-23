<?php

namespace App\Controller;

use App\Form\TextInputType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TextinputController extends AbstractController
{
    #[Route('/textinput', name: 'app_textinput')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(TextInputType::class);
        $form ->handleRequest($request);
        $submittedText = null;
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $submittedText = $data['text'];
        }
        return $this->render('textinput/index.html.twig', [
            'submittedText' => $submittedText,
            'form' => $form->createView(),
        ]);
    }

}
