<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Controllers\Controller;
use App\Models\Noticia;

class NoticiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $noticias = Noticia::all();
        
        if ( $request->has('toDataTables') ) {

            $data = [];

            if ( count( $noticias ) ) {
                foreach( $noticias as $noticia ) {
                    $btns  = '<div class="btn-group text-right" role="group">';
                    $btns .= '<button type="button" class="btn btn-sm btn-default" onclick="exibir('.$noticia->id.')"><i class="fa fa-fw fa-eye"></i>exibir</button>';
                    $btns .= '<button type="button" class="btn btn-sm btn-warning" onclick="editar('.$noticia->id.')"><i class="fa fa-fw fa-edit"></i>editar</button>';
                    $btns .= '<button type="button" class="btn btn-sm btn-danger" onclick="deletar('.$noticia->id.')"><i class="fa fa-fw fa-trash"></i>deletar</button>';
                    $btns .= '</div>';
    
                    $data['data'][] = [
                        $noticia->id,
                        $noticia->titulo,
                        $noticia->autor,
                        $noticia->categoria,
                        $noticia->palavras_chaves,
                        $btns
                    ];
                }
            } else {
                $data['data'] = [];
            }

            return $data;
        }

        return $noticias;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->getData($request);

        try {
            $noticia = Noticia::create($data);
            return $noticia;
        } catch (Exception $exception) {
            return response()->json(['msg' => 'Ocorreu um erro interno'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $noticia = Noticia::findOrFail($id);
        return $noticia;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        
        $noticia = Noticia::findOrFail($id);
        $noticia->update($data);

        return response()->json(['msg' => 'Item atualizado com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $noticia = Noticia::findOrFail( $id );
        $noticia->delete();

        return response()->json(['msg' => 'Item deletado com sucesso'], 200);
    }

    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'titulo' => 'required|string|min:1|max:255',
            'autor' => 'required|string|min:1|max:255',
            'categoria' => 'required|string|min:1|max:255',
            'palavras_chaves' => 'nullable|string|min:1|max:255',
            'conteudo' => 'required'
     
        ];
        
        $data = $request->validate($rules);

        return $data;
    }
}
