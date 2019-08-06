@foreach($categories as $category_list)

    <option value="{{$category_list->id ?? ""}}"
        @isset($category_id)
            @if($category_id[0] == $category_list->id)
                selected
            @endif
        @endisset
        >
        {!! $delimiter ?? "" !!}{{$category_list->title ?? ""}}
    </option>

    @if(count($category_list->children) > 0)
        @include('admin.categories.partials.categories', [
            'categories' => $category_list->children,
            'delimiter' => ' - ' . $delimiter,
        ])
    @endif
@endforeach