<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::where('active', true)->latest()->paginate(12);
        return view('pets.index', compact('pets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kind' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0',
            'age' => 'required|integer|min:0',
            'breed' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = 'no-image.png';
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        Pet::create([
            'name' => $request->name,
            'kind' => $request->kind,
            'weight' => $request->weight,
            'age' => $request->age,
            'breed' => $request->breed,
            'location' => $request->location,
            'description' => $request->description,
            'image' => $imageName,
            'active' => true,
            'adopted' => false,
        ]);

        return redirect()->route('pets.index')->with('message', 'Pet created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        return view('pets.show', compact('pet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        return view('pets.edit', compact('pet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kind' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0',
            'age' => 'required|integer|min:0',
            'breed' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'kind', 'weight', 'age', 'breed', 'location', 'description']);

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si no es la por defecto
            if ($pet->image && $pet->image !== 'no-image.png') {
                $oldImagePath = public_path('images/' . $pet->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $pet->update($data);

        return redirect()->route('pets.index')->with('message', 'Pet updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        $pet->update(['active' => false]);
        return redirect()->route('pets.index')->with('message', 'Pet inactivated successfully!');
    }
}
