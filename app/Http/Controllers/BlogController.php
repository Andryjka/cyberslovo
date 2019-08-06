<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Insiders;
use App\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * @param  {string}
     * @return [type]
     */
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if($slug == 'news'){
            $meta = [
                'title' => 'Инсайды и актуальные трансферы из киберспорта',
                'meta_description' => 'Инсайды и актуальные трансферы из киберспорта, CIS Esports. Чемпионаты, расписание матчей, рейтинги команд и игроков, HLTV. Блоги, телеграм-канал Cyberslovo',
                'meta_keywords' => 'Cyberslovo, телеграм, канал, инсайды, девушки, s1mple, Zeus, Natus Vincere, Virtus.pro',
            ];
        }
        elseif($slug == 'interviews'){
            $meta = [
                'title' => 'Интервью людей из мира киберспорта',
                'meta_description' => 'Эксклюзивные интервью известных игроков и киберспортсменов из России и Украины: s1mple, Zeus, v1lat, RAMZES666, Solo, Lil.',
                'meta_keywords' => 'Cyberslovo, телеграм, канал, инсайды, девушки, s1mple, Zeus, Natus Vincere, Virtus.pro',
            ];
        }
        elseif($slug == 'media'){
            $meta = [
                'title' => 'Авторкие репортажи о киберспорте в России и мире',
                'meta_description' => 'Анонсы соревнований, чемпионаты от ESL, DreamHack, StarLadder. Maincast и RuHub. Фото киберспортсменов и девушек из киберспорта.',
                'meta_keywords' => 'Cyberslovo, телеграм, канал, инсайды, девушки, s1mple, Zeus, Natus Vincere, Virtus.pro',
            ];
        }
        
        return view('blog.home')->with([
            'meta' => $meta,
            'category' => $category,
            'articles' => $category->articles()->where('published', 1)->orderBy('created_at', 'desc')->paginate(12),
            'today_news' => '',
        ]);
    }

    public function article($slug)
    {
        $article = Article::where('slug', $slug)->first();
        event('postHasViewed', $article);

        return view('blog.article')->with([

            'article' => $article,
            'news' => Article::where('published', 1)->orderBy('created_at', 'desc')->take(6)->pluck('title', 'slug'),
        ]);
    }


    /**
     * Добавление информации в БД со страницы инсайдеры
     * Adding article from insiders page
     * 
     * @param  Request
     * @return redirect
     */
    public function insider(Request $request)
    {
        $insiders = Insiders::create($request->all());

        return redirect()->back()->with('flash_message', 'Спасибо! Материал успешно отправлен!');
    }

    /**
     * Поиск и вывод новостей по названию тега
     * Search and display news by tagname
     * 
     * @param  {string}
     * @return [type]
     */
    public function articlesByTag($tag)
    {
        $tag = Tag::where('name', $tag)->first();

         $meta = [
                'title' => 'Авторкие репортажи о киберспорте в России и мире',
                'meta_description' => 'Анонсы соревнований, чемпионаты от ESL, DreamHack, StarLadder. Maincast и RuHub. Фото киберспортсменов и девушек из киберспорта.',
                'meta_keywords' => 'Cyberslovo, телеграм, канал, инсайды, девушки, s1mple, Zeus, Natus Vincere, Virtus.pro',
            ];

        return view('blog.home')->with([
            'articles' => $tag->articles()->orderBy('created_at', 'desc')->paginate(12),
            'meta' => $meta,
            'today_news' => "",
        ]);
    }

    /**
     * Поиск по материалам по входящей строке
     * Search in DB by query
     * 
     * @param  Request
     * @return [type]
     */
    public function search(Request $request)
    {
        $meta = [
                'title' => 'Результаты поиска по запросу ' . $request->input('search_query'),
                'meta_description' => 'Анонсы соревнований, чемпионаты от ESL, DreamHack, StarLadder. Maincast и RuHub. Фото киберспортсменов и девушек из киберспорта.',
                'meta_keywords' => 'Cyberslovo, телеграм, канал, инсайды, девушки, s1mple, Zeus, Natus Vincere, Virtus.pro',
        ];

        return view('blog.home')->with([
            'articles' => Article::orWhere('title', 'like', '%' . $request->input('search_query') . '%')->orWhere('description', 'like', '%' . $request->input('search_query') . '%')->paginate(10),
            'meta' => $meta,
            'today_news' => "",
        ]);
    }
}
