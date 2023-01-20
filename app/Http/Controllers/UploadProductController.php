<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UploadProductController extends Controller
{
    public function __invoke()
    {
       $attribute = \request()->validate([
           'file' => ['required', 'file', 'max:5000', 'mimes:xlsx,xls,csv'],
       ]);
       $fileName  = $attribute['file']->getPathName();
       $objPHPExcel = IOFactory::load($fileName);
       $sheet = $objPHPExcel->getSheet(0);
       $highestRow = $sheet->getHighestRow();
       $highestColumn = 'j';
        ini_set('max_execution_time', '0');
       for ($i = 2; $i <= $highestRow; $i++){
           $rowData = $sheet->rangeToArray('A'.$i.':'.$highestColumn.$i,null,true,false)[0];
           if (Product::query()->where('barcode',$rowData[2])->exists()){
               $product = Product::query()->where('barcode',$rowData[2])->first();
               $product->update([
                   'quantity' => $product->quantity + $rowData[5],
                   ]);
               continue;
           }
           if (is_null($rowData[3])){
               $rowData[3] = $rowData[4];
           }
        //   $url = $rowData[1];
        //   $contents = file_get_contents($url);
        //   $name = substr($url, strrpos($url, '/') + 1);
        //   Storage::put('products/images/'.$name, $contents);
           $images = json_encode(['products/images/'.$rowData[1]]);
           $data = [
               'barcode' => $rowData[2],
               'product_name' => $rowData[2],
               'category_id' => $rowData[4],
               'material_id' => $rowData[8],
               'quantity' => $rowData[5],
               'unit' => $rowData[9],
               'retail_price' => $rowData[6],
               'purchase_price' => $rowData[7],
               'vendor_id' => 1,
               'images' => $images,
               'description' => $rowData[3],

           ];
           Product::create($data);
       }

       return redirect()->back()->with('success','Products Uploaded successfully');
    }
}
