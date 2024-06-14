<?php

namespace App\Http\Controllers;

use App\ArchievedInvoice;
use App\Invoice;
use App\InvoiceAttachment;
use App\InvoicesDetail;
use App\Notifications\adminNotify;
use App\Notifications\myNotify;
use App\Product;
use App\products;
use App\Section;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InvoiceExport;


use Notification;

class InvoiceController extends Controller
{
    public function show_invoices()
    {
        return view(
            'invoices.invoices',
            [
                'invoices' => Invoice::all()
            ]
        );
    }
    public function add_invoice()
    {
        return view(
            'invoices.add_invoice',
            [
                'sections' => Section::all(),
                'products' => Product::all()
            ]
        );
    }


    public function store_invoice(Request $request)
    {
        Invoice::create([

            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'section_id' => $request->section,
            'product_id' => $request->product,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Rate_VAT' => $request->Rate_VAT,
            'Value_VAT' => $request->Value_VAT,
            'Total' => $request->Total,
            'note' => $request->note,
            'pic' => $request->pic,
            'Status' => 'غير مدفوعه',
            'Value_Status' => 0,
            'created_at' => now()

        ]);

        $invoice_id = Invoice::latest()->first()->id;


        InvoicesDetail::create([
            'invoice_id' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->section,
            'Status' => 'غير مدفوعه',
            'Value_Status' => 0,
            'note' => $request->note,
            'user' => Auth::user()->name,


        ]);

        if ($request->hasFile('pic')) {

            $invoice_id = Invoice::latest()->first()->id;
            $image = $request->file('pic');              // c:  .tmp
            $file_name = $image->getClientOriginalName();    // تسميه الصورة.jpg
            $invoice_number = $request->invoice_number;

            $attachments = new InvoiceAttachment();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            // move pic
            // $imageName = $request->pic->getClientOriginalName();  // تسميه الصورة بطريه تانيه
            $request->pic->move(public_path('Attachments/' . $invoice_number), $file_name);
        }

        // mail notification
        // Notification::send(User::first(), new myNotify($invoice_id)); //for mail notification
        $invoice_id = Invoice::latest()->first()->id;
        Notification::send(User::first(), new adminNotify($invoice_id)); //for db notification

        //database notification
        // $user = User::get();








        // return response($request);
        session()->flash('success', 'تم انشاء فاتورة بنجاح');
        return redirect('/show_invoices');
    }

    public function delete_invoice(Request $request)
    {
        $invoice_number = Invoice::where('id', $request->invoice_id)->first('invoice_number');
        $file_name = InvoiceAttachment::where('invoice_id', $request->invoice_id)->first('file_name');
        Invoice::where('id', $request->invoice_id)->forceDelete();
        Storage::disk('public_uploads')->delete($invoice_number . '/' . $file_name);

        session()->flash('delete_invoice', 'تم حذف الفاتورة بنجاح');
        return redirect('/show_invoices');
    }
    public function change_value_status(Request $request)
    {
        return view('invoices.change_value_status', [

            'invoice' => Invoice::where('id', $request->invoice_id)->first(),
            'invoice_attachment' => InvoiceAttachment::where('invoice_id', $request->invoice_id)->get(),
            'sections' => Section::all(),
            'products' => Product::all(),
        ]);


    }
    // return response($request);

    public function ajaxFunc($id)
    {
        //  key  ,   value   in ajax function in the pluck
        $selectedAjax = DB::table('products')->where('section_id', $id)->pluck('product_name', 'id');
        return json_encode($selectedAjax);
    }


    public function detail_invoice(Request $request)
    {

        if (InvoiceAttachment::where('invoice_id', $request->invoice_id)->count() > 0) {

            $invoice_details = DB::table('invoices_details')->where('invoice_id', $request->invoice_id)->select('*')->get();
            // $invoice_details = InvoicesDetail::findMany($request->invoice_id);
            $invoice_attachments = DB::table('invoice_attachments')->where('invoice_id', $request->invoice_id)->get();
            $invoice = DB::table('invoices')->where('id', $request->invoice_id)->get()->first();


            return view(
                'invoices.invoice_details',
                compact('invoice_attachments', 'invoice_details', 'invoice')

            );
        } else {
            session()->flash('no_attachment', 'لا يوجد مرفق لهذه الفاتورة');
            return redirect()->route('show_invoices');
            // return response($request);
        }

    }
    public function edit_invoice(Request $request)
    {




        return view(
            'invoices.edit_invoice',
            [


                'invoice' => Invoice::where('id', $request->invoice_id)->first(),
                'invoice_attachment' => InvoiceAttachment::where('invoice_id', $request->invoice_id)->get(),
                'sections' => Section::all(),
                'products' => Product::all(),



                #################________      query builder فى اظهار السماء العلاقات صعب   ____________ ####################

                // 'invoice' => DB::table('invoices')->where('id', $request->invoice_id)->get()->first(),
                // 'invoice_attachment' => DB::table('invoice_attachments')->where('invoice_id', $request->invoice_id)->get()->first(),


            ]
        );

    }
    public function store_edit_invoice(Request $request)
    {
        Invoice::findOrFail($request->invoice_id)->update([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'section_id' => $request->section,
            'product_id' => $request->product,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Rate_VAT' => $request->Rate_VAT,
            'Value_VAT' => $request->Value_VAT,
            'Total' => $request->Total,
            'note' => $request->note,



        ]);

        session()->flash('edit_success', 'تم تعديل الفاتورة بنجاح');
        return redirect('/show_invoices');
        // return response($request);
    }



    public function store_change_value_status(Request $request)
    {
        $invoice_id = $request->invoice_id;

        $fetched = Invoice::where('id', $invoice_id)->select('product_id', 'section_id')->first();

        if ($request->change_status == 1) {
            Invoice::where('id', $invoice_id)
                ->update([
                    'Value_Status' => $request->change_status,
                    'Status' => 'مدفوعه',

                ]);


            InvoicesDetail::create([
                'invoice_id' => $invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $fetched->product_id,
                'section' => $fetched->section_id,
                'Status' => 'مدفوعه ',
                'Value_Status' => 1,
                'note' => $request->note,
                'user' => Auth::user()->name,
                'created_at' => $request->invoice_Date
            ]);

        } else if ($request->change_status == 2) {
            Invoice::where('id', $invoice_id)
                ->update([
                    'Value_Status' => $request->change_status,

                    'Status' => 'مدفوعه جزئيا'
                ]);
            InvoicesDetail::create([
                'invoice_id' => $invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $fetched->product_id,
                'section' => $fetched->section_id,
                'Status' => 'مدفوعه جزئيا ',
                'Value_Status' => 2,
                'note' => $request->note,
                'user' => Auth::user()->name,
                'created_at' => $request->invoice_Date
            ]);

        }

        session()->flash('edit_done');
        return redirect('/show_invoices');
        // return response($request);
    }
    public function To_archieve(Request $request)
    {

        Invoice::where('id', $request->invoice_id)->delete();
        ArchievedInvoice::create([
            'invoice_number' => $request->invoice_number,
            'invoice_id' => $request->invoice_id,
        ]);
        session()->flash('archieved');
        return redirect('/show_invoices');
        //  return response($request);   
    }


    public function From_archieve(Request $request)
    {
        Invoice::withTrashed()->where('id', $request->invoice_id)->restore();
        ArchievedInvoice::where('invoice_id', $request->invoice_id)->delete();
        session()->flash('archieve_stored');
        return redirect('/show_invoices');
        // return response($request);
    }
    public function views_archieve(Request $request)
    {

        return view('invoices.archieved_invoices', [

            'invoice' => Invoice::all()
        ]);
    }


    public function print_invoice(Request $request)
    {

        return view('invoices.print_invoice', [
            'invoices' => Invoice::find($request->invoice_id)->first()
        ]);
        // return response($request);
    }
    public function invoice_export()
    {
        // return 'mlmflfm';
        return Excel::download(new InvoiceExport, 'users.xlsx');
    }


}

