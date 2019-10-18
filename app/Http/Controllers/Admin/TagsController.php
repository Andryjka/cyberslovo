<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;

class TagsController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:tags-list|tags-create|tags-edit|tags-delete', ['only' => ['index','show']]);
         $this->middleware('permission:tags-create', ['only' => ['create','store']]);
         $this->middleware('permission:tags-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:tags-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
    	return view('admin.tags.index')->with([
    		'tags' =>  Tag::orderBy('created_at', 'desc')->paginate(15),
    	]);
    }

    public function create()
    {
    	return view('admin.tags.create');
    }

    public function store(Request $request)
    {
    	$tag = $request->input('name');
    	$tag = explode(",", $tag);
    	foreach($tag as $value){
    		Tag::create([
    			'name' => $value,
    		]);
    	}

    	return redirect()->route('admin.tags.index');
    }

    public function edit(Tag $tag)
    {

    	return view('admin.tags.edit')->with([
    		'tag' => $tag, 
    	]);
    }

    public function update(Request $request, Tag $tag)
    {
    	$tag->update($request->all());

    	return redirect()->route('admin.tags.index');
    }

    public function destroy(Tag $tag)
    {
    	$tag->delete();

    	return redirect()->route('admin.tags.index');
    }
}
