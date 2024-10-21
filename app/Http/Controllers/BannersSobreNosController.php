<?php

namespace App\Http\Controllers;

use App\Models\BannerSobreNos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BannersSobreNosController extends Controller
{
    public function index()
    {
        return view('sobre_nos.index'); // Retornar a view com os banners
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'banner_principal' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'banner_principal_mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'imagem_missao' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'remove_banner_principal' => 'nullable|boolean',
                'remove_banner_principal_mobile' => 'nullable|boolean',
                'remove_imagem_missao' => 'nullable|boolean',
            ]);

            $banner = BannerSobreNos::first();

            // Atualiza ou cria o banner
            if ($banner) {
                // Atualiza o banner principal
                if ($request->hasFile('banner_principal')) {
                    // Remove o banner anterior se houver
                    if ($banner->banner_principal) {
                        Storage::delete($banner->banner_principal);
                    }
                    $data['banner_principal'] = $request->file('banner_principal')->store('banners');
                } elseif ($request->remove_banner_principal) {
                    if ($banner->banner_principal) {
                        Storage::delete($banner->banner_principal);
                    }
                    $data['banner_principal'] = null;
                }

                // Atualiza o banner principal mobile
                if ($request->hasFile('banner_principal_mobile')) {
                    if ($banner->banner_principal_mobile) {
                        Storage::delete($banner->banner_principal_mobile);
                    }
                    $data['banner_principal_mobile'] = $request->file('banner_principal_mobile')->store('banners');
                } elseif ($request->remove_banner_principal_mobile) {
                    if ($banner->banner_principal_mobile) {
                        Storage::delete($banner->banner_principal_mobile);
                    }
                    $data['banner_principal_mobile'] = null;
                }

                // Atualiza a imagem da missão
                if ($request->hasFile('imagem_missao')) {
                    if ($banner->imagem_missao) {
                        Storage::delete($banner->imagem_missao);
                    }
                    $data['imagem_missao'] = $request->file('imagem_missao')->store('banners');
                } elseif ($request->remove_imagem_missao) {
                    if ($banner->imagem_missao) {
                        Storage::delete($banner->imagem_missao);
                    }
                    $data['imagem_missao'] = null;
                }

                $banner->update($data);
            } else {
                // Cria um novo banner
                if ($request->hasFile('banner_principal')) {
                    $data['banner_principal'] = $request->file('banner_principal')->store('banners');
                }
                if ($request->hasFile('banner_principal_mobile')) {
                    $data['banner_principal_mobile'] = $request->file('banner_principal_mobile')->store('banners');
                }
                if ($request->hasFile('imagem_missao')) {
                    $data['imagem_missao'] = $request->file('imagem_missao')->store('banners');
                }

                if ($data['banner_principal'] || $data['banner_principal_mobile'] || $data['imagem_missao']) {
                    BannerSobreNos::create($data);
                } else {
                    return redirect()->route('sobre-nos.index')->with('error', 'Por favor, envie pelo menos um banner ou uma imagem da missão.');
                }
            }

            return redirect()->route('sobre-nos.index')->with('success', 'Banner salvo com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao salvar banner: ' . $e->getMessage());
            return redirect()->route('sobre-nos.index')->with('error', 'Erro ao salvar o banner.');
        }
    }
}
