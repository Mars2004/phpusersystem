<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


class RESTApiController extends AbstractController
{
    /**
      * @Route("/api/users/add", name="api_add_user", methods={"PUT"})
      */
    public function AddUser(Request $request, ValidatorInterface $validator): Response
    {
      //get Doctrine entity manager
      $entityManager = $this->getDoctrine()->getManager();

      $query = $request->query;
      if (!$query->get("name") || !$query->get("password") || !$query->get("email") || !$query->get("rights"))
      {
        throw new BadRequestHttpException("Received user data are not valid!");
      }

      //create new user
      $newUser = new User();
      $newUser->setName($query->get("name"));
      $newUser->setPassword($query->get("password"));
      $newUser->setEmail($query->get("email"));
      $newUser->setRights($query->get("rights"));

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

      //return response with message
      return new Response("New user with id " . $newUser->getId());
    }

    /**
      * @Route("/api/users/list", name="api_users_list", methods={"GET", "POST"})
      */
    public function UsersList(): Response
    {
      //get all users stored in DB
      $repository = $this->getDoctrine()->getRepository(User::class);
      $users = $repository->findAll();

      //serialize users to JSON
      $serializer = $this->container->get("serializer");
      $usersJSON = $serializer->serialize($users, "json");

      //return response with users as JSON
      return new Response($usersJSON);
    }
}
