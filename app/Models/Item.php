<?php

namespace App\Models;

use CodeIgniter\Model;

class Item extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'items';
    protected $primaryKey       = 'item_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = \App\Entities\Item::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'todo_id', 'item_content', 'is_done'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function todo($id)
    {
        return $this
            ->join('todos', 'items.todo_id = todos.todo_id')
            ->where('items.todo_id', $id)
            ->find();
    }

    public function todoItem($id)
    {
        return $this
            ->join('todos', 'items.todo_id = todos.todo_id')
            ->where('items.item_id', $id)
            ->first();
    }
}
