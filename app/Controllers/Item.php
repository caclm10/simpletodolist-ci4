<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Item as ItemModel;
use App\Models\ToDo;

class Item extends BaseController
{
    protected $itemModel;
    protected $todoModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->todoModel = new ToDo();
    }

    public function create($todoId)
    {
        $back = redirect()->to('/todo/' . $todoId)->withInput();

        $isValid = $this->validate([
            'content' => 'required|max_length[255]',
        ]);

        if (!$isValid) return $back->with('errors-item', $this->validator->getErrors());

        $isSaved = $this->itemModel->save([
            'todo_id' => $todoId,
            'item_content' => $this->request->getPost('content')
        ]);

        if (!$isSaved) return $back->with('error', 'Something went wrong when creating new Task, please try again later.');

        return redirect()->to("/todo/{$todoId}")->with('success', 'Task created successfully');
    }

    public function mark($id)
    {
        $item = $this->itemModel->find($id);

        $this->itemModel->update($id, ['is_done' => $item->is_done ? 0 : 1]);

        return $this->response->setJSON(['message' => 'Success']);
    }

    public function destroy($todoId, $itemId)
    {
        $this->itemModel->delete($itemId);

        return redirect()->to("/todo/{$todoId}")->with('success', 'Task deleted successfully');
    }
}
