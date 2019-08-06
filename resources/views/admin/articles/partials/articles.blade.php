@foreach($categories as $category)

    <option value="{{$category->id ?? ""}}"
        @isset($category->id)
            @foreach($article->categories as $category_article)
                @if($category->id == $category_article->id)
                selected
                @endif
            @endforeach
        @endisset
        >
        {!! $delimiter ?? "" !!}{{$category->title ?? ""}}
    </option>

    @if(count($category->children) > 0)
        @include('admin.categories.partials.categories', [
            'categories' => $category->children,
            'delimiter' => ' - ' . $delimiter,
        ])
    @endif
@endforeach