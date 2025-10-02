<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PersonController extends Controller
{
    public function index()
    {
        $people = Person::with('country')->latest()->paginate(10);
        return view('people.index', compact('people'));
    }

    public function create()
    {
        $countries = Country::orderBy('name')->get();
        $hobbiesOptions = ['music' => 'Música', 'sports' => 'Deportes', 'reading' => 'Lectura'];
        return view('people.create', compact('countries', 'hobbiesOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string'],
            'gender'      => ['required', 'in:M,F'],
            'hobbies'     => ['nullable', 'array'],
            'country_id'  => ['required', 'exists:countries,id'],
        ]);

        try {
            Person::create($validated);
            return redirect()->route('people.index')->with('success', 'Registro creado correctamente.');
        } catch (\Throwable $e) {
            Log::error('Error creando persona', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Ocurrió un error al crear el registro.');
        }
    }

    public function edit(Person $person)
    {
        $countries = Country::orderBy('name')->get();
        $hobbiesOptions = ['music' => 'Música', 'sports' => 'Deportes', 'reading' => 'Lectura'];
        return view('people.edit', compact('person', 'countries', 'hobbiesOptions'));
    }

    public function update(Request $request, Person $person)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string'],
            'gender'      => ['required', 'in:M,F'],
            'hobbies'     => ['nullable', 'array'],
            'country_id'  => ['required', 'exists:countries,id'],
        ]);

        try {
            $person->update($validated);
            return redirect()->route('people.index')->with('success', 'Registro actualizado correctamente.');
        } catch (\Throwable $e) {
            Log::error('Error actualizando persona', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Ocurrió un error al actualizar el registro.');
        }
    }

    public function destroy(Person $person)
    {
        try {
            $person->delete();
            return redirect()->route('people.index')->with('success', 'Registro eliminado correctamente.');
        } catch (\Throwable $e) {
            Log::error('Error eliminando persona', ['error' => $e->getMessage()]);
            return back()->with('error', 'Ocurrió un error al eliminar el registro.');
        }
    }
}
