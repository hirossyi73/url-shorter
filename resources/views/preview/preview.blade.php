@extends('url_shorter::layout') 
@section('content')
    <div class="container" style="max-width:900px;">
        <div class="mb-5">
            <h3>{{__('url_shorter::url_shorter.preview.title')}}</h3>
            {{__('url_shorter::url_shorter.preview.description')}}
            <br /><a href="{{$url}}" target="_blank" rel="noopener">{{$url}}</a>
        </div>

        @if(!empty($info))
            <div class="mb-5">
                <h4>{{__('url_shorter::url_shorter.preview.info_header')}}</h4>
                @if(isset($info['title']))
                    <p>{{__('url_shorter::url_shorter.preview.info_title')}}&nbsp;:&nbsp;{{$info['title']}}</p>
                @endif
            </div>
        @endif
    </div>
@endsection
