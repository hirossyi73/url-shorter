@extends('url_shorter::layout') 
@section('content')
    <div class="container" style="max-width:900px;">
    
    <div class="form-group" {!! !$errors->has('url') ? '' : 'has-error' !!}>
            <label for="url" style="margin-bottom:1px;">{{__('url_shorter::url_shorter.url')}} :</label>
            <input type="url" id="url" name="url" class="form-control" value="{{old('url')}}">
            @include('url_shorter::error', ['errorKeyFix' => 'url'])

            <button type="button" id="make_url" class="btn btn-primary">{{__('url_shorter::url_shorter.generate')}}</button>
        </div>

        <div class="form-group" {!! !$errors->has('generate_url') ? '' : 'has-error' !!}>
            <label for="url" style="margin-bottom:1px;">{{__('url_shorter::url_shorter.generate_url')}} : </label>
            <input type="url" id="generate_url" class="form-control" id="generate_url" value="">
            @include('url_shorter::error', ['errorKeyFix' => 'generate_url'])

            <button type="button" id="copy_generate_url" class="btn btn-info">{{__('url_shorter::url_shorter.copy_url')}}</button>
        </div>
    </div>


    <script>
        $('#make_url').on('click', function(){
            $.ajax({
                type: 'POST',
                url: '{{$action}}',
                data: {
                    '_token': $('meta[name="csrf-token"]').prop('content'),
                    'url': $('#url').val(),
                },
                dataType: 'json'
                })
                .done(function(data) {
                    $('#generate_url').val(data.generate_url);
                })
                .fail(function() {
                    alert('Error');
                });
        });

        $('#copy_generate_url').on('click', function(){
            $('#generate_url').select();
            document.execCommand('copy');
        });
    </script>
@endsection
