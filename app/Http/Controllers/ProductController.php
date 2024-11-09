<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
// use App\Http\Controllers\Exception;

class ProductController extends Controller
{
    //index function

    public function index(Request $request)
    {
        // Start with a query for products
        $query = Product::query();

        // Search functionality for product ID and description
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('product_id', 'like', '%' . $search . '%')->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        // Sorting functionality for name and price
        if ($request->filled('sort_by') && in_array($request->sort_by, ['name', 'price'])) {
            $sortOrder = $request->input('sort_order', 'asc'); // Default to ascending
            $query->orderBy($request->sort_by, $sortOrder);
        } else {
            // Default sorting by latest (assuming you have a 'created_at' column)
            $query->latest();
        }

        // Paginate the result
        $products = $query->paginate(3);

        return view('pages.index', compact('products'));
    }

    //create function
    public function create()
    {
        return view('pages.create');
    }

    //store function
    public function store(Request $request)
    {
        $validation = $request->validate([
            'product_id' => 'required|string|unique:products,product_id',
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $imagePath = null;
        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');
        }

        Product::create([
            'product_id' => $request->product_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);
        return redirect()->route('product.index');
    }
    //edit function
    public function edit($id)
    {
        $products = Product::where('id', $id)->first();
        return view('pages.edit', compact('products'));
    }

    //update functin
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'product_id' => 'required|string|unique:products,product_id,' . $id,
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);

        $imagePath = $product->image;
        if ($imagePath == null) {
            if ($request->has('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('images', $imageName, 'public');
            }
        } else {
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($product->image) {
                    $oldImagePath = public_path('storage/' . $product->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Store the new image manually in the public directory
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/images'), $imageName);

                // Set the new image path for database storage
                $imagePath = 'images/' . $imageName;
            }
        }

        $product->update([
            'product_id' => $request->input('product_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'image' => $imagePath,
        ]);

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }
    // show function
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.show', compact('product'));
    }
    //delete function
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index');
    }
}
