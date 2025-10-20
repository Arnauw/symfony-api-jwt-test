<?php

namespace App\Controller;

use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

#[AsController]
class CommentTestController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(#[MapRequestPayload] Comment $entity): JsonResponse
    {
        $entity->setTitle('Test Controller');
        $entity->setContent('Test Controller');
        $entity->setOnline(false);


        $this->entityManager->persist($entity);
        $this->entityManager->flush();


//        return $entity;
        return $this->json(
            $entity, // The data to serialize
            Response::HTTP_CREATED, // The 201 status code for a new resource
            [], // No special headers are needed right now
//            ['groups' => 'read:collection'] // Tell the serializer which groups to use
        );
    }

}
