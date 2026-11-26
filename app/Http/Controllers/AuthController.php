<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Afficher le formulaire d'inscription
    public function inscription()
    {
        return view('auth.inscription');
    }

    // Enregistrer un nouvel utilisateur
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'auteur';

        User::create($data);

        return redirect()->route('connexion')
            ->with('success', 'Inscription réussie. Connectez-vous.');
    }

    // Afficher le formulaire de connexion
    public function creerConnexion()
    {
        return view('auth.connexion');
    }

    // Connecter un utilisateur
    public function connecter(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('accueil'));
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    // Déconnecter l'utilisateur
    public function deconnecter(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('accueil');
    }
}

