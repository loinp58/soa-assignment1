@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <table class="table table-striped table-bordered">
            <thead>
                <h2 style="text-align:center">Kết quả tìm kiếm</h2>
                <p>
                    Kết quả tìm kiếm với từ khóa <b>"{{$query}}"</b>
                </p>
            </thead>
            <tbody>
                <tr class="info">
                    <th>
                        ISBN 10
                    </th>
                    <th>
                        ISBN 13
                    </th>
                    <th>
                        Tên
                    </th>
                    <th>
                        Tác giả
                    </th>
                    <th>
                        Mô tả sách
                    </th>
                    <th>
                        Thao tác
                    </th>
                </tr>
                @if(sizeof($books))
                    @foreach($books as $book)
                        <tr>
                            <td>
                                {{$book->isbn10}}
                            </td>
                            <td>
                                {{$book->isbn13}}
                            </td>
                            <td>
                                {{$book->name}}
                            </td>
                            <td>
                                {{$book->author}}
                            </td>
                            <td>
                                {{substr($book->description, 0, strpos($book->description, ' ', 50))}}...
                            </td>
                            <td>
                                <a href="{{ action('BooksController@show', [$book->id], false) }}"><button type="button" name="button" class="btn btn-md btn-primary">Xem chi tiết</button></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <p>
                        Không tìm thấy thông tin sách giống với yêu cầu của bạn! Bạn vui lòng <a href="{{ action('BooksController@index', [], false) }}">quay lại</a> và chọn sách khác nhé!
                    </p>
                @endif
            </tbody>
        </table>
        {{$books->links()}}
    </div>
</div>
@stop
