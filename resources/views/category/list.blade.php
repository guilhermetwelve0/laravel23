@extends('layouts.app')

@section('content')

<main class="app-main">
    <!--início::Cabeçalho do Conteúdo do App-->
    <div class="app-content-header">
        <!--início::Container-->
        <div class="container-fluid">
            <!--início::Linha-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Categoria</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Categoria</li>
                    </ol>
                </div>
            </div>
            <!--fim::Linha-->
        </div>
        <!--fim::Container-->
    </div>

    <div class="app-content">
        <!--início::Container-->
        <div class="container-fluid">
            <!--início::Linha-->
            <div class="row">
                <div class="col-md-12">
                    <!--início::Card-->
                    <div class="card mb-4">
                        <!--início::Cabeçalho do Card-->
                        <div class="card-header">
                            <!--início::Título do Card-->
                            <h3 class="card-title">Lista de Categorias</h3>
                            <div class="">
                                <ul class="pagination pagination-sm float-end">
                                    <!-- Correção aqui -->
                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addCategoryModal">Adicionar Categoria</a>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="category-table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome da Categoria</th>
                                        <th>Criado Em</th>
                                        <th>Atualizado Em</th>
                                        <th>Ação</th>
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

</main>

<!-- Modal início -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Adicionar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form id="categoryForm">
                    @csrf
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Nome da Categoria</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal fim -->

<div class="flashMessage alert alert-success" style="display: none;"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs/dayjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    fetchCategories();

    function fetchCategories() {
        $.ajax({
            url: "{{ url('admin/category/data') }}",
            type: "GET",
            success: function(response) {
                let tableBody = '';
                $.each(response, function(index, category) {
                    let createdAt = dayjs(category.created_at)
                        .format('DD-MM-YYYY h:mm A');
                    let updatedAt = dayjs(category.updated_at)
                        .format('DD MMM,YYYY h:mm A');
                    tableBody += `
                  <tr>
                  <td>${index + 1}</td>
                  <td>${category.category_name}</td>
                  <td>${createdAt}</td>
                  <td>${updatedAt}</td>
                  <td>
                  <button class="btn btn-warning btn-sm edit-btn" data-id="${category.id}">Editar</button>
                  <button class="btn btn-danger btn-sm delete-btn" data-id="${category.id}">Excluir</button>
                  </td>
                  </tr>
                  `;
                });
                $('#category-table tbody').html(tableBody);
                $('.edit-btn').on('click', handleEdit);
                $('.delete-btn').on('click', handleDelete);
            },
            error: function(xhr) {
                console.log('Falha ao buscar categorias:', xhr
                    .responseText);
            }
        });
    }
    // Editar
    function handleEdit() {
    const id = $(this).data('id');
    $.ajax({
        url: `{{ url('admin/category/edit') }}/${id}`,
        type: 'GET',
        success: function(category) {
            $('#category_name').val(category.category_name);
            $('#addCategoryModal').modal('show');

            $('#categoryForm').off('submit').on('submit', function(e) {
                e.preventDefault();
                const formData = $(this).serialize();

                $.ajax({
                    url: `{{ url('admin/category/update') }}/${id}`,
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        if (response.success === false) {
                            showError(response.error);
                        } else {
                            $('#addCategoryModal').modal('hide');
                            fetchCategories();
                            $('.flashMessage')
                                .removeClass('alert-danger')
                                .addClass('alert-success')
                                .text(response.message)
                                .fadeIn()
                                .delay(3000)
                                .fadeOut();
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 403) {
                            showError(xhr.responseJSON.error);
                        } else {
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = '';
                            $.each(errors, function(key, value) {
                                errorMessage += value[0] + '\n';
                            });
                            showError(errorMessage);
                        }
                    }
                });
            });
        },
        error: function(xhr) {
            if (xhr.status === 403) {
                showError(xhr.responseJSON.error);
            } else {
                showError('Falha ao buscar detalhes da categoria.');
            }
        }
    });
}

function showError(message) {
    $('.flashMessage')
        .removeClass('alert-success')
        .addClass('alert-danger')
        .text(message)
        .fadeIn()
        .delay(3000)
        .fadeOut();
}
    //Excluir
function handleDelete() {
    const id = $(this).data('id');
    if (confirm('Tem certeza de que deseja excluir esta categoria?')) {
        $.ajax({
            url: `{{url('admin/category/delete')}}/${id}`,
            type: "DELETE",
            data: {
                _token: "{{csrf_token()}}"
            },
            success: function(response) {
                if (response.success === false) {
                    showError(response.error);
                } else {
                    fetchCategories();
                    $('.flashMessage')
                        .removeClass('alert-danger')
                        .addClass('alert-success')
                        .text(response.message)
                        .fadeIn()
                        .delay(3000)
                        .fadeOut();
                }
            },
            error: function(xhr) {
                if (xhr.status === 403) {
                    showError(xhr.responseJSON.error);
                } else {
                    showError('Falha ao excluir categoria.');
                }
            }
        });
    }
}


});
</script>

<script>
// Defina as funções de mensagem primeiro
function showError(message) {
    $('.flashMessage')
        .removeClass('alert-success')
        .addClass('alert-danger')
        .text(message)
        .fadeIn()
        .delay(3000)
        .fadeOut();
}

function showSuccess(message) {
    $('.flashMessage')
        .removeClass('alert-danger')
        .addClass('alert-success')
        .text(message)
        .fadeIn()
        .delay(3000)
        .fadeOut();
}

$(document).ready(function() {
    $('#categoryForm').submit(function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        
        $.ajax({
            url: "{{ url('admin/category/store') }}",
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success === false) {
                    showError(response.message);
                } else {
                    $('#addCategoryModal').modal('hide');
                    $('#categoryForm')[0].reset();
                    showSuccess(response.message);
                    setTimeout(function() {
            location.reload();
        }, 2000);
                    fetchCategories();
                }
            },
            error: function(xhr) {
                if (xhr.status === 403) {
                    showError(xhr.responseJSON.message);
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errorMessage = Object.values(xhr.responseJSON.errors).join('\n');
                    showError(errorMessage);
                } else {
                    showError('Ocorreu um erro inesperado.');
                }
            }
        });
    });

});
</script>

@endsection
