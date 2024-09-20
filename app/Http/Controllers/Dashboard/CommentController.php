<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\CommentsDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends BackendController
{
    public function __construct(CommentsDataTable $dataTable, Comment $data)
    {
        // $this->middleware(['permission:Display Comments|عرض التعليقات'], ['only' => ['index', 'show']]);
      

        parent::__construct($dataTable, $data);
    }
}
