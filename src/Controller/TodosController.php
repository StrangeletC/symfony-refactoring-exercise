<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TodosController extends AbstractController
{
    /**
     * Отображает все незавершенные задачи.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showTodos()
    {
        $todos = $this->getDoctrine()->getRepository(Task::class)->findBy(['completed' => false]);

        return $this->render('showTodos.html.twig', ['todos' => $todos]);
    }

    /**
     * Отображает все завершенные задачи.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showCompletedTodos()
    {
        $todos = $this->getDoctrine()->getRepository(Task::class)->findBy(['completed' => true]);

        return $this->render('showTodos.html.twig', ['todos' => $todos]);
    }

    /**
     * Помечает задачу как завершенную.
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function completeTodo($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $todo = $entityManager->getRepository(Task::class)->find($id);

        if (!$todo) {
            throw $this->createNotFoundException(
                'Задача не найдена'
            );
        }

        $todo->setCompleted(true);
        $entityManager->flush();

        return $this->redirect('/');
    }

    /**
     * Помечает задачу как незавершенную.
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function uncompleteTodo($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $todo = $entityManager->getRepository(Task::class)->find($id);

        if (!$todo) {
            throw $this->createNotFoundException(
                'Задача не найдена'
            );
        }

        $todo->setCompleted(false);
        $entityManager->flush();

        return $this->redirect('/');
    }
}
