<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Padron;
use App\Models\Votante;
use Illuminate\Http\Request;


class PadronController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //devolver padron paginado con sus distrito y municipio
        $padron = Padron::with('distrito', 'municipio')->paginate(20);
        return response()->json($padron);
        // $padron = Padron::paginate(10);
        // return response()->json($padron);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // guardar en la base de datos
        $data = $request->all();
        //el campo $data['image'] es una imagen en base64 toma la imagen y llevala a 200x200 y almacena en base64
        if (isset($data['image'])) {
            $data['image'] = $this->base64ToImage($data['image'], 200, 200, 'padron');
        }
        // Save the data to the database
        $padron = Padron::create($data);
        return response()->json($padron, 201);
    }

    /**
     * Convert base64 image to image
     */
    public function base64ToImage($base64, $width, $height, $folder)
    {
        //optener la url del servidor
        $image_parts = explode(";base64,", $base64);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folder . uniqid() . '.' . $image_type;
        file_put_contents(public_path() . '/' . $file, $image_base64);
        //cambiar el tamaño de la imagen
        $image = imagecreatefromstring(file_get_contents(public_path() . '/' . $file));
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));
        imagejpeg($new_image, public_path() . '/' . $file, 100);
        return 'https://fdp.darielabreu.com/' . $file;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // mostrar un solo registro por card_id
        $padron = Padron::where('card_id', $id)->with('distrito', 'municipio')->first();
        //validar que exista el registro
        if (!$padron) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($padron);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // actualizar un solo registro por id
        $padron = Padron::find($id);
        $padron->update($request->all());
        if (isset($request->image)) {
            $padron->image = $this->base64ToImage($request->image, 200, 200, 'padron');
        }
        $padron->save();
        return response()->json($padron);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //borrar el registro en votantes
        $votantesId = Votante::where('padron_id', $id)->pluck('id')->toArray();
        Votante::destroy($votantesId);
        // borrar un solo registro por id
        $padron = Padron::find($id);
        $padron->delete();
        return response()->json(null, 204);
    }
    public function quantityByPadron()
    {
        $padron = Padron::count();
        return response()->json($padron);
    }
    public function getPadron($paginate)
    {
        //valida si viene mesa en la url y filtra por id de mesa y distrito que viene en la url
        if (request()->has('mesa') && request()->has('distrito')) {
            $padron = Padron::where('mesa', request('mesa'))->where('distrito_id', request('distrito'))->with('distrito', 'municipio')->paginate($paginate);
            return response()->json($padron);
        }
        //valida si viene mesa en la url y filtra por id de mesa y municipio que viene en la url
        if (request()->has('mesa') && request()->has('municipio')) {
            $padron = Padron::where('mesa', request('mesa'))->where('municipio_id', request('municipio'))->with('distrito', 'municipio')->paginate($paginate);
            return response()->json($padron);
        }
        //valida si viene mesa en la url y filtra por id de mesa que viene en la url
        if (request()->has('mesa')) {
            $padron = Padron::where('mesa', request('mesa'))->with('distrito', 'municipio')->paginate($paginate);
            return response()->json($padron);
        }
        //valida si viene distrito en la url y filtra por id de distrito que viene en la url
        if (request()->has('distrito')) {
            $padron = Padron::where('distrito_id', request('distrito'))->with('distrito', 'municipio')->paginate($paginate);
            return response()->json($padron);
        }
        //valida si ciene municipio en la url y filtra por id de munucipio que viene en la url
        if (request()->has('municipio')) {
            $padron = Padron::where('municipio_id', request('municipio'))->with('distrito', 'municipio')->paginate($paginate);
            return response()->json($padron);
        }

        //devolver padron paginado con sus distrito y municipio
        $padron = Padron::with('distrito', 'municipio')->paginate($paginate);
        return response()->json($padron);
    }
    public function getQtyPadron()
    {
        //valida si viene mesa en la url y filtra por id de mesa y distrito que viene en la url
        if (request()->has('mesa') && request()->has('distrito')) {
            $padron = Padron::where('mesa', request('mesa'))->where('distrito_id', request('distrito'))->with('distrito', 'municipio')->count();
            //contar cuentos registros tienen el campo $padron-voto = 1
            $votos = Padron::where('mesa', request('mesa'))->where('distrito_id', request('distrito'))->where('voto', 1)->with('distrito', 'municipio')->count();
            //Cantidad de Votantes inscritos
            $votantesInscritos = Votante::join('padron', 'padron.id', '=', 'votantes.padron_id')->where('mesa', request('mesa'))->where('distrito_id', request('distrito'))->count();
            return [
                'padron' => $padron,
                'votos' => $votos,
                'votantes_inscritos' => $votantesInscritos
            ];
        }
        //valida si viene mesa en la url y filtra por id de mesa y municipio que viene en la url
        if (request()->has('mesa') && request()->has('municipio')) {
            $padron = Padron::where('mesa', request('mesa'))->where('municipio_id', request('municipio'))->with('distrito', 'municipio')->count();
            //contar cuentos registros tienen el campo $padron-voto = 1
            $votos = Padron::where('mesa', request('mesa'))->where('municipio_id', request('municipio'))->where('voto', 1)->with('distrito', 'municipio')->count();
            //Cantidad de Votantes inscritos
            $votantesInscritos = Votante::join('padron', 'padron.id', '=', 'votantes.padron_id')->where('mesa', request('mesa'))->where('municipio_id', request('municipio'))->count();
            return [
                'padron' => $padron,
                'votos' => $votos,
                'votantes_inscritos' => $votantesInscritos
            ];
        }
        //valida si viene mesa en la url y filtra por id de mesa que viene en la url
        if (request()->has('mesa')) {
            $padron = Padron::where('mesa', request('mesa'))->with('distrito', 'municipio')->count();
            //contar cuentos registros tienen el campo $padron-voto = 1
            $votos  = Padron::where('mesa', request('mesa'))->where('voto', 1)->with('distrito', 'municipio')->count();
            //Cantidad de Votantes inscritos
            $votantesInscritos = Votante::join('padron', 'padron.id', '=', 'votantes.padron_id')->where('mesa', request('mesa'))->count();
            return
                [
                    'padron' => $padron,
                    'votos' => $votos,
                    'votantes_inscritos' => $votantesInscritos
                ];
        }
        //valida si viene distrito en la url y filtra por id de distrito que viene en la url
        if (request()->has('distrito')) {
            $padron = Padron::where('distrito_id', request('distrito'))->with('distrito', 'municipio')->count();
            //contar cuentos registros tienen el campo $padron-voto = 1
            $votos = Padron::where('distrito_id', request('distrito'))->where('voto', 1)->with('distrito', 'municipio')->count();
            //Cantidad de Votantes inscritos
            $votantesInscritos = Votante::join('padron', 'padron.id', '=', 'votantes.padron_id')->where('distrito_id', request('distrito'))->count();
            return
                [
                    'padron' => $padron,
                    'votos' => $votos,
                    'votantes_inscritos' => $votantesInscritos
                ];
        }
        //valida si ciene municipio en la url y filtra por id de munucipio que viene en la url
        if (request()->has('municipio')) {
            $padron = Padron::where('municipio_id', request('municipio'))->with('distrito', 'municipio')->count();
            //contar cuentos registros tienen el campo $padron-voto = 1
            $votos = Padron::where('municipio_id', request('municipio'))->where('voto', 1)->with('distrito', 'municipio')->count();
            //Cantidad de Votantes inscritos
            $votantesInscritos = Votante::join('padron', 'padron.id', '=', 'votantes.padron_id')->where('municipio_id', request('municipio'))->count();
            return
                [
                    'padron' => $padron,
                    'votos' => $votos,
                    'votantes_inscritos' => $votantesInscritos
                ];
        }

        $padron = Padron::with('distrito', 'municipio')->count();
        //contar cuentos registros tienen el campo $padron-voto = 1
        $votos = Padron::where('voto', 1)->with('distrito', 'municipio')->count();
        //Contar Votantes inscritos
        $votantesInscritos = Votante::join('padron', 'padron.id', '=', 'votantes.padron_id')->count();

        return
            [
                'padron' => $padron,
                'votos' => $votos,
                'votantes_inscritos' => $votantesInscritos
            ];;
    }
    public function updateVoto(Request $request)
    {
        $votante = Padron::find($request->id);
        $votante->voto  = $request->voto;
        $votante->save();
        return response()->json($votante);
    }
}
