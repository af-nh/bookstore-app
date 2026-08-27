@extends('layouts.app')

@section('title', 'Books - BookStore')

@section('content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Books We Have in the second branch </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($books as $book)
            @include('books._book-card', ['book' => $book])
        @endforeach
    </div>
@endsection