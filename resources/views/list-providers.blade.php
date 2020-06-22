@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Fornecedores</div>

                <div class="card-body">
                    <list-providers :token="{{ session('api_token') }}"></list-providers>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
