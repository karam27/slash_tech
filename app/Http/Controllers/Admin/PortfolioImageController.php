<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioImageController extends Controller
{
    public function destroy($id): RedirectResponse
    {
        $image = PortfolioImage::findOrFail($id);


        if (Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }
        $image->delete();

        return back()->with('success', 'تم حذف الصورة بنجاح');
    }

    
}
