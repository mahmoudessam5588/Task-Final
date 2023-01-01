<?php
declare(strict_types=1);
namespace App\Models;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ChartController extends Controller
{
    public function lineChart()
    {
        
        $result = DB::select(DB::raw("SELECT categories.name as cat,products.name as pod , products.category_id as rod  FROM categories LEFT JOIN products on categories.id = products.category_id GROUP BY products.price desc"));
        $data = "";
        foreach($result as $val){
            $data.="['".$val->cat."',".$val->pod.",".$val->rod."],";
        };
        return view('chart', compact('data'));
    }
}
