@extends('layouts.app')

@section('content')

<main class="app-main">
    <!-- Início do Cabeçalho do Conteúdo do Aplicativo -->
    <div class="app-content-header">
        <!-- Início do Container -->
        <div class="container-fluid">
            <!-- Início da Linha -->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Vendas</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Vendas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Vendas</li>
                    </ol>
                </div>
            </div>
            <!-- Fim da Linha -->
        </div>
        <!-- Fim do Container -->
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <!-- Seção de Pesquisa de Vendas -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pesquisar Vendas</h3>
                        </div>
                        <form method="get">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="id">ID</label>
                                            <input type="text" name="id" value="{{ Request()->id }}" id="id" placeholder="Digite o ID" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="member_id">Nome do Membro</label>
                                            <input type="text" name="member_id" value="{{ Request()->member_id }}" id="member_id" placeholder="Digite o Nome do Membro" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_item">Total de Itens</label>
                                            <input type="text" step="any" name="total_item" value="{{ Request()->total_item }}" id="total_item" placeholder="Digite o Total de Itens" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user_id">Nome de Usuário</label>
                                            <input type="text" name="user_id" value="{{ Request()->user_id }}" id="user_id" placeholder="Digite o Nome de Usuário" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="accepted">Aceito</label>
                                            <select class="form-control" name="accepted" id="accepted">
                                                <option value="">Selecione</option>
                                                <option value="Yes" {{ Request()->accepted == 'Yes' ? 'selected' : '' }}>Sim</option>
                                                <option value="No" {{ Request()->accepted == 'No' ? 'selected' : '' }}>Não</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-12" style="margin-top: 15px;">
                                    <button class="btn btn-primary" type="submit">Pesquisar</button>
                                    <a href="{{ url('admin/sales') }}" class="btn btn-success">Redefinir</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Seção da Lista de Compras -->
    <div class="app-content">
        <div class="container-fluid">
            @include('_message')
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Lista de Vendas</h3>
                            <div class="card-tools">
                                <a href="{{url('admin/sales/all_delete') }}" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir todos os itens?')">Limpar</a>
                                &nbsp;&nbsp;&nbsp;
                                <a href="{{ url('admin/sales/add') }}" class="btn btn-sm btn-primary">Adicionar Venda</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome do Membro</th>
                                            <th>Total de Itens</th>
                                            <th>Preço Total</th>
                                            <th>Desconto</th>
                                            <th>Valor Desc.</th>
                                            <th>Total Líquido</th>
                                            <th>Aceito</th>
                                            <th>Usuário</th>
                                            <th>Criado em</th>
                                            <th>Atualizado em</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $TotalItem = 0;
                                        $TotalPrice = 0;
                                        $TotalDiscount = 0;
                                        $TotalNet = 0;
                                        $NetTotal = 0;
                                        $taotaPrice = 0;
                                        @endphp
                                        @forelse($getRecord as $value)
                                        @php
                                        $TotalItem += $value->total_item;
                                        $TotalPrice += $value->total_price;
                                        $TotalDiscount += $value->discount;
                                        $NetDiscount = $value->total_price * $value->discount / 100;
                                        $TotalNet += $NetDiscount;
                                        $NetTotal = $value->total_price - $NetDiscount;
                                        $taotaPrice += $NetTotal;
                                        @endphp
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->name_member }}</td>
                                            <td>{{ number_format($value->total_item, 2) }}</td>
                                            <td>{{ number_format($value->total_price, 2) }}</td>
                                            <td>{{ $value->discount }} %</td>
                                            <td>{{ $NetDiscount }}</td>
                                            <td>{{ $NetTotal }}</td>
                                            <td>{{ $value->accepted }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                            <td>{{ date('d-m-Y H:i A', strtotime($value->updated_at)) }}</td>
                                            <td style="width: 23%;">
                                                <a href="{{url('admin/sales/sales_details_list/'.$value->id)}}" class="btn btn-sm btn-warning">Detalhes</a>
                                                <a href="{{ url('admin/sales/edit/' . $value->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                                <a href="{{ url('admin/sales/delete/' . $value->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="100%">Nenhum registro encontrado</td>
                                        </tr>
                                        @endforelse

                                        <tr>
                                            <th colspan="2">Totais</th>
                                            <td>{{ number_format($TotalItem, 2) }}</td>
                                            <td>{{ number_format($TotalPrice, 2) }}</td>
                                            <td>{{ number_format($TotalDiscount, 2) }}</td>
                                            <td>{{ number_format($TotalNet, 2) }}</td>
                                            <td>{{ number_format($taotaPrice, 2) }}</td>
                                            <th colspan="2"></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-end" style="padding: 10px;">
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
