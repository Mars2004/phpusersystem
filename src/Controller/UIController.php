<?php

namespace App\Controller;

use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class UIController extends AbstractController
{
    /**
      * @Route("/", name="add_user")
      */
    public function AddUserForm(Request $request, ValidatorInterface $validator): Response
    {
      //create Add User Form
      $form = $this->createForm(UserType::class/*, null,
      [
        "action" => $this->generateUrl("api_add_user"),
        "method" => "PUT"
      ]*/);

      //common pattern of processing Symfony forms
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid())
      {
          $newUser = $form->getData();

          //get Doctrine entity manager
          $entityManager = $this->getDoctrine()->getManager();

          //validate new user
          $errors = $validator->validate($newUser);
          if (count($errors) > 0)
          {
            //new user is not valid -> return response with validation errors
            return new Response((string) $errors, 400);
          }

          //execute and insert to database
          $entityManager->persist($newUser);
          $entityManager->flush();

          return $this->redirectToRoute("add_user");
      }

      //render page with form
      return $this->render("addUserForm.html.twig", ["form" => $form->createView()]);
    }
}
