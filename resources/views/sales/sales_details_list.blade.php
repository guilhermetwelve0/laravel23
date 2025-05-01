@extends('layouts.app')

@section('content')

<main class="app-main">
    <!-- Início: Cabeçalho do Conteúdo -->
    <div class="app-content-header">
        <!-- Início: Container -->
        <div class="container-fluid">
            <!-- Início: Linha -->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Lista de Detalhes da Venda</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/admin/purchase">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Lista de Detalhes da Venda</li>
                    </ol>
                </div>
            </div>
            <!-- Fim: Linha -->
        </div>
        <!-- Fim: Container -->
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Buscar Detalhes da Venda</h3>
                    </div>
                    <form method="get">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_id">Nome do Produto</label>
                                        <input type="text" name="product_id" value="{{ Request()->product_id }}" id="product_id" placeholder="Digite o nome do produto" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="selling_price">Preço de Venda</label>
                                        <input type="number" step="any" name="selling_price" value="{{ Request()->selling_price }}" id="selling_price" placeholder="Digite o preço de venda" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="amount">Quantidade</label>
                                        <input type="number" step="any" name="amount" value="{{ Request()->amount }}" id="amount" placeholder="Digite a quantidade" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discount">Desconto</label>
                                        <input type="number" step="any" name="disount" value="{{ Request()->discount }}" id="disount" placeholder="Digite o desconto" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                            <div class="col-md-12" style="margin-top: 15px;">
                                <button class="btn btn-primary" type="submit">Buscar</button>
                                <a href="{{ url('admin/sales/sales_details_list/'.$sales_id) }}" class="btn btn-success">Limpar</a>
                            </div>                      
                        </div>
                    </form>
                </div>

                @include('_message')

                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Detalhes da Venda</h3>
                        <div class="card-tools">
                            <ul class="pagination pagination-sm float-end">
                                 <a href="{{url('admin/sales/sales_details_add/'.$sales_id)}}" class="btn btn-sm btn-primary">Adicionar Detalhe da Venda</a>
                            </ul>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome do Produto</th>
                                    <th>Preço de Venda</th>
                                    <th>Quantidade</th>
                                    <th>Desconto</th>
                                    <th>Subtotal</th>
                                    <th>Criado em</th>
                                    <th>Atualizado em</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($getRecord as $value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->name_product}}</td>
                                    <td>{{$value->selling_price}}</td>
                                    <td>{{$value->amount}}</td>
                                    <td>{{$value->discount}}</td>
                                    <td>{{$value->subtotal}}</td>
                                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                    <td>{{ date('d-m-Y H:i A', strtotime($value->updated_at)) }}</td>
                                    <td>
                                        <a href="{{ url('admin/sales/sales_details_edit/' . $value->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                        <a href="{{ url('admin/sales/sales_details_delete/' . $value->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                   <td colspan="100%">Nenhum registro encontrado...</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div style="padding: 10px; float: right;">
                            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
