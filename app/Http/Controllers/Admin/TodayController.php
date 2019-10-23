<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Today;
use Storage;

class TodayController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:vkurse-list|vkurse-create|vkurse-edit|vkurse-delete', ['only' => ['index','show']]);
         $this->middleware('permission:vkurse-create', ['only' => ['create','store']]);
         $this->middleware('permission:vkurse-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:vkurse-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.today.index')->with([
            'today_news' => Today::orderBy('created_at', 'desc')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.today.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('image')){
            $siteUrl = 'https://cyberslovo.ru';
            $filePath = Storage::putFile('public/preview_images', $request->file('image'));
            $url = $siteUrl . Storage::url($filePath);
            $today = Today::create($request->except('image') + ['image' => $url]);
        }
        else{
            $today = Today::create($request->all());
        }

        return redirect()->route('admin.today.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Today $today)
    {
        return view('admin.today.edit')->with([
            'today' => $today,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Today $today)
    {
        if($request->file('image')){
            $siteUrl = 'https://cyberslovo.ru';
            $filePath = Storage::putFile('public/preview_images', $request->file('image'));
            $url = $siteUrl . Storage::url($filePath);
            $today->update($request->except('image') + ['image' => $url]);
        }
        else{
            $today->update($request->all());
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Today $today)
    {
        $today->delete();

        return redirect()->route('admin.today.index');
    }
}
