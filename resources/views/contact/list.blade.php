@extends('layout')
@section('content')
    <div  class="container mt-5">

        <h1>Contact List</h1>
        <p>
            <a href="{{ url('contact/create') }}">New Contact</a>
        </p>

        <div class="d-flex justify-content-center mt-5">
            <table class="table table-striped">
                <thead >
                    <th class="col">Name</th>
                    <th class="col">Email</th>
                    <th class="col">Phone</th>
                    <th class="col">Actions</th>
                </thead>
                <tbody>
                    @if (count($contacts) === 0)
                        <tr>
                            <td colspan="4">You contact list is empty!</td>
                        </tr>
                    @else
                        @foreach ($contacts as $contact)
                            <form action="contact/destroy/{{ $contact->id }}" method="post">
                                @csrf @method('delete')
                                <tr>
                                    <td>{{$contact->name}} </td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->phone}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" type="button" onclick="window.location='contact/edit/{{ $contact->id }}' ">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            </form>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>

@endsection
