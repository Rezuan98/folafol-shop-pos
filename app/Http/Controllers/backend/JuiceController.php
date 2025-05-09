<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Juice;
use Illuminate\Support\Facades\Storage;

class JuiceController extends Controller
{
    /**
     * Display a listing of juices
     */
    public function index()
    {
        $juices = Juice::all();
        return view('backend.juice.index', compact('juices'));
    }

    /**
     * Show the form for creating a new juice
     */
    public function create()
    {
        return view('backend.juice.create');
    }

    /**
     * Store a newly created juice
     */
  public function store(Request $request)
{
    // Step 1: Validate incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price_small' => 'required|numeric|min:0',
        'price_medium' => 'required|numeric|min:0',
        'price_large' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Step 2: Retrieve all form inputs except the image
    $data = $request->except('image');

    // Step 3: Handle checkbox value for is_available
    // If the checkbox is checked, it sends 'on', otherwise it's absent.
    // Convert to integer: 1 (true) if checked, 0 (false) if not.
    $data['is_available'] = $request->has('is_available') ? 1 : 0;

    // Step 4: Handle optional image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('juices', 'public');
        $data['image'] = $imagePath;
    }

    // Step 5: Create the new Juice record
    Juice::create($data);

    // Step 6: Redirect with success message
    return redirect()->route('admin.juices.index')
        ->with('success', 'Juice added successfully');
}


    /**
     * Show the form for editing the specified juice
     */
    public function edit(Juice $juice)
    {
        return view('backend.juice.edit', compact('juice'));
    }

    /**
     * Update the specified juice
     */
    public function update(Request $request, Juice $juice)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_small' => 'required|numeric|min:0',
            'price_medium' => 'required|numeric|min:0',
            'price_large' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'boolean',
        ]);

        $data = $request->except('image');
        
        // Handle is_available checkbox
        $data['is_available'] = $request->has('is_available');
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($juice->image) {
                Storage::disk('public')->delete($juice->image);
            }
            
            $imagePath = $request->file('image')->store('juices', 'public');
            $data['image'] = $imagePath;
        }

        $juice->update($data);

        return redirect()->route('admin.juices.index')
            ->with('success', 'Juice updated successfully');
    }

    /**
     * Remove the specified juice
     */
    public function destroy(Juice $juice)
    {
        // Delete image if exists
        if ($juice->image) {
            Storage::disk('public')->delete($juice->image);
        }
        
        $juice->delete();

        return redirect()->route('admin.juices.index')
            ->with('success', 'Juice deleted successfully');
    }
}