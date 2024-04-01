<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Demopost;
use App\Model\User;
use Illuminate\Support\Facades\Auth;
use App\Providers\PostsHelperServiceProvider;

class DemopostController extends Controller
{
    public function store(Request $request)
    {
        // Valider les données de la requête
        $request->validate([
            'text' => 'required|max:1000', // Exemple de validation pour le champ text
            'images' => 'nullable|array',  // Valider que le champ images est un tableau (pour plusieurs images)
            'images.*' => 'required|file|mimes:jpg,jpeg,png,gif,svg,mp4,mov,avi,webm|max:2048000', // Inclure les types de fichiers vidéo

        ]);
        // Traitement et stockage des images
        $imagesArray = [];
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $image) {
                $name = time().rand(1,100).'.'.$image->extension();
                $image->storeAs('public/images', $name);  // Stocker l'image dans le système de fichiers
                $imagesArray[] = $name;  
            }
        }else{
            return redirect()->back()->with('error', __('Pas de fichier (vidéo ou photo) de presentation sélectionnée'));
        }
        // Création du Demopost
        $demopost = new Demopost();
        $demopost->user_id = Auth::id(); // Assurez-vous que le modèle Demopost a un champ user_id pour la relation
        $demopost->text = $request->text;
        $demopost->images = json_encode($imagesArray); // Stocker les images sous forme de JSON
        $demopost->save();
    
        // Rediriger l'utilisateur avec un message de succès
        return redirect()->back()->with('success', __('Post créé avec succès'));
    }
    

    public function update(Request $request, $id)
    {
        $demopost = Demopost::findOrFail($id);
    
        // Assurer que l'utilisateur est autorisé à modifier le post
        if (Auth::id() !== $demopost->user_id) {
            return redirect()->back()->with('error',  __('Non autorisé') );
        }
    
        $request->validate([
            'text' => 'required|max:1000',
            'images' => 'nullable|array',
            'images.*' => 'required|file|mimes:jpg,jpeg,png,gif,svg,mp4,mov,avi,webm|max:2048000', // Inclure les types de fichiers vidéo
        ]);
    
        // Traitement et mise à jour des images
        $imagesArray = json_decode($demopost->images, true) ?? [];
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $image) {
                $name = time().rand(1,100).'.'.$image->extension();
                $image->storeAs('public/images', $name);
                $imagesArray[] = $name;
            }
        }else{
            return redirect()->back()->with('error', __('Pas de fichier (vidéo ou photo) de presentation sélectionnée'));
        }
    
        // Mise à jour du post
        $demopost->text = $request->text;
        $demopost->images = json_encode($imagesArray);
        $demopost->save();
    
        return redirect()->back()->with('success', __('Post mis à jour avec succès'));
    }
    

    public function destroy($id)
    {
        $demopost = Demopost::findOrFail($id);
    
        // Vérification des droits de l'utilisateur
        if (Auth::id() !== $demopost->user_id) {
            return redirect()->back()->with('error', __('Non autorisé') );
        }
    
        // Supprimer les images du serveur si nécessaire
        $images = json_decode($demopost->images, true);
        if (!empty($images)) {
            foreach ($images as $image) {
                $imagePath = public_path('images') . '/' . $image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }
    
        // Supprimer le post
        $demopost->delete();
    
        return redirect()->back()->with('success', __('Post supprimé avec succès'));
    }
    

    public function index($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $demoposts = Demopost::where('user_id', $user->id)->get();
    
        return view('demoposts.index', ['user' => $user, 'demoposts' => $demoposts]);
    }
    
    public function showProfile($username)
    {
        $username = User::where('username', $username)->firstOrFail();
        $user_id = Demopost::where('user_id', $user->id)->get();
    
        return view('pages.profile', compact('user_id', 'username'));
    }
    
       
    
}

