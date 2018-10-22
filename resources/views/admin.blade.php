@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="/api/v1/noticias" method="POST" name="form-crud">
            <input type="hidden" name="_method" value="">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input class="form-control" id="titulo"  name="titulo" placeholder="Título da Notícia" required>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="autor">Autor</label>
                        <input class="form-control" id="autor"  name="autor" placeholder="Autor" required>
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <input class="form-control" id="categoria"  name="categoria" placeholder="Categoria" required>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="palavra-chave">Palavras-Chave</label>
                        <input class="form-control" id="palavra-chave"  name="palavras_chaves" placeholder="palavra-chave1, palavra-chave2, etc">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="conteudo">Conteudo</label>
                <textarea class="form-control" id="conteudo" name="conteudo"></textarea>
            </div>

            <div class="text-right">
                <button id="btn-clean" type="button" class="btn btn-warning">
                    <i class="fa fa-fw fa-trash"></i>
                    Limpar campos
                </button>
                <button id="btn-submit" type="button" class="btn btn-success">
                    <i class="fa fa-fw fa-check"></i>
                    Salvar
                </button>
            </div>
        </form>
    </div>
</div>

<br />
<div class="card card-body">
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Categoria</th>
                <th>Palavras-Chaves</th>
                <th></th>
            </tr>
        </thead>
    </table>
</div>

@include('inc.modal_exibir')

@stop