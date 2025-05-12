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
        'price_small' => 'nullable|numeric|min:0',
        'price_medium' => 'nullable|numeric|min:0',
        'price_large' => 'nullable|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // 'is_available' => 'boolean',
    ]);

    // Step 2: Prepare the data
    $data = $request->except('image');
    $data['is_available'] = $request->has('is_available') ? 1 : 0;

    // Step 3: Handle image upload if present
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('juices', 'public');
    }

    // Step 4: Create and save the Juice object
    $juice = new Juice();
    $juice->fill($data);
    $juice->save();

    // Step 5: Redirect back with success message
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
    
    // Step 1: Validate the request
    // $request->validate([
    //     'name' => 'required|string|max:255',
    //     'description' => 'nullable|string',
    //     'price_small' => 'nullable|numeric|min:0',
    //     'price_medium' => 'nullable|numeric|min:0',
    //     'price_large' => 'nullable|numeric|min:0',
    //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     'is_available' => 'boolean',
    // ]);

    // Step 2: Prepare the data
    $data = $request->except('image');
    $data['is_available'] = $request->has('is_available') ? 1 : 0;

    // Step 3: Handle image upload (replace old image if needed)
    if ($request->hasFile('image')) {
        // Optionally delete the old image
        if ($juice->image && \Storage::disk('public')->exists($juice->image)) {
            \Storage::disk('public')->delete($juice->image);
        }

        $data['image'] = $request->file('image')->store('juices', 'public');
    }

    // Step 4: Update the juice object
    $juice->fill($data);
    $juice->save();

    // Step 5: Redirect back with success message
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