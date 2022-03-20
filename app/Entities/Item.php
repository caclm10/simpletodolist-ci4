<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Item extends Entity
{
    protected $datamap = [
        'id' => 'item_id',
        'content' => 'item_content',
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
}
