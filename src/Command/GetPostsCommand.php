<?php

namespace App\Command;

use App\Entity\Post;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetPostsCommand extends Command
{

    protected static $defaultName = 'app:get-posts';

    protected function configure(): void
    {
        // ...
    }

    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $posts = "https://jsonplaceholder.typicode.com/posts";
        $users = "https://jsonplaceholder.typicode.com/users";

        $json_posts = file_get_contents($posts);
        $obj_posts = json_decode($json_posts);

        $json_users = file_get_contents($users);
        $obj_users = json_decode($json_users);

        $number_of_users = count($obj_users);
        $number_of_posts = count($obj_posts);

        $entityManager = $this->doctrine->getManager();


        for ($i = 0; $i < $number_of_posts; $i++) {


            $post[$i] = new Post();
            $post[$i]->setTitle((string)$obj_posts[$i]->title);
            $post[$i]->setBody((string)$obj_posts[$i]->body);
            $post[$i]->setUserId((int)$obj_posts[$i]->userId);
            $actual_post_id = $obj_posts[$i]->userId;

            for ($j = 0; $j < $number_of_users; $j++) {
                if ($obj_users[$j]->id == $actual_post_id) {
                    $post[$i]->setAuthorName($obj_users[$j]->name) ;
                }
            }

            $entityManager->persist($post[$i]);
            $entityManager->flush();

        }

            return Command::SUCCESS;

        }

    }