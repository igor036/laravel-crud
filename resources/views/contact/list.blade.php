@extends('layout')
@section('content')
    <div>

        <h1>Contact List</h1>
        <p>
            <a href="{{ url('contact/create') }}">New Contact</a>
        </p>

        <table>
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @if (count($contacts) === 0)
                    <tr>
                        <td colspan="4">You contact list is empty!</td>
                    </tr>
                @else
                    @foreach ($contacts as $contact)
                    <tr>
                        <td>{{$contact->name}} </td>
                        <td>{{$contact->email}}</td>
                        <td>{{$contact->phone}}</td>
                        <td>
                            <button type="button" onclick="window.location='{{ url('contact/edit') }}/{{ $contact->id }}' ">Edit</button>
                            <form action="contact/destroy/{{ $contact->id }}" method="post">
                                @csrf @method('delete')
                                <button>delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

@endsection
