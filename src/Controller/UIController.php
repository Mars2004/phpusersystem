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
      $form = $this->createForm(UserType::class);

      //common pattern of processing Symfony forms
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid())
      {
          //form is submitted and valid -> get and se data
          $newUser = $form->getData();

          //get Doctrine entity manager
          $entityManager = $this->getDoctrine()->getManager();

          //validate new user
          $errors = $validator->validate($newUser);
          if (count($errors) > 0)
          {
            //display error message
            $this->addFlash("error", "The received user is not valid: " . json_encode($errors));

            //redirect back to empty "Add User Form"
            return $this->redirectToRoute("add_user");
          }

          //execute and insert to database
          $entityManager->persist($newUser);
          $entityManager->flush();

          //display succes message
          $this->addFlash("notice", "Your changes were saved!");

          //redirect back to empty "Add User Form"
          return $this->redirectToRoute("add_user");
      }

      //render page with form
      return $this->render("addUserForm.html.twig", ["form" => $form->createView()]);
    }
}
