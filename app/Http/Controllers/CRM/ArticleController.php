<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('crm.article.index')
            ->with('editArticle', null);
    }

    public function create()
    {
        return view('crm.article.create');
    }
}
