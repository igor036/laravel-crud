@extends('layout')
@section('content')
    <div>

        <h1>Contact List</h1>
        <p>
            <a href="{{ url('contact/new') }}">New Contact</a>
        </p>

        <table>
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </thead>
            <tbody>

                @foreach ($contacts as $contact)
                <tr>
                    <td>{{$contact->name}} </td>
                    <td>{{$contact->email}}</td>
                    <td>{{$contact->phone}}</td>
                    <td>
                        <button>Edit</button>
                        <form action="contact/delete/{{ $contact->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button>delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

@endsection
