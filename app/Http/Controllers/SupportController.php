<?php

namespace App\Http\Controllers;

use App\Mail\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SupportController extends Controller
{
    public function pintarFormulario()
    {
        return view('soporte.index');
    }
    public function procesarFormulario(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|min:10',
            'email' => 'required|email|max:255',
            'asunto' => 'required|string|min:10',
            'contenido' => 'required|string',
        ]);

        $email = auth()->user() != null ? auth()->user()->email : $request->email;
        try {
            Mail::to("responsable@correo.es")
                ->send(new Support($request->nombre, $request->contenido, $request->asunto, $email));
            return redirect()->route('home')->with('mensaje', 'Mensaje enviado');
        } catch (\Exception $ex) {
            return redirect()->route('soporte.index')->with('mensaje', 'No se pudo enviar el mensaje!!!');
        }
    }
}
