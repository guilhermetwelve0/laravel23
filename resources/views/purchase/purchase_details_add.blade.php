@extends('layouts.app')

@section('content')

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Detalhes da Compra</h3>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Início</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Adicionar Detalhes da Compra</li>
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
                            <div class="card-title">Adicionar Detalhes da Compra</div>
                        </div>
                        <form method="post" action="">
                            {{csrf_field()}}
                            <div class="card-body">
                            <input type="hidden" name="purchase_id" value="{{$purchase_id}}">
                                
                                <div class="row mb-3"><label class="col-sm-2 col-form-label">Nome do Produto
                                    </label>
                                    <div class="col-sm-10">
                                    <select class="form-control" name="product_id" required>
                                        <option value="">Selecione o Produto</option>
                                        @foreach($getProduct as $value)
                                        <option value="{{$value->id}}">{{$value->name_product}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="row mb-3"><label class="col-sm-2 col-form-label">Preço de Compra
                                    </label>
                                    <div class="col-sm-10"><input type="number" step="any" class="form-control" name="purchase_price"
                                            placeholder="Digite o Preço de Compra" required>
                                    </div>
                                </div>
                                <div class="row mb-3"><label class="col-sm-2 col-form-label">Quantidade
                                    </label>
                                    <div class="col-sm-10"><input type="number" step="any" class="form-control" name="amount"
                                            placeholder="Digite a Quantidade" required>
                                    </div>
                                </div>
                                <div class="row mb-3"><label class="col-sm-2 col-form-label">Subtotal
                                    </label>
                                    <div class="col-sm-10"><input type="number" step="any" class="form-control" name="subtotal"
                                            placeholder="Digite o Subtotal" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Enviar</button>
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
