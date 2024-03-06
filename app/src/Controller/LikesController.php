<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\UnauthorizedException;
use Cake\Http\Exception\BadRequestException;

/**
 * Likes Controller
 *
 * @method \App\Model\Entity\Like[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LikesController extends AppController
{
    public function initialize(): void {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');
    }

    public function view($article_id = null) {
        if ($article_id === null) {
            return $this->jsonResponse(400, ['error' => 'Article ID is missing']);
        }

        $this->loadModel('Likes');  

        if (!$this->Likes->exists(['article_id' => $article_id])) {
            return $this->jsonResponse(400, ['error' => 'This article has no likes.']);
        }

        $likes = $this->Likes->find()
            ->where(['article_id' => $article_id])
            ->count();
    
        return $this->jsonResponse(200, ['likes' => $likes]);
    }

    public function countLikes() {
        $this->request->allowMethod('post');

        $userId = $this->request->getAttribute('identity')->get('sub');
        $articleId = $this->request->getData('article_id');

        if (!$userId || !$articleId) {
            return $this->jsonResponse(400, ['error' => 'Invalid request data.']);
        }

        $this->loadModel('Likes');

        if ($this->Likes->exists(['user_id' => $userId, 'article_id' => $articleId])) {
            return $this->jsonResponse(400, ['error' => 'You have already liked this article.']);
        }

        $like = $this->Likes->newEntity(['user_id' => $userId, 'article_id' => $articleId]);

        if (!$this->Likes->save($like)) {
            return $this->jsonResponse(400, ['error' => 'Failed to save like.']);
        }

        $likesCount = $this->Likes->find()->where(['article_id' => $articleId])->count();

        return $this->jsonResponse(200, ['likesCount' => $likesCount]);
    }

    public function Unlike($Id = null)
    {
        $this->request->allowMethod('delete');
        $userId = $this->request->getAttribute('identity')->get('sub');
        $articleId = $this->request->getAttribute('params')['id'];
        if (!$userId || !$articleId) {
            return $this->jsonResponse(400, ['error' => 'Invalid request data.']);
        }
        $this->loadModel('Likes'); 
        if (!$this->Likes->exists(['user_id' => $userId, 'article_id' => $articleId])) {
            return $this->jsonResponse(400, ['error' => 'You didn\'t like this article!']);
        }
        return $this->jsonResponse(400, ['error' => 'You can\'t cancel like on this article!']);
    }

}
