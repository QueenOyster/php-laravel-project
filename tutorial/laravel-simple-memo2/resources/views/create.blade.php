@extends('layouts.app')

@section('content')
<div class="col-md-6 p-0">
    <div class="card">
        <div class="card-header">new memo create</div>
        <form class="card-body" action="{{ route('store') }}" method="POST">
            @csrf
            <div class="form-group">
                <textarea class="form-control mb-2" name="content" rows="3" placeholder="input memo here"></textarea>
            </div>
            @foreach($tags as $tag)
                <div class="form-check form-check-inline mb-3">
                    <input class="form-check-input" type="checkbox" name="tags[]" id="{{ $tag['id'] }}" value="{{ $tag['id'] }}">
                    <label class="form-check-label" for="{{ $tag['id'] }}"?>{{ $tag['name'] }}</label>
                </div>
            @endforeach
            <input type="text" class="form-control w-50 mb-2" name="new_tag" placeholder="please input new tag">
            <button type="submit" class="btn btn-primary">save</button>
        </form>
    </div>
</div>
@endsection
