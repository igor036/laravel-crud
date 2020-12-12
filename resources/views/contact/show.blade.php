@extends('layout')
@section('content')

    <div  class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h1><b>Contact Detail</b></h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span><b>Name:</b></span>
                                <span>{{ $contact->name }}</span>
                                <hr/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span><b>E-mail:</b></span>
                                <span>{{ $contact->email }}</span>
                                <hr/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span><b>Phone:</b></span>
                                <span>{{ $contact->phone }}</span>
                                <hr/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <form action="{{ url('contact/destroy')}}/{{ $contact->id }}" method="post">
                                    @csrf @method('delete')
                                    <button class="btn btn-sm btn-primary" type="button" onclick="window.location='{{ url('contact/edit') }}/{{ $contact->id }}' ">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
