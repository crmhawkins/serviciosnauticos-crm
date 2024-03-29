<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Club;
use App\Models\UserClub;
use App\Models\User;

class HomeComponent extends Component
{
    public $clubs;
    public function mount(){
        if(Auth::user()->role == 1){
            $this->clubs = Club::all();
        }else{
            $this->clubs = Club::whereIn('id', UserClub::where('user_id', Auth::id())->pluck('club_id'))->get();
        }
    }
    public function render()
    {
        return view('livewire.home-component');
    }

    public function seleccionarClub($id){
        session()->put('clubSeleccionado', $id);
        session()->put('clubName', Club::find($id)->nombre);
        return redirect()->route('socios.index');
    }
    public function aceptarProteccion()
    {
        $userid = Auth::user()->id;
        $user= User::find($userid);
        $user->proteccion = true;
        $user->save();
        $this->redirectRoute('home');
    }

    public function rechazarProteccion()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
