@extends('layouts.app')

@section('content')

<main class="app-main">
    <!-- Início::Cabeçalho do Conteúdo -->
    <div class="app-content-header">
        <!-- Início::Container -->
        <div class="container-fluid">
            <!-- Início::Linha -->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Transações</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transações</li>
                    </ol>
                </div>
            </div>
            <!-- Fim::Linha -->
        </div>
        <!-- Fim::Container -->
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                 <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pesquisar Transação</h3>
                        </div>
                        <form method="get">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="id">ID</label>
                                            <input type="text" name="id" value="{{Request()->id}}" id="id" placeholder="Digite o ID" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">Nome de Usuário</label>
                                            <input type="text" value="{{Request()->name}}" name="name" id="name" placeholder="Digite o nome" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="amount">Valor</label>
                                            <input type="number" step="any" value="{{Request()->amount}}" name="amount" id="amount" placeholder="Digite o valor" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="created_at">Criado em</label>
                                            <input type="date" value="{{Request()->created_at}}" name="created_at" id="created_at" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div style="clear:both;"></div>
                                <div class="col-md-12" style="margin-top: 15px;">
                                    <button class="btn btn-primary" type="submit">Pesquisar</button>
                                    <a href="{{url('admin/transaction')}}" class="btn btn-success">Limpar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <br>
                    @include('_message')
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Lista de Transações</h3>
                            <div class="card-tools">
                                <ul class="pagination pagination-sm float-end">
                                  <form id="deleteForm" method="GET" action="{{ url('admin/transaction/delete_transaction_multi') }}">
    <input type="hidden" name="id" id="deleteIds" value="">
    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</button>
</form>

                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Excluir</th>
                                        <th>ID</th>
                                        <th>Nome de Usuário</th>
                                        <th>Valor</th>
                                        <th>Status do Pagamento</th>
                                        <th>Criado em</th>
                                        <th>Atualizado em</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($getRecord as $value)
                                <tr>
                                <td><input class="delete-all-option" value="{{$value->id}}" type="checkbox"></td>
                                <td>{{$value->id}}</td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->amount}}</td>
                                <td>
                                <select class="form-control changeStatus" style="width: 170px;" id="{{$value->id}}">
                                <option {{($value->payment_type == '0') ? 'selected': ''}} value="0">Pendente</option>
                                <option {{($value->payment_type == '1') ? 'selected': ''}} value="1">Concluído</option>
                                </select>
                                </td>
                                <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                <td>{{ date('d-m-Y H:i A', strtotime($value->updated_at)) }}</td>

                                <td>
                                <a href="{{ url('admin/transaction/pdf_transaction/' . $value->id) }}" class="btn btn-sm btn-primary">PDF</a>
                                <a href="{{ url('admin/transaction/description/' . $value->id) }}" class="btn btn-sm btn-success">Descrição</a>
                                </td>
                                </tr>

                                @endforeach
                                    
                                </tbody>
                            </table>
                            <div style="padding: 10px; float: right;">
                               
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('script')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

 <script type="text/javascript">
    $('.changeStatus').change(function(){
       var status_id = $(this).val();
       var order_id = $(this).attr('id');
       $.ajax({
        type: 'GET',
        url: "{{url('admin/transaction_status_update')}}",
        data: {status_id: status_id, order_id: order_id},
        dataType: 'JSON',
        success:function(data){
            alert('Status alterado com sucesso');
            window.location.href = "";
        }
       });
    });
  </script>

  <script type="text/javascript">
    $('.delete-all-option').click(function(){
    var total = '';
    $('.delete-all-option').each(function(){
        if ($(this).prop("checked")) {
            var id = $(this).val();
            total += id + ',';
        }
    });

    // Remove a vírgula extra no final
    total = total.replace(/,$/, '');

    $('#deleteIds').val(total);

        var url = "{{url('admin/transaction/delete_transaction_multi?id=')}}" + total;
        $('#getDeleteURL').attr('href', url);
    });
  </script>
  <script type="text/javascript">
    $('#deleteForm').submit(function(e) {
        var selected = [];

        $('.delete-all-option').each(function() {
            if ($(this).prop('checked')) {
                selected.push($(this).val());
            }
        });

        if (selected.length === 0) {
            alert('Por favor, selecione pelo menos uma transação para excluir.');
            e.preventDefault(); // impede o envio do form
            return false;
        }

        // Se chegou aqui, é porque há itens selecionados
        $('#deleteIds').val(selected.join(','));
    });
</script>


@endsection
