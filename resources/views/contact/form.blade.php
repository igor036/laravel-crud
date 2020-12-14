@extends('layout')
@section('content')


<div  class="container mt-5">


    @if (Request::is('*/edit'))
    <form action="{{route('contact.update', $contact->id)}}" name='update' method="post">
        @csrf
        @method('put')
    @else
    <form action="{{route('contact.store')}}" method="post" name='store'>
    @endif
        @csrf

        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <div>
                            @if (Request::is('*/edit/*'))
                                <h1><b>Edit Contact</b></h1>
                            @else
                                <h1><b>New Contact</b></h1>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="name"><b>Name</b></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $contact->name }}"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="email"><b>E-mail</b></label>
                                    <input class="form-control"  type="text" id="email" name="email" value="{{ $contact->email }}"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="phone"><b>Phone</b></label>
                                    <input class="form-control"  type="text" id="phone" name="phone" value="{{ $contact->phone }}"/>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <button class="btn btn-primary form-control" type="submit" >Submit</button>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col">
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
