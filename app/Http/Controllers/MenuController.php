<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * return the view for the manipulation of the users
     */
    public function usuarios()
    {
        return view('menu.usuarios')->with('location', 'usuarios');
    }

    /**
     * return the view for the manipulation of the general data
     */
    public function datos_basicos()
    {
        return view('menu.datos_basicos')->with('location', 'datos_basicos');
    }

    /**
     * return the view for the manipulation of the personal
     */
    public function personal()
    {
        return view('menu.personal')->with('location', 'personal');
    }

    /**
     * return the view for the manipulation of the citas
     */
    public function citas()
    {
        return view('menu.citas')->with('location', 'citas');
    }
}
