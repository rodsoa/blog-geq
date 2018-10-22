CKEDITOR.replace('conteudo');

var tabela = $('table').DataTable({
    "ajax": '/api/v1/noticias/?toDataTables',
    "order": [
        [0, 'desc']
    ]
});

/** Cadastrar noticia */
$('#btn-submit').click(function () {
    /** pra funcionar o serialize() */
    CKEDITOR.instances.conteudo.updateElement();

    var form = $('form[name="form-crud"]')

    console.log(form.serialize())

    /** processar requisiaçao */
    $.post(form.attr('action'), form.serialize())
        .done(function (response) {
            document.querySelector('form[name="form-crud"]').reset();
            $('input[name="_method"]').val('');
            $('form[name="form-crud"]').attr('action', '/api/v1/noticias');
            CKEDITOR.instances.conteudo.setData('', function () {
                this.updateElement();
            })

            /** Atualizando Tabela */
            tabela.ajax.reload();

            /** trocar isso por algo como sweetalert para deixar mais bonitim */
            alert( 'Notícia salva com sucesso!' );
        })
        .fail(function (erro) {
            $('input[name="_method"]').val('');
            $('form[name="form-crud"]').attr('action', '/api/v1/noticias');
            alert('Ocorreu algum erro. Tente novamente.');
            console.log(erro)
        })
})

$('#btn-clean').click(function () {
    $('input[name="_method"]').val('');
    $('form[name="form-crud"]').attr('action', '/api/v1/noticias');
    document.querySelector('form[name="form-crud"]').reset();
    CKEDITOR.instances.conteudo.setData('', function () {
        this.updateElement();
    })
});

function exibir(id) {
    $.get('/api/v1/noticias/' + id)
        .done(function (response) {
            /** populando modal */
            $('#modalExibirLabel').html( response.titulo );
            $('#modalExibir #eautor').html( response.autor);
            $('#modalExibir #ecategoria').html( response.categoria );
            $('#modalExibir #epalavras-chaves').html( response.palavras_chaves );
            $('#modalExibir #econteudo').html( response.conteudo );

            $('#modalExibir').modal('show');
        })
}

function editar(id) {
    $.get('/api/v1/noticias/' + id)
        .done(function (response) {
            /** populando formulário */
            $('input[name="titulo"]').val( response.titulo );
            $('input[name="autor"]').val( response.autor );
            $('input[name="categoria"]').val( response.categoria );
            $('input[name="palavras_chaves"]').val( response.palavras_chaves );
            CKEDITOR.instances.conteudo.setData( response.conteudo , function () {
                this.updateElement();
            })

            /** Acertando nova action e _method field */
            var form = $('form[name="form-crud"]')
            form.attr('action', '/api/v1/noticias/'+id)
            $('input[name="_method"]').val('PUT');

        })
}

function deletar(id) {
    if (confirm('Você tem certeza dessa ação ?')) {

        $('input[name="_method"]').val('DELETE');
        var form = $('form[name="form-crud"]')

        /** processar requisiaçao */
        $.post('/api/v1/noticias/' + id, form.serialize())
            .done(function (response) {
                $('input[name="_method"]').val('');

                /** Atualizando Tabela GLOBAL*/
                tabela.ajax.reload();

                /** trocar isso por algo como sweetalert para deixar mais bonitim */
                alert('Notícia deletada com sucesso!');
            })
            .fail(function (erro) {
                $('input[name="_method"]').val('');
                alert('Ocorreu algum erro. Tente novamente.');
            })
    }
}