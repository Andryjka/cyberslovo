<div class="form-group">
    <label for="">Статус</label>
    <select class="form-control" name="published">
        @if(isset($article->id))
            <option value="0" @if($article->published == 0) selected @endif> Не опубликовано</option>
            <option value="1" @if($article->published == 1) selected @endif> Опубликовано</option>
        @else
            <option value="0">Не опубликовано</option>
            <option value="1">Опубликовано</option>
        @endif
    </select>
</div>

<div class="form-group">
    <label for="">Наименование</label>
    <input type="text" class="form-control" name="title" placeholder="Заголовок статьи" value="{{$article->title ?? ""}}" required>
</div>

<div class="form-group">
    <label for="">Slug</label>
    <input type="text" class="form-control" name="slug" placeholder="Автоматическая генерация" value="{{$article->slug ?? ""}}" readonly>
</div>

<div class="form-group">
    <label for="">Родительская категория</label>
    <select class="form-control" name="categories[]">
            @include('admin.categories.partials.categories', ['categories' => $categories])
    </select>
</div>

<div class="form-group">
    <label for="">Теги</label>
    @if(Route::currentRouteName() == 'admin.article.edit')
    <select id="tag_list" style="height: 250px;" class="form-control" name="tags[]" multiple>
        @foreach($tags as $key => $value)    
        <option value="{{$key}}" @foreach($article->getTagsList() as $tag) @if($key == $tag) selected @endif @endforeach>{{$value}}</option>
        @endforeach      
    </select>
    @else
    <select id="tag_list" style="height: 250px;" class="form-control" name="tags[]" multiple>
        @foreach($tags as $key => $value)    
        <option value="{{$key}}">{{$value}}</option>
        @endforeach      
    </select>
    @endif
</div>

<div class="form-group">
    <label for="">Ссылка на источник</label>
    <input type="text" name="source" placeholder="источник" class="form-control" value="{{$article->source ?? ""}}">
</div>

<div class="form-group">
    <label for=""><strong>Изображение для превью</strong></label><br>
    <input name="preview_image" type="file">
    <img style="width:250px;" src="{{$article->image ?? ""}}" alt="">
</div>

<div class="form-group">
    <label for="">Краткое описание</label>
    <textarea class="form-control" id="description_short" name="description_short" placeholder="Небольшое описание статьи для карточек соц. сетей" required>{{$article->description_short ?? ""}}</textarea>
</div>

<div class="form-group">
    <label for="">Полное описание</label>
    <textarea class="form-control" id="description" name="description">{{$article->description ?? ""}}</textarea>
</div>

<div class="form-group">
    <label for="">SEO Title</label>
    <input data-field="seo_title" type="text" class="form-control" name="meta_title" placeholder="Оптимальная длина Title – от 40 до 100 символов, например: Ремонт квартиры под ключ в Москве" value="{{$article->meta_title ?? ""}}">
    <span data-field="count1"></span>
</div>

<div class="form-group">
    <label for="">SEO Description</label>
    <input data-field="seo_description" type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Длина description не должна превышать 500 символов с пробелами для Яндекса и 150 для Google." value="{{$article->meta_description ?? ""}}">
    <span data-field="count2"></span>
</div>

<div class="form-group">
    <label for="">SEO Keywords</label>
    <input type="text" class="form-control" name="meta_keywords" placeholder="ключевые слова (через запятую)" value="{{$article->meta_keywords ?? ""}}">
    
</div>

<div class="form-group">
    <label for="">RSS текст</label>
    <textarea id="other" rows="5" type="text" class="form-control" name="rss_content" placeholder="текст материала без встраиваний">{{$article->rss_content ?? ""}}</textarea>
</div>


<hr>

@section('admin-footer')

    <script>
        $('#tag_list').select2();
    </script>

    <script>
        $(function () {
            var count1 = $('[data-field="count1"]');
            var count2 = $('[data-field="count2"]');

            $(document).on('input', '[data-field="seo_title"]', function () {
                var item = $(this);

                count1.html(item.val().length);
            });

            $(document).on('input', '[data-field="seo_description"]', function () {
                var item = $(this);

                count2.html(item.val().length);
            });
        });
    </script>
@endsection