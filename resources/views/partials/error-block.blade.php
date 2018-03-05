@if (count($errors) > 0)
    <div class="alert alert-danger">
        <p>Erros foram encontrados:</p>
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li class="list-group-item">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif