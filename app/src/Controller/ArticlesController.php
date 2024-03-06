<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

class ArticlesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event) {

        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['index','view']);
    }

    public function index() {
        $articles = $this->Articles->find('all')->toArray();
        return $this->jsonResponse(200, $articles);
    }

    public function view($id = null) {
        $article = $this->Articles->get($id);
        return $this->jsonResponse(200, $article);
    }

    public function add() {
        $this->request->allowMethod('post');
        $requestData = $this->request->input('json_decode', true);
        $article = $this->Articles->newEntity($requestData);

        if ($this->Articles->save($article)) {
            return $this->jsonResponse(201, ['message' => 'The article has been saved.']);
        } else {
            return $this->jsonResponse(400, ['error' => 'Unable to add the article.']);
        }
    }

    public function edit($id = null) {
        $article = $this->Articles->get($id);

        if ($this->request->is(['post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());

            if ($this->Articles->save($article)) {
                return $this->jsonResponse(200, ['message' => 'The article has been updated.']);
            } else {
                return $this->jsonResponse(400, ['error' => 'Unable to update the article.']);
            }
        }
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
    
        $article = $this->Articles->find()->where(['id' => $id])->first();
    
        if (!$article) {
            return $this->jsonResponse(404, ['error' => 'Article not found']);
        }
    
        if ($this->Articles->delete($article)) {
            return $this->jsonResponse(200, ['message' => 'The article has been deleted.']);
        } else {
            return $this->jsonResponse(400, ['error' => 'Unable to delete the article.']);
        }
    }


}