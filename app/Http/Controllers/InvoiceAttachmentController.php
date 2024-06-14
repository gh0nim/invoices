<?php

namespace App\Http\Controllers;

use App\InvoiceAttachment;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InvoiceAttachmentController extends Controller
{
    public function show_attachment(Request $request)
    {


        $myfile = Storage::disk('public_uploads')
            ->getDriver()
            ->getAdapter()
            ->applyPathPrefix($request->invoice_number . '/' . $request->file_name);

        return response()->file($myfile);

        // return response($request);

    }

    public function download_attachment(Request $request)
    {


        $myfile = Storage::disk('public_uploads')
            ->getDriver()
            ->getAdapter()
            ->applyPathPrefix($request->invoice_number . '/' . $request->file_name);

        return response()->download($myfile);

        // return response($request);

    }

    public function delete_attachment(Request $request)
    {
        InvoiceAttachment::where('invoice_id', $request->invoice_id)->where('id',$request->attachment_id)->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name); //delete file only from pc an keep the folder
        session()->flash('deleted_attachment', 'تم حذف المرفق بنجاح');

        return redirect()->route('show_invoices');
        // return response($request);

    }
    public function add_new_attachment(Request $request)
    {
        
        if ($request->hasFile('file_name')) {




            $image = $request->file('file_name');              // c:  .tmp
            $file_name = $image->getClientOriginalName();    // تسميه الصورة.jpg
            $request->file_name->move(public_path('Attachments/' . $request->invoice_number), $file_name);

            InvoiceAttachment::where('invoice_id', $request->invoice_id)
            ->create([
                'file_name' => $file_name,
                'Created_by' => Auth::user()->getAuthIdentifierName(),
                'invoice_id' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
            ]);
            session()->flash('add_new_attachment', 'تم اضافة المرفق الجديد بنجاح');

            return redirect()->route('show_invoices');

        } else {
            session()->flash('empty_attachment', 'برجاء ادخال مرفق اولا');
            return redirect()->route('show_invoices');
            
        }
        // return response($request);
    }
}
