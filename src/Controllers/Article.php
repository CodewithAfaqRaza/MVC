<?php

namespace App\Controllers;

use App\Models\Article as ArticleModel;
use App\Models\Entity;
use Framework\EntityController;

class Article extends EntityController
{
    public function __construct(ArticleModel $model)
    {
        parent::__construct($model);
    }

protected array $columns = [
    'title',
    'description'
];

}