@extends('admin.layouts.master')
@section('title','Home')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
dsaf asdf asdf asdf
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
sdf asdf asdf sdf asdf asdf asdf adf
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
