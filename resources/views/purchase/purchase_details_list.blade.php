@extends('layouts.app')

@section('content')

<main class="app-main">
    <!-- Início: Cabeçalho do Conteúdo -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Detalhes da Compra</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/admin/purchase">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detalhes da Compra</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Buscar Detalhes da Compra</h3>
                        </div>
                        <form method="get">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="supplier_id">Nome do Produto</label>
                                            <input type="text"  value="{{Request()->product_id}}" name="product_id" id="product_id"
                                                placeholder="Digite o nome do produto" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_item">Preço de Compra</label>
                                            <input type="number" step="any" value="{{Request()->purchase_price}}" name="purchase_price" id="purchase_price"
                                                placeholder="Digite o preço de compra" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="text">Quantidade</label>
                                            <input type="number" step="any" value="{{Request()->amount}}" name="amount" id="amount" placeholder="Digite a quantidade"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="text">Subtotal</label>
                                            <input type="number" step="any" value="{{Request()->subtotal}}" name="subtotal" id="subtotal"
                                                placeholder="Digite o subtotal" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="created_at">Criado em</label>
                                            <input type="date" value="{{Request()->created_at}}" name="created_at" id="created_at" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="updated_at">Atualizado em</label>
                                            <input type="date" value="{{Request()->updated_at}}" name="updated_at" id="updated_at" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div style="clear:both;"></div>
                                <div class="col-md-12" style="margin-top: 15px;">
                                    <button class="btn btn-primary" type="submit">Buscar</button>
                                    <a href="{{url('admin/purchase/purchase_details/'.$purchase_id)}}" class="btn btn-success">Redefinir</a> 
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>

                    @include('_message')
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Lista de Detalhes da Compra</h3>
                            <div class="card-tools">
                                <ul class="pagination pagination-sm float-end">
                                    <a href="{{ url('admin/purchase/purchase_details_add/'.$purchase_id) }}" class="btn btn-sm btn-primary">
                                        Adicionar Detalhes da Compra</a>
                                </ul>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome do Produto</th>
                                        <th>Preço de Compra</th>
                                        <th>Quantidade</th>
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
                                <td>{{$value->purchase_price}}</td>
                                <td>{{$value->amount}}</td>
                                <td>{{$value->subtotal}}</td>
                                <td>{{date('d-m-Y H:i A', strtotime($value->created_at))}}</td>
                                <td>{{date('d-m-Y H:i A', strtotime($value->updated_at))}}</td>
                                <td>
                                <a href="{{ url('admin/purchase/purchase_details_edit/' . $value->id) }}"
                                class="btn btn-sm btn-primary">Editar</a>
                                <a href="{{ url('admin/purchase/purchase_details_delete/' . $value->id) }}"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                                </td>
                                </tr>
                                @empty
                                <tr>
                                <td colspan="100%">Nenhum registro encontrado</td>
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
    </div>
</main>

@endsection
