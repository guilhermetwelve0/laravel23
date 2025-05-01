@extends('layouts.app')

@section('content')

<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Produtos</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Produtos</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>

    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-md-12">
                    <!--begin::Card-->
                    <div class="card mb-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <h3 class="card-title">Lista de Produtos</h3>
                            <div class="">
                                <ul class="pagination pagination-sm float-end">
                                    <!-- Correção aqui -->
                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addProductModal">Adicionar Produto</a>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- Adicione essa div -->
                                <table id="product-table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Categoria</th>
                                            <th>Código</th>
                                            <th>Nome do Produto</th>
                                            <th>Marca</th>
                                            <th>Preço de Compra</th>
                                            <th>Preço de Venda</th>
                                            <th>Desconto</th>
                                            <th>Estoque</th>
                                            <th>Criado em</th>
                                            <th>Atualizado em</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<!-- Modal start -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Adicionar Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form id="productForm">
                    @csrf
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Categoria</label>
                        <select class="form-control" name="category_id" id="category_id" required>
                            <option value="">Selecione uma Categoria</option>
                            @foreach($category as $key => $item)
                            <option value="{{$key}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="product_code" class="form-label">Código do Produto</label>
                        <input type="text" class="form-control" id="product_code" name="product_code"
                            placeholder="Código do produto" required>
                    </div>
                    <div class="mb-3">
                        <label for="name_product" class="form-label">Nome do Produto</label>
                        <input type="text" class="form-control" id="name_product" name="name_product"
                            placeholder="Nome do produto" required>
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="brand" name="brand" placeholder="Marca" required>
                    </div>
                    <div class="mb-3">
                        <label for="purchase_price" class="form-label">Preço de Compra</label>
                        <input type="number" class="form-control" id="purchase_price" name="purchase_price"
                            placeholder="Preço de compra" step="any" required>
                    </div>
                    <div class="mb-3">
                        <label for="selling_price" class="form-label">Preço de Venda</label>
                        <input type="number" class="form-control" id="selling_price" name="selling_price"
                            placeholder="Preço de venda" step="any" required>
                    </div>
                    <div class="mb-3">
                        <label for="discount" class="form-label">Desconto</label>
                        <input type="number" class="form-control" step="any" id="discount" name="discount" placeholder="Desconto"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Estoque</label>
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Estoque" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->

<div class="flashMessage alert alert-success" style="display: none;"></div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs/dayjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    const isBlockedUser = {{ Auth::id() }} === 5; // Verifica se é usuário bloqueado

    // ===== ADICIONAR PRODUTO ===== //
    $('#productForm').on('submit', function(e) {
        e.preventDefault();
        $('.flashMessage').hide().removeClass('alert-danger alert-success');

        $.ajax({
            url: "{{ route('product.store') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                $('#addProductModal').modal('hide');
                $('#productForm')[0].reset();
                showSuccess(response.message);
                setTimeout(function() {
            location.reload();
        }, 2000);
                fetchProducts();
            },
            error: function(xhr) {
                if (xhr.status === 403) { // Bloqueio da controller
                    showError(xhr.responseJSON.message);
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    showError(Object.values(xhr.responseJSON.errors).join('<br>'));
                } else {
                    showError('Erro desconhecido!');
                }
            }
        });
    });

    // ===== EDITAR PRODUTO ===== //
    function handleEdit() {
        const id = $(this).data('id');
        
        $.ajax({
            url: `{{url('admin/product/edit')}}/${id}`,
            method: "GET",
            success: function(response){
                // Preenche o formulário
                $('#category_id').val(response.category_id);
                $('#product_code').val(response.product_code);
                $('#name_product').val(response.name_product); // Corrigido: estava product_code
                $('#brand').val(response.brand);
                $('#purchase_price').val(response.purchase_price);
                $('#selling_price').val(response.selling_price);
                $('#discount').val(response.discount);
                $('#stock').val(response.stock);
                
                $('#addProductModal').modal('show');
                
                // Atualiza o formulário para edição
                $('#productForm').off('submit').on('submit', function(e){
                    e.preventDefault();
                    
                    $.ajax({
                        url: `{{url('admin/product/update')}}/${id}`,
                        type: "POST",
                        data: $(this).serialize(),
                        success: function(response){
                            showSuccess(response.message);
                            $('#addProductModal').modal('hide');
                            fetchProducts();
                        },
                        error: function(xhr){
                            if (xhr.status === 403) {
                                showError(xhr.responseJSON.error);
                            } else if (xhr.responseJSON?.errors) {
                                showError(Object.values(xhr.responseJSON.errors).join('<br>'));
                            } else {
                                showError('Falha na atualização!');
                            }
                        }
                    });
                });
            },
            error: function(xhr){
                if (xhr.status === 403) {
                    showError(xhr.responseJSON?.error || 'Ação não permitida!');
                } else {
                    showError('Falha ao carregar dados!');
                }
            }
        });
    }

    // ===== EXCLUIR PRODUTO ===== //
    $(document).on('click', '.delete-btn', function() {
        const id = $(this).data('id');
        
        if(confirm('Tem certeza que deseja excluir este produto?')) {
            $.ajax({
                url: `{{url('admin/product/delete')}}/${id}`,
                method: "DELETE",
                data: { _token: "{{ csrf_token() }}" },
                success: function(response) {
                    showSuccess(response.message);
                    fetchProducts();
                },
                error: function(xhr) {
                    if (xhr.status === 403) {
                        showError(xhr.responseJSON.error);
                    } else {
                        showError('Falha na exclusão!');
                    }
                }
            });
        }
    });

    // ===== FUNÇÕES AUXILIARES ===== //
    function fetchProducts() {
        $.ajax({
            url: "{{route('product.fetch')}}",
            method: "GET",
            success: function(response) {
                const tbody = $('#product-table tbody');
                tbody.empty();
                response.forEach((product, index) => {
                    tbody.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${product.category?.category_name || 'N/A'}</td>
                        <td>${product.product_code}</td>
                        <td>${product.name_product}</td>
                        <td>${product.brand}</td>
                        <td>${product.purchase_price}</td>
                        <td>${product.selling_price}</td>
                        <td>${product.discount}</td>
                        <td>${product.stock}</td>
                        <td>${dayjs(product.created_at).format('DD-MM-YYYY')}</td>
                        <td>${dayjs(product.updated_at).format('DD-MM-YYYY')}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm btn-warning edit-btn" data-id="${product.id}">Editar</button>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="${product.id}">Excluir</button>
                            </div>
                        </td>
                    </tr>
                    `);
                });
                $('.edit-btn').on('click', handleEdit);
            },
            error: () => showError('Falha ao carregar produtos!')
        });
    }

    function showError(message) {
        $('.flashMessage')
            .addClass('alert-danger')
            .html(message)
            .fadeIn()
            .delay(3000)
            .fadeOut();
    }

    function showSuccess(message) {
        $('.flashMessage')
            .addClass('alert-success')
            .html(message)
            .fadeIn()
            .delay(3000)
            .fadeOut();
    }

    // Inicialização
    fetchProducts();
});
</script>
@endsection