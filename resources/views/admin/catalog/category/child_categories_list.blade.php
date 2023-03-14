<tr>

    <td>{{$childCategory->id}}</td>
    <td>{!! $delimiter ?? '–&nbsp;'!!}<a href="{{route('product.list', $childCategory->id)}}">{{$childCategory->name}}</a></td>
    <td class="text-center">{{$childCategory->sort}}</td>
    <td class="{{ $childCategory->active === 1 ? 'green-icon' : 'pale-icon'}}"><i class="far fa-check-circle"></i></td>
    <td>
        <a href="{{ route('category.edit', $childCategory->id) }}" class="btn btn-xs btn-info mx-1 shadow"><i class="fa fa-lg fa-fw fa-pen"></i></a>
        <form method="POST" action="{{ route('category.destroy', $childCategory->id) }}" class="formDelete">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-xs btn-danger mx-1 shadow delete" onclick="return confirm('Подтвердите удаление')"><i class="fa fa-lg fa-fw fa-trash"></i></button>
        </form>
    </td>
</tr>
@if(count($childCategory->children)>0)
    @foreach ($childCategory->children as $childCategory)
        @include('admin.catalog.category.child_categories_list', ['childCategory' => $childCategory, 'delimiter' => '&nbsp;–&nbsp;' . '–&nbsp;'])
    @endforeach
@endif
