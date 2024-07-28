<?php

namespace App\Http\Controllers;

use App\Models\Manhwa;
use Illuminate\Http\Request;

class ManhwaController extends Controller
{

    public function index(Request $request)
    {
      $manhwas = Manhwa::withCount('chapters')->get();
      return view('admin.manhwa.index', compact('manhwas'));
    }
  
    public function create(Request $request)
    {
  
  
      return view('admin.manhwa.create');
    }
  
  
    public function store(Request $request)
    {

        Manhwa::create($request->all());
 
      return redirect()->route('admin.manhwa.index');
    }
  
    public function edit(Request $request, $id)
    {
      $manhwa = Manhwa::findOrFail($id);
  
      return view('admin.manhwa.edit', compact('manhwa'));
    }
  
    public function update(Request $request)
    {
       $data =    $request->all();
       unset($data['_token']);
       Manhwa::where('id', $request->id)->update($data);

      return redirect()->route('admin.manhwa.index');
    }
  
    public function delete($id)
    {
      $manhwa = Manhwa::findOrFail($id);
      $manhwa->delete();
      return redirect()->route('admin.manhwa.index');
    }
  
}
