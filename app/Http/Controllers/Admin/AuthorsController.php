<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AuthorsController extends Controller
{
	/**
	 * Вывод материалов конкретного автора
	 * 
	 */
    public function index()
    {
    	$author = User::where('id', Auth:id())->first();

    	return view('admin.articles.index')->with([
    		'articles' => $author->articles()->orderBy('created_at', 'desc')->paginate(10),
    	]);
    }
}
