
@extends('layouts.app')
@section('content')
    <div class="row">
        @if($book)
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2 style="text-align:center">Thông tin sách</h2>
                    </div>
                    <div class="panel-body" style="text-align:center">
                        <h3 style="color: #430c04">{{$book->name}}</h3>
                        <p>{{$book->description}}</p>
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-info"><b>ISBN10:</b> {{$book->isbn10}}</li>
                            <li class="list-group-item list-group-item-info"><b>ISBN13:</b> {{$book->isbn13}}</li>
                            <li class="list-group-item list-group-item-info"><b>Tác giả:</b> {{$book->author}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        @else
            <p>
                Không thể tìm thấy thông tin sách. Bạn vui lòng <a href="{{ action('BooksController@index', [], false) }}">quay lại</a> và chọn sách khác nhé!
            </p>
        @endif
    </div>
@stop
