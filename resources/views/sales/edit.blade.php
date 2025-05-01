@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Vendas</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar Venda</li>
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
                            <div class="card-title">Editar Venda</div>
                        </div>
                        <form method="post" action="">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nome do Membro</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="member_id" id="memberSelect" required>
                                            <option value="">Selecione o nome do membro</option>
                                            @foreach($getMember as $value)
                                                <option {{($getEdit->member_id == $value->id) ? 'selected' : ''}} value="{{$value->id}}">
                                                    {{$value->name_member}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Total de Itens</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="any" class="form-control" name="total_item"
                                            placeholder="Informe o total de itens" value="{{$getEdit->total_item}}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Preço Total</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="any" class="form-control" name="total_price"
                                            placeholder="Informe o preço total" value="{{$getEdit->total_price}}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Desconto</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="any" class="form-control" name="discount"
                                            placeholder="Informe o desconto" value="{{$getEdit->discount}}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Aceito</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="accepted" required>
                                            <option {{$getEdit->accepted == 'Yes' ? 'selected' : ''}} value="Yes">Sim</option>
                                            <option {{$getEdit->accepted == 'No' ? 'selected' : ''}} value="No">Não</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nome de Usuário</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="user_id" required>
                                            <option value="">Selecione o nome de usuário</option>
                                            @foreach($getUser as $value)
                                                <option {{($getEdit->user_id == $value->id) ? 'selected': ''}} value="{{$value->id}}">
                                                    {{$value->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Atualizar</button>
                                <a href="{{url('admin/sales')}}" class="btn btn-danger float-end">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
$(document).ready(function() {
    $('#memberSelect').select2({
        placeholder: "Digite para buscar ou selecione",
        allowClear: true,
        width: '100%',
    });
});
</script>

@endsection
