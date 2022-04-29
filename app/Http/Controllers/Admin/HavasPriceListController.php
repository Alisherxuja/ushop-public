<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Base\Products\Product;
use Illuminate\Http\Request;

class HavasPriceListController extends Controller
{
    public function import(Request $request)
    {
        $data = $request->validate([
            'file' => 'required|file|mimes:txt'
        ]);

        $name = 'priceList-' . time() . '.' . $request->file->extension();
        $request->file('file')->storeAs('price-list', $name, 'public');
        return success_out(['message' => 'File successfully upload']);
    }

    public function importFile()
    {

        $files = array_diff(scandir(storage_path('app/public/price-list'), 1), array('.', '..'));
        if (!isset($files[0])) {
            return error_out(['message' => 'File not found']);
        }

        try {
            $file = fopen(storage_path('app/public/price-list/' . $files[0]), 'r');
            $data = [];
            while (($line = fgetcsv($file, 0, ';')) !== false) {
                $line = mb_convert_encoding($line, 'utf8', 'windows-1251');
                if ($line[0] > 0) {
                    $data[] = [
                        'id' => $line[0],
                        'name_ru' => $line[1],
                        'name_uz' => $line[1],
                        'price' => (float)$line[2],
                        'stock' => $line[3],
                    ];
                }
            }
            fclose($file);
            foreach ($data as $datum) {
                Product::query()->updateOrCreate(['unicode' => $datum['id']], $datum);
            }
            return success_out(['message' => 'Successfully async products']);
        } catch (\Exception $e) {
            return error_out(['message' => $e->getMessage()]);
        }
    }
}