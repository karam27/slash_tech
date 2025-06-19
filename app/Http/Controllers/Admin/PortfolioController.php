<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolios = Portfolio::with('category')->latest()->get();
        return view('admin.portfolio.index', compact('portfolios'));
    }

    /**
     * عرض نموذج إضافة عمل جديد.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.portfolio.create', compact('categories'));
    }

    /**
     * حفظ العمل الجديد في قاعدة البيانات.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'project_url' => 'nullable|url',
            'images.*' => 'required|image|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('images')) {
            $firstImage = $request->file('images')[0];
            $imagePath = $firstImage->store('portfolio', 'public');
        }

        $portfolio = Portfolio::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
            'image_path' => $imagePath,
            'project_url' => $data['project_url'] ?? null,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('portfolio', 'public');
                $portfolio->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('admin.portfolio.index')->with('success', 'تمت إضافة العمل بنجاح');
    }
    /**
     * عرض نموذج تعديل عمل.
     */
    public function edit(Portfolio $portfolio)
    {
        $categories = Category::all();
        return view('admin.portfolio.edit', compact('portfolio', 'categories'));
    }

    /**
     * تحديث العمل.
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'project_url' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:2048',
            'deleted_images' => 'nullable|array',
            'deleted_images.*' => 'exists:portfolio_images,id',
        ]);

        // تحديث البيانات النصية
        $portfolio->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'project_url' => $request->project_url,
        ]);

        // تحديث الصورة الرئيسية
        if ($request->hasFile('image')) {
            if ($portfolio->image_path && Storage::disk('public')->exists($portfolio->image_path)) {
                Storage::disk('public')->delete($portfolio->image_path);
            }
            $portfolio->image_path = $request->file('image')->store('portfolio', 'public');
            $portfolio->save();
        }


        if ($request->has('deleted_images')) {
            $imagesToDelete = PortfolioImage::whereIn('id', $request->deleted_images)->get();

            foreach ($imagesToDelete as $image) {
                if (Storage::disk('public')->exists($image->path)) {
                    Storage::disk('public')->delete($image->path);
                }
                $image->delete();
            }
        }


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('portfolio', 'public');
                $portfolio->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('admin.portfolio.index')->with('success', 'تم تحديث العمل بنجاح');
    }


    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->image_path && Storage::disk('public')->exists($portfolio->image_path)) {
            Storage::disk('public')->delete($portfolio->image_path);
        }


        foreach ($portfolio->images as $image) {
            if (Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            }
            $image->delete();
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolio.index')->with('success', 'تم حذف العمل بنجاح');
    }
}
