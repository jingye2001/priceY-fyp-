<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\laptop;
use App\Models\Compare;

class laptopComparisonController extends Controller
{
    //user
    public function compare($id)
    {
        $compareLaptop = laptop::findOrFail($id);

        // Get 5 random laptops from the database for comparison
        $comparisonLaptops = laptop::where('id', '!=', $id)->inRandomOrder()->limit(5)->get();
        if (!$comparisonLaptops) {
            $comparisonLaptops = [];
        }


        return view('compareLaptop', [
            'laptop' => $compareLaptop,
            'comparisonLaptops' => $comparisonLaptops,
        ]);
    }




    public function searchAndAdd(Request $request, $id)
    {
        $keyword = $request->input('keyword');

        // Convert the keyword to a regex pattern
        $keywords = explode(' ', $keyword);
        $regexPattern = implode('.*', $keywords);
        $regexPattern = '.*' . $regexPattern . '.*';

        // 搜索基于关键词的产品
        $searchResults = laptop::where('name', 'REGEXP', $regexPattern)
            ->orWhere('manufacturer', 'REGEXP', $regexPattern)
            ->get();

        $compareLaptop = laptop::findOrFail($id);

        if (!is_countable($searchResults)) {
            $searchResults = collect([]);
        }        

        // 添加以下条件来检查搜索结果是否为空，如果为空则显示 "Can't find the laptop" 消息
        if (count($searchResults) == 0) {
            $searchResults = [];
            $notFoundMessage = "Can't find the laptop.";
            return view('compareLaptop', [
                'laptop' => $compareLaptop,
                'searchResults' => $searchResults,
                'notFoundMessage' => "Can't find the laptop."
            ]);
        }
        return view('compareLaptop', [
            'laptop' => $compareLaptop,
            'comparisonLaptops' => $searchResults
        ]);        
    }


    public function addToComparisonList($id, $compareId)
    {
        // 查找要对比的笔记本电脑
        $laptop = Laptop::findOrFail($id);
        $comparedLaptop = Laptop::findOrFail($compareId);
    
        // 检查是否已存在相同的比较记录
        $existingComparison = Compare::where('laptop_id', $laptop->id)
            ->where('compared_laptop_id', $comparedLaptop->id)
            ->first();
    
        if (!$existingComparison) {
            // 如果不存在相同的比较记录，创建一个新的比较记录
            Compare::create([
                'laptop_id' => $laptop->id,
                'compared_laptop_id' => $comparedLaptop->id,
            ]);
        }
    
        // 设置第二个比较的笔记本电脑
        $secondComparedLaptop = $comparedLaptop;
    
        return view('compareLaptop', [
            'laptop' => $laptop,
            'secondComparedLaptop' => $secondComparedLaptop
        ]);
    }

    public function index(Request $request)
    {
        $laptop_id = $request->input('laptop_id');
        $laptop = laptop::findOrFail($laptop_id);

        $comparisonLaptops = [];
        return view('compareLaptop', ['laptop' => $laptop, 'comparisonLaptops' => $comparisonLaptops]);
    }

    public function removeComparison($id)
    {
        $laptop = laptop::findOrFail($id);
        Compare::where('laptop_id', $laptop->id)->delete();
        // 获取搜索结果或设置为空数组，具体取决于您的搜索逻辑
        $searchResults = [];
        $comparisonLaptops = Compare::where('laptop_id', $laptop->id)->get();
        
        return view('compareLaptop', [
            'laptop' => $laptop,
            'searchResults' => $searchResults,
            'comparisonLaptops' => $comparisonLaptops
        ]);
    }


}
