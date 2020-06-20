<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\AdminCommentType;
use App\Repository\CommentRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/comments")
 */
class AdminCommentController extends AbstractController
{
    /**
     * @Route("/", name="admin_comment")
     */
    public function index(CommentRepository $comment)
    {
        dump($comment);
        return $this->render('admin/comment/ratingadmin.html.twig', [
            'comment' => $comment->findAll()
        ]);
    }

    /**
     * This fxn edits a comment
     *
     * @Route("/{id}/edit", name="comment_edit", methods={"GET","POST"})
     *
     * @return Response
     */
    public function edit(Comment $comment, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(AdminCommentType::class, $comment);
        
        $form->handleRequest($request);
         
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash(
                'success',
                "You have successfully editted the rating n° {$comment->getId()}"
            );
        }


        return $this->render('admin/comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form->createView()
        ]);
    }

    /**
     * Function to delete a comment
     *
     * @Route("/{id}/delete", name="comment_delete")
     *
     * @param Comment $comment
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Comment $comment, ObjectManager $manager)
    {
        $manager->remove($comment);
        $manager->flush();

        $this->addFlash(
            'success',
            "The comment made by {$comment->getAuthor()->getLastName()} has successfully been deleted"
        );

        return $this->redirectToRoute('admin_comment');
    }
}