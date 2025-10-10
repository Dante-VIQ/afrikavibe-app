<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AwinService;
use Illuminate\Routing\Controller;

class AwinController extends Controller
{
    protected AwinService $awin;

    public function __construct(AwinService $awin)
    {
        $this->awin = $awin;
    }

    public function index(Request $request)
    {
        $keyword = $request->input('q', 'travel');
        $limit = (int) $request->input('limit', 9);

        $products = $this->awin->searchProducts($keyword, $limit);

        // If you want JSON for debugging, you can return it:
        if ($request->wantsJson()) {
            return response()->json($products);
        }

        return view('components.advertisers', compact('products', 'keyword'));
    }
}
