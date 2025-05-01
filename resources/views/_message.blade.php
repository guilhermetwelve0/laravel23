@if(!empty(session('success')))
    <div id="flash-success" class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if(!empty(session('error')))
    <div id="flash-error" class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif

<script>
    // Após 5000 milissegundos (5 segundos), esconde as mensagens
    setTimeout(function() {
        var flashSuccess = document.getElementById('flash-success');
        if(flashSuccess) {
            flashSuccess.style.display = 'none';
        }
        var flashError = document.getElementById('flash-error');
        if(flashError) {
            flashError.style.display = 'none';
        }
    }, 4000);
</script>
