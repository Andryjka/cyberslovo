<div class="form-group">
    <label for="">Статус</label>
    <select class="form-control" name="published">
        @if(isset($today->id))
            <option value="0" @if($today->published == 0) selected @endif> Не опубликовано</option>
            <option value="1" @if($today->published == 1) selected @endif> Опубликовано</option>
        @else
            <option value="0">Не опубликовано</option>
            <option value="1">Опубликовано</option>
        @endif
    </select>
</div>

<div class="form-group">
    <label for="">Номер позиции на главной</label>
    <select class="form-control" name="sort">
        @if(isset($today->sort))
            <option value="10" @if($today->sort == 10) selected @endif> Не отображать</option>
            <option value="0" @if($today->sort == 0) selected @endif> Первая</option>
            <option value="1" @if($today->sort == 1) selected @endif> Вторая</option>
            <option value="2" @if($today->sort == 2) selected @endif> Третья</option>
        @else
            <option value="10">Не отображать</option>
            <option value="0">Первая</option>
            <option value="1">Вторая</option>
            <option value="2">Третья</option>
        @endif
    </select>
</div>


<div class="form-group">
    <label for="">Инфоповод</label>
    <input type="text" class="form-control" name="today" placeholder="например: новость дня" value="{{$today->today ?? ""}}" required>
</div>

<div class="form-group">
    <label for="">Заголовок инфоповода</label>
    <input type="text" class="form-control" name="title" placeholder="здесь заголовок инфоповода" value="{{$today->title ?? ""}}">
</div>

<div class="form-group">
    <label for="">Детальное описание инфоповода</label>
    <textarea rows="5" type="text" class="form-control" name="description" placeholder="здесь текст инфоповода">{{$today->description ?? ""}}</textarea>
</div>

<div class="form-group">
    <label for=""><strong>Изображение для фона (если надо)</strong></label><br>
    <input name="image" type="file">
    <img style="width:250px;" src="{{$today->image ?? ""}}" alt="">
</div>

<div class="form-group">
    <label for="">Цвет фона для блока (если нет изображения)</label>
    <input type="text" class="form-control" name="color" placeholder="например: #B02300" value="{{$today->color ?? ""}}">
</div>

<div class="form-group">
    <label for="">Источник информации</label>
    <input type="text" class="form-control" name="source" placeholder="например: Cybersport.ru" value="{{$today->source ?? ""}}">
</div>

<div class="form-group">
    <label for="">Выводить фото из фона на ленту</label>
    <select class="form-control" name="photo_published">
        @if(isset($today->photo_published))
            <option value="0" @if($today->photo_published == 0) selected @endif> Нет, не выводить</option>
            <option value="1" @if($today->photo_published == 1) selected @endif> Да, выводить</option>
        @else
            <option value="0">Нет, не выводить</option>
            <option value="1">Да, выводить</option>
        @endif
    </select>
</div>

<div class="form-group">
    <label for="">Дополнительное описание инфоповода для фида (для видео, твитча и ютуба)</label>
    <textarea id="description" rows="5" type="text" class="form-control" name="description_feed" placeholder="здесь текст инфоповода">{{$today->description_feed ?? ""}}</textarea>
</div>

<div class="form-group">
    <label for="">Значок для карточки</label>
    <input type="text" class="form-control" value="{{$today->card_icon ?? ""}}" name="card_icon" placeholder="здесь код значка из fontawesome">
</div>

<hr>

