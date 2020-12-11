@extends('layout')
@section('content')

    <div>
        <h1>{{ $title }}</h1>
    </div>

    <form action="{{ url('contact/create') }}" method="post">
        @csrf
        <div>
            <label>Name</label><input type="text" name="name"/>
        </div>
        <br/>
        <div>
            <label>E-mail</label><input type="text" name="email"/>
        </div>
        <br/>
        <div>
            <label>Phone</label><input type="text" name="phone"/>
        </div>
        <br/>
        <button type="submit" >Submit</button>
    </form>

@endsection
