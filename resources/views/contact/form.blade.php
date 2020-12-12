@extends('layout')
@section('content')

    <div>
        <h1>{{ $title }}</h1>
    </div>

    @if (Request::is('*/edit/*'))
    <form action="{{ url('contact/update') }}/{{ $contact->id }}" method="post"> @method('put')
    @else
    <form action="{{ url('contact/store') }}" method="post">
    @endif
        @csrf
        <div>
            <label>Name</label><input type="text" name="name" value="{{ $contact->name }}"/>
        </div>
        <br/>
        <div>
            <label>E-mail</label><input type="text" name="email" value="{{ $contact->email }}"/>
        </div>
        <br/>
        <div>
            <label>Phone</label><input type="text" name="phone" value="{{ $contact->phone }}"/>
        </div>
        <br/>
        <button type="submit" >Submit</button>
    </form>

@endsection
