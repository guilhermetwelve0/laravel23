@extends('layouts.app')

@section('content')

<main class="app-main">
    <!--begin::Cabeçalho do Conteúdo do Aplicativo-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Linha-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Compra</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Compra</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Compra</li>
                    </ol>
                </div>
            </div>
            <!--end::Linha-->
        </div>
        <!--end::Container-->
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Buscar Compra</h3>
                        </div>
                        <form method="get">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="id">ID</label>
                                            <input type="text" name="id" value="{{Request()->id}}" id="id" placeholder="Digite o ID"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="supplier_id">Nome do Fornecedor</label>
                                            <input type="text" value="{{Request()->supplier_id}}" name="supplier_id" id="supplier_id"
                                                placeholder="Digite o Nome do Fornecedor" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_item">Total de Itens</label>
                                            <input type="text" step="any" value="{{Request()->total_item}}" name="total_item" id="total_item"
                                                placeholder="Digite o Total de Itens" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="text">Preço</label>
                                            <input type="text" step="any" value="{{Request()->total_price}}" name="total_price" id="total_price" 
                                                placeholder="Digite o Preço Total" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="text">Desconto</label>
                                            <input type="text" step="any" value="{{Request()->discount}}" name="discount" id="discount"
                                                placeholder="Digite o Desconto" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="created_at">Criado Em</label>
                                            <input type="date" value="{{Request()->created_at}}" name="created_at" id="created_at" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="updated_at">Atualizado Em</label>
                                            <input type="date" value="{{Request()->updated_at}}" name="updated_at" id="updated_at" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div style="clear:both;"></div>
                                <div class="col-md-12" style="margin-top: 15px;">
                                    <button class="btn btn-primary" type="submit">Buscar</button>
                                    <a href="{{url('admin/purchase')}}" class="btn btn-success">Redefinir</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>

                    @include('_message')
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Lista de Compras</h3>
                            <div class="card-tools">
                                <ul class="pagination pagination-sm float-end">
                                    <a href="{{url('admin/purchase/purchase_all_delete')}}" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza de que deseja excluir este item?')">Excluir Tudo</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="{{ url('admin/purchase/add') }}" class="btn btn-sm btn-primary">Adicionar Compra</a>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome do Fornecedor</th>
                                        <th>Total de Itens</th>
                                        <th>Preço</th>
                                        <th>Desconto</th>
                                        <th>Desconto Líquido</th>
                                        <th>Preço Total</th>
                                        <th>Criado Em</th>
                                        <th>Atualizado Em</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                $totalItem = 0;
                                $totalPR = 0;
                                $totalD = 0;
                                $totalNet = 0;
                                $totalP = 0;
                                @endphp
                                @forelse($getRecord as $value)
                                @php
                                $NetDiscount = $value->total_price * $value->discount / 100;
                                $TotalPrice = $value->total_price - $NetDiscount;
                                $totalItem += $value->total_item;
                                $totalPR += $value->total_price;
                                $totalD += $value->discount;
                                $totalNet += $NetDiscount;
                                $totalP += $TotalPrice;
                                @endphp
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->supplier_name}}</td>
                                    <td>{{number_format($value->total_item, 2)}}</td>
                                    <td>{{number_format($value->total_price, 2)}}</td>
                                    <td>{{number_format($value->discount, 2)}} %</td>
                                    <td>{{number_format($NetDiscount, 2)}}</td>
                                    <td>{{number_format($TotalPrice, 2)}}</td>
                                    <td>{{date('d-m-Y H:i A', strtotime($value->created_at))}}</td>
                                    <td>{{date('d-m-Y H:i A', strtotime($value->updated_at))}}</td>
                                    <td style="width: 25.2%;">
                                        <a href="{{ url('admin/purchase/purchase_details/' . $value->id) }}" class="btn btn-sm btn-warning">Detalhes</a>
                                        <a href="{{ url('admin/purchase/edit/' . $value->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                        <a href="{{ url('admin/purchase/delete/' . $value->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza de que deseja excluir?')">Excluir</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="100%">Nenhum Registro Encontrado</td>
                                </tr>
                                @endforelse

                                <tr>
                                    <th colspan="2">Total Geral</th>
                                    <td>{{number_format($totalItem, 2)}}</td>
                                    <td>{{number_format($totalPR, 2)}}</td>
                                    <td>{{number_format($totalD, 2)}} %</td>
                                    <td>{{number_format($totalNet, 2)}}</td>
                                    <td>{{number_format($totalP, 2)}}</td>
                                    <th colspan="3"></th>
                                </tr>
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
