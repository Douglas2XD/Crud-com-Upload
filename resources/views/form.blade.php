<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        img {
              width: 100px; /* Largura da imagem */
              height: 100px; /* Altura da imagem */
              border-radius: 50%; /* Deixa a imagem circular */
              object-fit: cover; /* Ajusta o conteúdo para caber no círculo */
              border: 2px solid #ccc; /* Adiciona uma borda fina */
            }
    </style>
</head>
<body>
<h2 class="text-center my-4">Formulário</h2>

@if(isset($pessoa) && $pessoa->id)

<form action="{{route('update',$pessoa)}}" method="post" enctype="multipart/form-data" class="p-4 border rounded shadow-sm">
@method('PUT')
    @else

<form action="{{route('save')}}" method="post" enctype="multipart/form-data" class="p-4 border rounded shadow-sm">
@endif

    @csrf
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite seu nome" value="{{$pessoa->nome ?? "" }}">
    </div>
    <div class="mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" name="cpf" id="cpf" class="form-control" placeholder="Digite seu CPF" value="{{$pessoa->cpf ?? ''}}">
    </div>
    <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input type="file" name="foto" id="foto" class="form-control" accept="image/jpeg" value="{{$pessoa->foto ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="curriculo" class="form-label">Curriculo</label>
        <input type="file" name="curriculo" class="form-control" accept=".pdf,.doc,.docx" value="{{$pessoa->foto ?? ''}}">
    </div>

    <button type="submit" class="btn btn-primary w-100">Enviar</button>
    <a href="{{route('new')}}">NOVO</a>
</form>

<ul class="list-group my-4">
    @foreach($list as $pessoa)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $pessoa->nome }}</strong> - {{ $pessoa->cpf }}
                <a href="{{asset("assets/curriculos/".$pessoa->curriculo)}}" target="_blank">curriculo</a>
                <br>
                <a href="{{route('delete',$pessoa->id)}}" class="btn btn-sm btn-danger mt-2">Delete</a>
                <a href="{{route('edit',$pessoa)}}" class="btn btn-sm btn-warning mt-2">Editar</a>

            </div>
            <img src="{{asset("assets/images/".$pessoa->foto)}}" alt="Foto" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
        </li>
    @endforeach
</ul>

<div class="d-flex justify-content-center">
    {{$list->links()}}
</div>

