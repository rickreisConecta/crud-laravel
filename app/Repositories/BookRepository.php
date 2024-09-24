<?php

namespace App\Repositories;

use App\Models\Book;
use App\Interfaces\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface{
    protected $book;

    public function __construct(Book $book){
        $this->book = $book;
    }

    public function all(){
        return $this->book->all()->sortBy('id');
    }

    public function create(array $data){
        return $this->book->create($data);
    }

    public function find($id){
        return $this->book->find($id);
    }

    public function update(array $data, $id){
        return $this->book->where('id', $id)->update($data);
    }

    public function delete($id){
        return $this->book->findOrFail($id)->delete();
    }
}