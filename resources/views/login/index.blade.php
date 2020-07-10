@extends('url_shorter::layout') 
@section('content')
    <div class="container" style="max-width:900px;">
    <form action="{{$action}}" method="POST">
        <div class="form-group" {!! !$errors->has('password') ? '' : 'has-error' !!}>
            <label for="password" style="margin-bottom:1px;">{{__('url_shorter::url_shorter.password')}} :</label>
            <input type="password" id="password" name="password" class="form-control" required>

            @include('url_shorter::error', ['errorKeyFix' => 'password'])
        </div>

        {{ csrf_field() }}
        <input type="submit" class="btn btn-primary" value="{{__('url_shorter::url_shorter.login')}}" />
    </form>
@endsection
