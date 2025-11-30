<?php

namespace Controller;

use Model\Book;
use Model\Reader;
use Src\View;
use Src\Request;
use Src\Validator\Validator;

class BookController
{
    public function create(): string
    {
        return new View('site/create-book');
    }

    public function store(Request $request): string
    {
        $data = $request->all();
        $coverPath = null;
        $rules = [
            'title' => 'required',
            'author' => 'required',
            'published_year' => 'required',
            'price' => 'required',
        ];

        foreach ($rules as $field => $ruleString) {
            $rules[$field] = explode('|', $ruleString);
        }

        $validator = new Validator($data, $rules);

        if ($validator->fails()) {
            return new View('site/create-book', [
                'errors' => $validator->errors(),
                'old' => $data
            ]);
        }

        if (isset($_FILES['cover_file']) && $_FILES['cover_file']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/uploads/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

            $fileName = time() . '_' . $_FILES['cover_file']['name'];
            $targetPath = $uploadDir . $fileName;

            move_uploaded_file($_FILES['cover_file']['tmp_name'], $targetPath);
            $coverPath = '/uploads/' . $fileName;
        }

        Book::create([
            'title' => $data['title'],
            'author' => $data['author'],
            'published_year' => $data['published_year'],
            'price' => $data['price'],
            'is_new_edition' => isset($data['is_new_edition']),
            'description' => $data['description'],
            'cover_url' => $coverPath,
        ]);

        return new View('site/create-book', [
            'message' => 'Книга добавлена!'
        ]);
    }

    public function list(): string
    {
        return new View('site.list_books', ['books' => Book::all()]);
    }

    public function issueForm(): string
    {
        return new View('site.issue_book', [
            'books' => Book::all(),
            'readers' => Reader::all()
        ]);
    }

    public function issue(Request $request): string
    {
        $reader = Reader::find($request->reader_id);

        $bookId = $request->book_id;
        if (is_array($bookId)) {
            $bookId = reset($bookId);
        }

        $reader->books()->syncWithoutDetaching([
            $bookId => ['issued_at' => date('Y-m-d H:i:s')]
        ]);

        return new View('site.issue_book', [
            'message' => 'Книга выдана!',
            'books' => Book::all(),
            'readers' => Reader::all()
        ]);
    }

    public function returnList(): string
    {
        $readers = Reader::with(['books' => fn($q) => $q->wherePivot('returned_at', null)])->get();
        return new View('site.return_book', ['readers' => $readers]);
    }

    public function return(Request $request): string
    {
        $reader = Reader::find($request->reader_id);
        $reader->books()->updateExistingPivot($request->book_id, [
            'returned_at' => date('Y-m-d H:i:s')
        ]);

        return $this->returnList();
    }

    public function popular(): string
    {
        $books = Book::withCount(['readers as borrowings_count' => function ($query) {

        }])
            ->orderBy('borrowings_count', 'desc')
            ->get();

        return new View('site.most_popular_books', [
            'books' => $books,
        ]);
    }
}
