<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public function show_sections()
    {
        return view(
            'sections.show_sections',
            [
                'sections' => Section::all()
            ]
        );
    }
    public function add_sections(Request $request)
    {
        $validatedData = Section::where('section_name', $request->section_name)->exists();
        if ($validatedData) {
            session()->flash('fail', 'القسم مسجل مسبقا');
            return redirect('/show_sections');
        } elseif ($request->section_name == '') {

            session()->flash('fail', ' اسم القسم مطلوب');
            return redirect('/show_sections');
        } else {
            Section::create([
                'section_name' => $request->section_name,
                'description' => $request->description,
                'created_by' => Auth::user()->name
            ]);
            session()->flash('success', 'تم اضافة القسم بنجاح');
            return redirect('/show_sections');
        }
    }
    public function delete_section(Request $request)
    {
        Section::find($request->section_id)->delete();
        session()->flash('delete_section', 'تم حذف القسم بنجاح');
        return redirect('/show_sections');
        // return response($request);
    }
    public function edit_sections(Request $request)
    {

        Section::where('id', $request->section_id)
            ->update([
                'section_name' => $request->section_name,
                'id' => $request->section_id,
                'description' => $request->description,

            ]);
        session()->flash('update_section', 'تم تعديل القسم بنجاح');

        return redirect('/show_sections');
        // return response($request);
    }
}
