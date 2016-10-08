<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Http\Requests;

class ApiController extends Controller
{
    public function index() {
        $books = Book::all();
        return response()->json([
            'state' => 'success',
            'books' => $books
        ]);
    }

    public function show() {
        $data = $_GET;
        if(isset($data) && isset($data['id']) && $data['id'] != "") {
            $book = Book::where('id', $data['id'])->first();
            if($book) {
                return response()->json([
                    'error' => false,
                    'book' => $book
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'msg' => 'Không tìm thấy sách! Vui lòng thử lại sau!'
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'msg' => 'ID không hợp lệ! Vui lòng kiểm tra lại!'
            ]);
        }
    }

    public function create(Request $request) {
        $data = $request->all();
        $validator = \Validator::make($data, [
            'isbn10' => 'required|unique:books|string|size:10',
            'isbn13' => 'required|unique:books|string|size:13',
            'name' => 'required|string',
            'author' => 'required|string',
            'description' => 'string'
        ], [
            'isbn10.required' => 'Mã ISBN10 không được để trống!',
            'isbn10.unique' => 'Mã ISBN10 đã tồn tại!',
            'isbn10.size' => 'Mã ISBN10 không chính xác!',
            'isbn13.required' => 'Mã ISBN13 không được để trống!',
            'isbn13.unique' => 'Mã ISBN13 đã tồn tại!',
            'isbn13.size' => 'Mã ISBN13 không chính xác!',
            'name.required' => 'Tên sách không được để trống!',
            'author.required' => 'Tên tác giả không được để trống'
        ]);
        if($validator->fails()) {
            return response()->json([
                'state' => 'invalid',
                'msg' => $validator->errors()->all()
            ]);
        }
        $book = new Book;
        $book->isbn10 = $data['isbn10'];
        $book->isbn13 = $data['isbn13'];
        $book->name = $data['name'];
        $book->author = $data['author'];
        $book->description = isset($data['description']) ? $data['description'] : "";
        if($book->save()) {
            return response()->json([
                'state' => 'success',
                'msg' => 'Tạo mới thành công!'
            ]);
        } else {
            return response()->json([
                'state' => 'failed',
                'msg' => 'Có lỗi trong quá trình tạo! Vui lòng thử lại!'
            ]);
        }
    }
    public function edit(Request $request) {
        $data = $request->all();
        if(isset($data)) {
            $validator = \Validator::make($data, [
                'isbn10' => 'required|string|size:10',
                'isbn13' => 'required|string|size:13',
                'name' => 'required|string',
                'author' => 'required|string',
                'description' => 'string'
            ], [
                'isbn10.required' => 'Mã ISBN10 không được để trống!',
                'isbn10.size' => 'Mã ISBN10 không chính xác!',
                'isbn13.required' => 'Mã ISBN13 không được để trống!',
                'isbn13.size' => 'Mã ISBN13 không chính xác!',
                'name.required' => 'Tên sách không được để trống!',
                'author.required' => 'Tên tác giả không được để trống'
            ]);
            if($validator->fails()) {
                return response()->json([
                    'error' => 'invalid',
                    'msg' => $validator->errors()->all()
                ]);
            }
            if(isset($data['id']) && $data['id'] != "") {
                $book = Book::where('id', $data['id'])->first();
                if($book) {
                    $validator_2 = \Validator::make($data, [
                        'isbn10' => 'unique:books,' . $book->isbn10,
                        'isbn13' => 'unique:books,' . $book->isbn13
                    ], [
                        'isbn10.unique' => 'Mã ISBN10 đã tồn tại!',
                        'isbn13.unique' => 'Mã ISBN13 đã tồn tại!',
                    ]);

                    $book->isbn10 = $data['isbn10'];
                    $book->isbn13 = $data['isbn13'];
                    $book->name = $data['name'];
                    $book->author = $data['author'];
                    $book->description = isset($data['description']) ? $data['description'] : "";
                    if($book->save()) {
                        return response()->json([
                            'state' => 'success',
                            'msg' => 'Thay đổi thành công'
                        ]);
                    } else {
                        return response()->json([
                            'state' => 'failed',
                            'msg' => 'Có lỗi trong quá trình cập nhật. Vui lòng thử lại sau!'
                        ]);
                    }
                }
            }
        }
    }
    
    public function destroy(Request $request) {
        $data = $request->all();
        $book = Book::where('id', $data['id'])->first();
        if($book) {
            if($book->delete()) {
                return response()->json([
                    'state' => 'success',
                    'msg' => 'Xóa thành công!' 
                ]);
            } else {
                return response()->json([
                    'state' => 'failed',
                    'msg' => 'Có lỗi trong quá trình xóa. Vui lòng thử lại sau!'
                ]);
            }
        }
    }
}
