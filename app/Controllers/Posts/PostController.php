<?php

namespace App\Controllers\Posts;

use App\Core\Validator;

class PostController
{

    public function index(): void
    {
        $header = "Welcome To DevLog";

        $posts = db()->query("SELECT posts.*, users.username AS author_name
                                    FROM posts
                                    JOIN users ON posts.user_id = users.id
                                    ORDER BY posts.published_at DESC")
            ->fetchAll();

        foreach ($posts as &$post) {
            $post['url'] = "posts/" . urlencode($post['author_name']) . "/" . urlencode($post['slug']);

            if (empty($post['summary'])) {
                $post['summary'] = summary($post['content']);
            }
        }
        unset($post);

        view('index', [
            'header' => $header,
            'posts' => $posts,
        ]);
    }

    public function show(string $username, string $slug): void
    {

        $user = db()->query(
            "SELECT * FROM users WHERE username = :username",
            ['username' => $username]
        )->fetch();


        if (!$user) {
            abort();
        }

        $post = db()->query(
            "SELECT * FROM posts WHERE user_id = :user_id AND slug = :slug LIMIT 1",
            [
                'user_id' => $user['id'],
                'slug' => $slug
            ]
        )->fetch();


        if (!$post) {
            abort();
        }
        $author_name = $user['username'];
        $title = $post['title'];

        view('posts.show', [
            'post' => $post,
            'author_name' => $author_name,
            'title' => $title,
        ]);
    }

    public function create(): void
    {
        $title = 'New Post | DevLog';

        view('posts.create', [
            'title' => $title,
            'errors' => $errors ?? [],
        ]);
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';

            $errors = [];


            if (!Validator::string($title, 3, 50)) {
                if (mb_strlen(trim($title)) < 3) {
                    $errors['title'] = 'A title must be at least 3 characters long.';
                } else {
                    $errors['title'] = 'A title of no more than 50 characters is required.';
                }
            }

            if (empty($errors)) {
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));

                db()->query("INSERT INTO posts (title, content, user_id, slug, published_at) 
                                    VALUES (:title, :content, :user_id, :slug, NOW())",
                    [
                        ':title' => $title,
                        ':content' => $content,
                        ':user_id' => 1,
                        ':slug' => $slug,
                    ]
                );
            }

        }

        $title = 'New Post | DevLog';

        view('posts.create', [
            'title' => $title,
            'errors' => $errors ?? [],
        ]);
    }
}