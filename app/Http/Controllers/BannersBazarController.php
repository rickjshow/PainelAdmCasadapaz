<?php

namespace App\Http\Controllers;

use App\Models\BannerBazar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BannersBazarController extends Controller
{
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'banner_principal' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'banner_principal_mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $banner = BannerBazar::first();

            if ($banner) {

                if ($request->hasFile('banner_principal')) {

                    if ($banner->banner_principal) {
                        Storage::delete($banner->banner_principal);
                    }
                    $data['banner_principal'] = $request->file('banner_principal')->store('banners-bazar');
                }

                if ($request->hasFile('banner_principal_mobile')) {
                    if ($banner->banner_principal_mobile) {
                        Storage::delete($banner->banner_principal_mobile);
                    }
                    $data['banner_principal_mobile'] = $request->file('banner_principal_mobile')->store('banners-bazar');
                }

                $banner->update($data);
            } else {

                if ($request->hasFile('banner_principal')) {
                    $data['banner_principal'] = $request->file('banner_principal')->store('banners-bazar');
                }
                if ($request->hasFile('banner_principal_mobile')) {
                    $data['banner_principal_mobile'] = $request->file('banner_principal_mobile')->store('banners-bazar');
                }

                if ($data['banner_principal'] || $data['banner_principal_mobile']) {
                    BannerBazar::create($data);
                } else {
                    return redirect()->route('bazar.index')->with('error', 'Por favor, envie pelo menos um banner.');
                }
            }

            return redirect()->route('bazar.index')->with('success', 'Banner salvo com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao salvar banner: ' . $e->getMessage());
            return redirect()->route('bazar.index')->with('error', 'Erro ao salvar o banner.');
        }
    }

    public function remover(Request $request, $id)
    {
        $tipo = $request->input('type');

        $imagem = BannerBazar::find($id);

        if ($imagem) {

            if ($tipo === 'banner_principal') {
                Storage::delete($imagem->banner_principal);
                $imagem->banner_principal = null;
            } elseif ($tipo === 'banner_principal_mobile') {
                Storage::delete($imagem->banner_principal_mobile);
                $imagem->banner_principal_mobile = null;
            }

            $imagem->save();
            return redirect()->back()->with('success', 'Imagem excluída com sucesso!');
        }

        return redirect()->back()->with('error', 'Imagem não pôde ser excluída.');
    }
}
