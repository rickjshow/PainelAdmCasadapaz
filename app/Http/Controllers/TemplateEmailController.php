<?php

namespace App\Http\Controllers;

use App\Models\TemplateEmail;
use Illuminate\Http\Request;

class TemplateEmailController extends Controller
{

    public function update(Request $request) {

        $request->validate([
            'templates.*.conteudo' => 'required|string|max:255',
        ]);

        foreach ($request->input('templates') as $id => $data) {

            $template = TemplateEmail::find($id);

            if ($template) {

                $template->conteudo = $data['conteudo'];
                $template->save();
            }
        }

        return redirect()->back()->with('success', 'Templates atualizados com sucesso');
    }

}
