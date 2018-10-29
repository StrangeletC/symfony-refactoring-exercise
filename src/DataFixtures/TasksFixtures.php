<?php
namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TasksFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $task = new Task();
            $task->setText('Task ' . $i);
            $task->setCompleted(rand(0,1));
            $manager->persist($task);
        }

        $manager->flush();
    }
}
