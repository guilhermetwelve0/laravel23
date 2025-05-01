@extends('layouts.app')

@section('content')

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Compra</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar Compra</li>
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
                            <div class="card-title">Editar Compra</div>
                        </div> 
                        <form method="post" action="{{url('admin/purchase/edit/'.$getRecordValue->id)}}">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nome do Fornecedor</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="supplier_id" required>
                                            @foreach($getRecord as $value)
                                            <option {{($value->id == $getRecordValue->supplier_id) ? 'selected' : ''}} value="{{$value->id}}">
                                                {{$value->supplier_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Total de Itens</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="any" class="form-control" name="total_item"
                                            placeholder="Digite o Total de Itens" required value="{{$getRecordValue->total_item}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Preço Total</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="any" class="form-control" name="total_price"
                                            placeholder="Digite o Preço Total" required value="{{$getRecordValue->total_price}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Desconto</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="any" class="form-control" name="discount"
                                            placeholder="Digite o Desconto" required value="{{$getRecordValue->discount}}">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Atualizar</button>
                                <a href="{{url('admin/purchase')}}" class="btn btn-danger float-end">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
