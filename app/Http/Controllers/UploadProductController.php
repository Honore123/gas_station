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
       $highestColumn = 'h';
        ini_set('max_execution_time', '0');
       for ($i = 2; $i <= $highestRow; $i++){
           $rowData = $sheet->rangeToArray('A'.$i.':'.$highestColumn.$i,null,true,false)[0];
           if (Product::query()->where('barcode',$rowData[2])->exists()){
               continue;
           }
           if (is_null($rowData[3])){
               $rowData[3] = $rowData[4];
           }
          $url = $rowData[1];
          $contents = file_get_contents($url);
          $name = substr($url, strrpos($url, '/') + 1);
          Storage::put('products/images/'.$name, $contents);
           $images = json_encode(['products/images/'.$name]);
           $data = [
               'barcode' => $rowData[2],
               'product_name' => $rowData[2],
               'category_id' => 2,
               'material_id' => 2,
               'quantity' => $rowData[5],
               'unit' => 'piece',
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
