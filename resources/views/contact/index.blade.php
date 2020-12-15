@extends('layout')
@section('content')

    <script>
        window.onload = () => {
            const message = document.getElementById('message');
            if (message) {
                setTimeout( () => message.setAttribute('style', 'display: none;'), 10000);
            }
        };
    </script>

    <div  class="container mt-5">

        <div class="d-flex justify-content-center mt-5">

            <div class="card">
                <div class="card-header">
                    <h1>
                        <b>Contact List</b>
                        <button class="btn btn-sm btn-primary" type="button" onclick="window.location='contact/create'">
                            <i class="fas fa-plus-circle"></i>
                        </button>
                    </h1>
                    @if (session('message'))
                        <div id="message" class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead >
                            <th class="col">Name</th>
                            <th class="col">Email</th>
                            <th class="col">Phone</th>
                            <th class="col">Actions</th>
                        </thead>
                        <tbody>
                            @if ($pagination->count() == 0)
                                <tr>
                                    <td colspan="4">You contact list is empty!</\td>
                                </tr>
                            @else
                                @foreach ($pagination->items() as $contact)
                                    <form action="{{route('contact.destroy', $contact->id)}}" onsubmit="return confirm('Are you sure?')" method="post">
                                        @csrf @method('delete')
                                        <tr>
                                            <td>{{$contact->name}} </td>
                                            <td>{{$contact->email}}</td>
                                            <td>{{$contact->phone}}</td>
                                            <td>
                                                <button class="btn btn-sm btn-info text-white" type="button" onclick="window.location='{{route('contact.show', $contact->id)}}' ">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-primary" type="button" onclick="window.location='{{route('contact.edit', $contact->id)}}' ">
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

                @if ($pagination->count() > 0)
                    <div class="card-footer">
                        <div class="text-center">
                            @if ($pagination->currentPage() > 1)
                                <button style="margin-right: 5px" class="btn btn-sm btn-primary" onclick="window.location='{{$pagination->previousPageUrl()}}' ">
                                    <i class="fas fa-backward"></i>
                                </button>
                            @endif
                            <input style="width: 20px" value="{{ $pagination->currentPage() }}" />
                            <b>/ {{ $pagination->lastPage() }}</b>
                            @if ($pagination->currentPage() < $pagination->lastPage())
                                <button style="margin-left: 5px" class="btn btn-sm btn-primary" onclick="window.location='{{$pagination->nextPageUrl()}}' ">
                                    <i class="fas fa-forward"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
