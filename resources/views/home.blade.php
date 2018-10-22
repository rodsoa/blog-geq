@extends('layouts.blog')

@section('js')
<script>
    $(document).ready(function(){
        $.get('/api/v1/noticias')
         .done(function( response ) {
             html = '';
             for(cont=0; cont < response.length; cont++) {
                var template = '<div class="post-preview">'
                    template += '<a href="/noticia/'+response[cont].id+'">'
                    template += '<h2 class="post-title">'+ response[cont].titulo+'</h2>'
                    template += '</a>'
                    template += '<p class="post-meta">Postado por '+ response[cont].autor+'<a href="#"></a> em '+ response[cont].created_at + '</p>'
                    template += '</div>'
                    template += '<hr>'

                html += template;
             }

             $('#noticias').html( html )
         })
    })
</script>
@stop