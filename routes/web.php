<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//URL::forceScheme('https');

Route::get('/category/{slug?}', 'BlogController@category')->name('category');
Route::get('/blog/{slug?}', 'BlogController@article')->name('article');
Route::get('/tag/{name?}', 'BlogController@articlesByTag')->name('articles.tags');


Route::group(['prefix' => 'cyberpunk', 'namespace' => 'Admin', 'middleware' => ['auth']], function(){
    //Route::get('/', 'DashboardController@index')->name('admin.index');
    Route::get('/', function(){
        return redirect('/cyberpunk/article');
    })->name('admin.index');
    Route::get('/insiders', 'DashboardController@insidersView')->name('admin.insiders');
    Route::post('/insiders-destroy', 'DashboardController@insidersDestroy')->name('admin.insider.destroy');
    Route::resource('/category', 'CategoryController', ['as' => 'admin']);
    Route::resource('/article', 'ArticleController', ['as' => 'admin']);
    Route::resource('/tags', 'TagsController', ['as' => 'admin']);
    Route::resource('/today', 'TodayController', ['as' => 'admin']);
});

Route::group(['prefix' => 'cyberpunk', 'namespace' => 'Auth', 'middleware' => ['auth']], function(){

  Route::get('/profile/{user}', 'UserController@edit')->name('user.profile');
  Route::patch('/profile/{user}/update', 'UserController@update')->name('user.update');

  Route::get('/password/{user}', 'UserController@password_edit')->name('user_password.edit');
  Route::patch('/password/{user}/update', 'UserController@password_update')->name('user_password.update');

});


Route::get('/', function () {
	$meta = [
		'title' => 'CYBERSLOVO - авторский портал о киберспорте, интервью, репортажи, новости, трансферы, турниры, расписание матчей',
		'meta_description' => 'Эксклюзивные новости киберспорта, авторские интервью, аналитика, репортажи. Статистика киберспортсменов и команд, комментаторов и игроков. CS:GO, Dota2, DotaUnderlords, Fornite, PUBG, LoL, Hearthstone и все другие игры.',
		'meta_keywords' => 'Cyberslovo, телеграм, канал, инсайды, девушки, s1mple, Zeus, Natus Vincere, Virtus.pro',
	];

    $today = App\Today::where('published', 1)->orderBy('sort', 'asc')->take(3)->get();

    return view('blog.home')->with([
    		'meta' => $meta,  
    		'articles' => \App\Article::where('published', 1)->orderBy('created_at', 'desc')->paginate(10),
            'today_news' => $today,
        ]);
});

Route::get('/insider', function(){
    $meta = [
        'title' => 'Актуальные трансферы и слухи из мира киберспорта',
        'meta_description' => 'Слухи и мысли из мира киберспорта, переходы в СНГ из клубов Virtus.pro, Natus Vincere, Gambit Esports, Team Spirit, Vega Squadron, Winstrike',
        'meta_keywords' => 'Cyberslovo, телеграм, канал, инсайды, девушки, s1mple, Zeus, Natus Vincere, Virtus.pro',
    ];
    return view('blog.insider')->with('meta', $meta);

})->name('insider');

Route::post('/insider-add', 'BlogController@insider')->name('insider.add');

Route::post('/search', 'BlogController@search')->name('search');

Route::get('/short', function(){

    $meta = [
        'title' => '#ВКУРСЕ — главные киберспортивные новости. Коротко. ',
        'meta_description' => 'Основные новости из мира киберспорта и гейминга. Главные цифры, крутые фото, лучшие моменты и другие фишки по итогам дня по всем дисциплинам: CS:GO, Dota, Fornite, PUBG, LoL, Hearthstone и остальные игры.',
        'meta_keywords' => 'Cyberslovo, телеграм, канал, инсайды, девушки, s1mple, Zeus, Natus Vincere, Virtus.pro',
    ];

    return view('blog.vkurse')->with([
        'short_news' => App\Today::where('published', 1)->orderBy('created_at', 'desc')->paginate(10),
        'meta' => $meta,
    ]);
});

Route::get('/test', function(){
    return view('blog.test');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/feed', function(){

    // create new feed
    $feed = App::make("feed");

    // multiple feeds are supported
    // if you are using caching you should set different cache keys for your feeds

    // cache the feed for 60 minutes (second parameter is optional)
    $feed->setCache(60, 'laravelFeedKey');

    // check if there is cached feed and build new only if is not
    if (!$feed->isCached())
    {
       // creating rss feed with our most recent 20 posts
       $posts = App\Article::orderBy('created_at', 'desc')->take(20)->get();

       // set your feed's title, description, link, pubdate and language
       $feed->title = 'CYBERSLOVO';
       $feed->description = 'Основные новости из мира киберспорта и гейминга. Главные цифры, крутые фото, лучшие моменты и другие фишки по итогам дня по всем дисциплинам: CS:GO, Dota, Fornite, PUBG, LoL, Hearthstone и остальные игры.';
       $feed->logo = 'https://cyberslovo.ru/images/logo_main.png';
       $feed->link = url('feed');
       $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
       $feed->pubdate = $posts[0]->created_at;
       $feed->lang = 'ru';
       $feed->setShortening(true); // true or false
       $feed->setTextLimit(200); // maximum length of description text

       foreach ($posts as $post)
       {
           // set item's title, author, url, pubdate, description, content, enclosure (optional)*
           $feed->add($post->title, 'Garik Swarovskiy', URL::to($post->slug), $post->created_at, $post->description_short, $post->description);
       }

    }

    // first param is the feed format
    // optional: second param is cache duration (value of 0 turns off caching)
    // optional: you can set custom cache key with 3rd param as string
    return $feed->render('dzen');

    // to return your feed as a string set second param to -1
    // $xml = $feed->render('atom', -1);
});

Route::get('/rss', function(){

    // create new feed
    $feed = App::make("feed");

    // multiple feeds are supported
    // if you are using caching you should set different cache keys for your feeds

    // cache the feed for 60 minutes (second parameter is optional)
    $feed->setCache(60, 'laravelFeedKey');

    // check if there is cached feed and build new only if is not
    if (!$feed->isCached())
    {
       // creating rss feed with our most recent 20 posts
       $posts = App\Article::orderBy('created_at', 'desc')->take(20)->get();

       // set your feed's title, description, link, pubdate and language
       $feed->title = 'CYBERSLOVO';
       $feed->description = 'Основные новости из мира киберспорта и гейминга. Главные цифры, крутые фото, лучшие моменты и другие фишки по итогам дня по всем дисциплинам: CS:GO, Dota, Fornite, PUBG, LoL, Hearthstone и остальные игры.';
       $feed->logo = 'https://cyberslovo.ru/images/logo_main.png';
       $feed->link = url('rss');
       $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
       $feed->pubdate = $posts[0]->created_at;
       $feed->lang = 'ru';
       $feed->setShortening(true); // true or false
       $feed->setTextLimit(200); // maximum length of description text

       foreach ($posts as $post)
       {
           // set item's title, author, url, pubdate, description, content, enclosure (optional)*
           $feed->add($post->title, 'CYBERSLOVO', URL::to($post->slug), $post->created_at, $post->description_short, $post->rss_content);
       }

    }

    // first param is the feed format
    // optional: second param is cache duration (value of 0 turns off caching)
    // optional: you can set custom cache key with 3rd param as string
    return $feed->render('rss');

    // to return your feed as a string set second param to -1
    // $xml = $feed->render('atom', -1);
});

