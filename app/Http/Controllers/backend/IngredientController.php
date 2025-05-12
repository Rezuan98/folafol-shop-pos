<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\StockAdjustment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class IngredientController extends Controller
{
    /**
     * Display a listing of the ingredients
     */
    public function index()
    {
        $ingredients = Ingredient::all();
        return view('backend.ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new ingredient
     */
    public function create()
    {
        return view('backend.ingredients.create');
    }

    /**
     * Store a newly created ingredient
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'current_stock' => 'required|numeric|min:0',
            'unit' => 'required|string|in:g,kg,ml,l',
            'minimum_stock' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle data
        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('ingredients', 'public');
            $data['image'] = $imagePath;
        }

        // Create the ingredient
        Ingredient::create($data);

        return redirect()->route('admin.ingredients.index')
            ->with('success', 'Ingredient added successfully');
    }

    /**
     * Show the form for editing the specified ingredient
     */
    public function edit(Ingredient $ingredient)
    {
        return view('backend.ingredients.edit', compact('ingredient'));
    }

    /**
     * Update the specified ingredient
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'current_stock' => 'required|numeric|min:0',
            'unit' => 'required|string|in:g,kg,ml,l',
            'minimum_stock' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle data
        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($ingredient->image) {
                Storage::disk('public')->delete($ingredient->image);
            }
            
            $imagePath = $request->file('image')->store('ingredients', 'public');
            $data['image'] = $imagePath;
        }

        // Update the ingredient
        $ingredient->update($data);

        return redirect()->route('admin.ingredients.index')
            ->with('success', 'Ingredient updated successfully');
    }

    /**
     * Remove the specified ingredient
     */
    public function destroy(Ingredient $ingredient)
    {
        // Delete image if exists
        if ($ingredient->image) {
            Storage::disk('public')->delete($ingredient->image);
        }
        
        $ingredient->delete();

        return redirect()->route('admin.ingredients.index')
            ->with('success', 'Ingredient deleted successfully');
    }

    /**
     * Show the form for adjusting stock
     */
    public function showAdjustStock(Ingredient $ingredient)
    {
        return view('backend.ingredients.adjust_stock', compact('ingredient'));
    }

    /**
     * Process stock adjustment
     */
    public function adjustStock(Request $request, Ingredient $ingredient)
    {
        // Validate the request
        $request->validate([
            'quantity' => 'required|numeric|not_in:0',
            'type' => 'required|in:in,out,wastage,adjustment',
            'notes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Create stock adjustment record
            $adjustment = new StockAdjustment();
            $adjustment->ingredient_id = $ingredient->id;
            $adjustment->quantity = $request->type == 'in' || $request->type == 'adjustment' 
                ? abs($request->quantity) 
                : -abs($request->quantity);
            $adjustment->type = $request->type;
            $adjustment->notes = $request->notes;
            $adjustment->save();

            // Update ingredient stock
            $ingredient->current_stock += $adjustment->quantity;
            
            // Ensure stock is not negative
            if ($ingredient->current_stock < 0) {
                $ingredient->current_stock = 0;
            }
            
            $ingredient->save();

            DB::commit();

            return redirect()->route('admin.ingredients.index')
                ->with('success', 'Stock adjusted successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error adjusting stock: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display low stock ingredients
     */
    public function lowStock()
    {
        $ingredients = Ingredient::whereRaw('current_stock <= minimum_stock')->get();
        return view('backend.ingredients.low_stock', compact('ingredients'));
    }

    /**
     * View stock history for an ingredient
     */
    public function stockHistory(Ingredient $ingredient)
    {
        $adjustments = $ingredient->stockAdjustments()->orderBy('created_at', 'desc')->get();
        return view('backend.ingredients.stock_history', compact('ingredient', 'adjustments'));
    }
}