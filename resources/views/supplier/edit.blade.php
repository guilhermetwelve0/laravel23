@extends('layouts.app')

@section('content')

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Fornecedor</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar Fornecedor</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-md-12">
                    <div class="card card-warning card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Editar Fornecedor</div>
                        </div>
                        <form method="post" action="{{url('admin/supplier/edit/'.$getRecord->id)}}">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nome do Fornecedor</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="supplier_name"
                                            placeholder="Digite o nome do fornecedor" value="{{$getRecord->supplier_name}}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Telefone</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="supplier_telephone"
                                            placeholder="Digite o telefone do fornecedor" value="{{$getRecord->supplier_telephone}}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Endereço do Fornecedor</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="supplier_address" placeholder="Digite o endereço do fornecedor" required>{{$getRecord->supplier_address}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Atualizar</button>
                                <a href="{{url('admin/supplier')}}" class="btn btn-danger float-end">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
