<?php

namespace App\Http\Controllers;

use App\Models\marital;
use Illuminate\Http\Request;
use App\Models\Probonocategory;

class SettingsController extends Controller
{
    public function index()
    {
        $categories = Probonocategory::all();
        $marital = marital::all();
        return view('settings',[
            'marital' => $marital,
            'categories' => $categories
        ]);
    }
    public function add_category(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category = new Probonocategory();
        $category->name = $request->name;
        $category->save();
        return redirect()->back()->with('message', 'Category Added Successfully');
    }
    public function edit_category(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category = Probonocategory::findorfail($request->token);
        $category->name = $request->name;
        $category->save();
        return redirect()->back()->with('message', 'Category Updated Successfully');	
        
    }
    public function delete_category(Request $request)
    {
        $category = Probonocategory::findorfail($request->token);
        $category->delete();
        return redirect()->back()->with('message', 'Category Deleted Successfully');	
        
    }
  
}
