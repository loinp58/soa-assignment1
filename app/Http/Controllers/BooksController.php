<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Book;
use App\Http\Requests;
class BooksController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $books = Book::paginate(10);
        return view('books.index', compact('books'));
    }

    public function show($id) {
        $book = Book::where('id', $id)->first();
        return view('books.show', compact('book'));
    }

    public function search(Request $request) {
        $data = $request->all();
        $query = $data['query'];
        switch($data['search_criteria']) {
            case 'isbn10':
                $books = Book::where('isbn10', 'like', '%'.$query.'%')->paginate(10);
                return view('books.search', compact('books', 'query'));
                break;
            case 'isbn13':
                $books = Book::where('isbn13', 'like', '%'.$query.'%')->paginate(10);
                return view('books.search', compact('books', 'query'));
                break;
            case 'name':
                $books = Book::where('name', 'like', '%'.$query.'%')->paginate(10);
                return view('books.search', compact('books', 'query'));
                break;
            case 'author':
                $books = Book::where('author', 'like', '%'.$query.'%')->paginate(10);
                return view('books.search', compact('books', 'query'));
                break;
        }
    }
}
