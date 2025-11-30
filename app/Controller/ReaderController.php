<?php

namespace Controller;

use Model\Reader;
use Src\View;
use Src\Request;
use Src\Validator\Validator;

class ReaderController
{
    public function create(): string
    {
        return new View('site/add_reader');
    }

    public function store(Request $request): string
    {
        $data = $request->all();

        $rules = [
            'card_number'  => 'required|max:14|regex:/^\d+$/',
            'full_name'    => 'required|min:3',
            'address'      => 'required',
            'phone_number' => 'required|phone',
        ];



        foreach ($rules as $field => $ruleString) {
            $rules[$field] = explode('|', $ruleString);
        }
        $validator = new Validator($data, $rules);

        if ($validator->fails()) {
            return new View('site/add_reader', [
                'errors' => $validator->errors(),
                'old'    => $data
            ]);
        }

        Reader::create($data);

        return new View('site/add_reader', [
            'message' => 'Читатель добавлен!'
        ]);
    }

    public function list(Request $request): string
    {
        $search = trim($request->get('search', ''));

        $query = Reader::query();

        if ($search) {
            $query->where('full_name', 'LIKE', "%$search%");
        }

        return new View('site.readers', [
            'readers' => $query->get(),
            'search' => $search
        ]);
    }
}
