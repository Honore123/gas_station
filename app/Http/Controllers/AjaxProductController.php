<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class AjaxProductController extends Controller
{
    public function __invoke(ProductCategory $category)
    {
        $products = Product::where('category_id', $category->id)->get();

        foreach ($products as $product) {
            $images = json_decode($product->images, true);
            echo '<tr>
                    <td class="text-right"><input type="checkbox" name="selected[]" class="form-check-input" value="'.$product->id.'">
                    <input type="hidden" name="product[]" value="'.$product->id.'">
                    <input type="hidden" name="amount[]" value="'.$product->purchase_price.'">
                    </td>
                    <td><img src="'.asset("storage/products/images/".$images[0]).'" width="70" alt=""></td>
                    <td>'.$product->product_name.'</td>
                    <td><input type="number" name="quantity[]" max="'.$product->quantity.'" class="form-control" style="width: 50%"></td>
                </tr>';
        }
    }
}
