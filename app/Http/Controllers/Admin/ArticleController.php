<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use Spatie\Sitemap\SitemapGenerator;
use App\User;
use Auth;

class ArticleController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:article-list|article-create|article-edit|article-delete', ['only' => ['index','show']]);
         $this->middleware('permission:article-create', ['only' => ['create','store']]);
         $this->middleware('permission:article-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:article-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.articles.index')->with([
            'articles' => Article::orderBy('created_at', 'desc')->with('author')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::pluck('name', 'id');

        return view('admin.articles.create')->with([
            'article' => [],
            'categories' => Category::with('children')->where('parent_id', 0)->get(),
            'delimiter' => '',
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('preview_image')){
            $siteUrl = 'https://cyberslovo.ru';
            $filePath = Storage::putFile('public/preview_images', $request->file('preview_image'));
            $url = $siteUrl . Storage::url($filePath);

        }
        $article = Article::create($request->all() + ['image' => $url]);  

        if($request->input('categories')){
            $article->categories()->attach($request->input('categories'));
        }

        if($request->input('tags')){
            $article->tags()->attach($request->input('tags'));
        }

        if($request->input('author')){
            $article->tags()->attach($request->input('author'));
        }
        
         return redirect()->route('admin.article.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $tags = Tag::orderBy('name', 'asc')->pluck('name', 'id');

        return view('admin.articles.edit')->with([
            'article' => $article,
            'categories' => Category::with('children')->where('parent_id', 0)->get(),
            'delimiter' => '',
            'category_id' => $article->categories()->pluck('id'),
            'tags' => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        
        if($request->file('preview_image')){
            $siteUrl = 'https://cyberslovo.ru';
            $filePath = Storage::putFile('public/preview_images', $request->file('preview_image'));
            $url = $siteUrl . Storage::url($filePath);
            $article->update($request->except('slug') + ['image' => $url]);
        }
        else{
            $article->update($request->except('slug'));
        }

        $article->categories()->detach();

        if($request->input('categories')){
            $article->categories()->attach($request->input('categories'));
        }

        if($request->input('tags')){
            $article->tags()->sync($request->input('tags'));
        }

        if($request->input('author')){
            $article->tags()->attach($request->input('author'));
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.article.index');
    }
}
