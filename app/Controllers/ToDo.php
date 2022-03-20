<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Item;
use App\Models\ToDo as ToDoModel;

class Todo extends BaseController
{
    protected $todoModel;
    public function __construct()
    {
        $this->todoModel = new ToDoModel();
    }
    public function index()
    {
        $errorsProfile = session('errors-profile');
        $errorsTodo = session('errors-todo');

        $todos = $this->todoModel->orderBy('created_at', 'DESC')->find();

        return view('todos', [
            'errorsProfile' => (object) $errorsProfile,
            'errorsTodo' => (object) $errorsTodo,
            'todos' => $todos,
        ]);
    }

    public function create()
    {
        $back = redirect()->to('/todo')->withInput();

        $isValid = $this->validate([
            'title' => 'required|max_length[70]',
        ]);

        if (!$isValid) return $back->with('errors-todo', $this->validator->getErrors());

        $isSaved = $this->todoModel->save([
            'user_id' => auth_id(),
            'todo_title' => $this->request->getPost('title')
        ]);

        if (!$isSaved) return $back->with('error', 'Something went wrong when creating new To-Do, please try again later.');

        return redirect()->to("/todo/{$this->todoModel->getInsertID()}");
    }

    public function show($id)
    {
        $itemModel = new Item();
        $items = $itemModel->todo($id);
        $todo = $this->todoModel->find($id);

        $errorsItem = session('errors-item');
        return view('items', [
            'items' => $items,
            'todo' => $todo,
            'errorsItem' => (object) $errorsItem,
        ]);
    }

    public function destroy($id)
    {
        $this->todoModel->delete($id);

        return redirect()->to("/todo")->with('success', 'To-Do deleted successfully');
    }
}
