<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ToDo extends Entity
{
    protected $datamap = [
        'title' => 'todo_title',
        'id' => 'todo_id',
        'content' => 'item_content'
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
