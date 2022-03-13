@extends('layouts.app')

@section('content')
<div class="col-md-6 p-0">
    <div class="card">
        <div class="card-header">
            memo edit
            <form class="card-body" action="{{ route('destroy') }}" method="POST">
                @csrf
                <input type="hidden" name="memo_id" value="{{ $edit_memo[0]['id'] }}" />
                <button type="submit">delete</button>
            </form>
        </div>

        <form class="card-body" action="{{ route('update') }}" method="POST">
            @csrf
            <input type="hidden" name="memo_id" value="{{ $edit_memo[0]['id'] }}" />
            <div class="form-group">
                <textarea class="form-control" name="content" rows="3" placeholder="input memo here">{{ $edit_memo[0]['content'] }}</textarea>
            </div>
             @foreach($tags as $tag)
                <div class="form-check form-check-inline mb-3">
                    <input class="form-check-input" type="checkbox" name="tags[]" id="{{ $tag['id'] }}" value="{{ $tag['id'] }}"
                        {{ in_array($tag['id'], $include_tags) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $tag['id'] }}">{{ $tag['name'] }}</label>
                </div>
             @endforeach
                <input type="text" class="form-control w-50 mb-3" name="new_tag" placeholder="please input new tag">
                <button type="submit" class="btn btn-primary">update</button>
        </form>
    </div>
</div>
@endsection
