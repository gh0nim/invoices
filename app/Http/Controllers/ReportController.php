<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Product;
use App\Section;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function show_reports()
    {
        $invoices = Invoice::all();
        $sections = Section::all();

        return view('invoices.show_reports', compact('invoices', 'sections'));
        // return response($invoices);
    }
    public function number_search(Request $request)
    {


        $invoice = Invoice::where('invoice_number', $request->invoice_number)->first();
        return view('invoices.show_reports', compact('invoice'));

        // return $request;
    }
    public function type_search(Request $request)
    {

        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $type = $request->type;



        if ($start_at == '' && $end_at == '' && isset($type)) {
            $many_invoices = Invoice::where('Status', '=', $type)
                ->get();

        } elseif (isset($start_at) && isset($end_at) && isset($type)) {
            $many_invoices = Invoice::whereBetween('invoice_Date', [$start_at, $end_at])
                ->where('Status', '=', $type)
                ->get();
        }




        return view('invoices.show_reports', compact('many_invoices'));

        // return $invoices;
    }


    // ___________________________________________________ تقارير العملاء
    public function show_customer_reports()
    {
        $products = Product::all();
        $sections = Section::all();
        return view('invoices.customer_reports', compact('products', 'sections'));
    }
    public function ajaxFunc($id)
    {
        //  key  ,   value   in ajax function in the pluck

        $selectedAjax = DB::table('products')->where('section_id', $id)->pluck('product_name', 'id');
        return json_encode($selectedAjax);

        //$selectedAjax ==>will be transportedt to ajax script as (data) parameter in the function

    }
    public function customer_search(Request $request)
    {
        $products = Product::all();
        $sections = Section::all();


        $start_at = date($request->start_at);
        $end_at = date($request->end_at);

        $product_id = $request->product;
        $section_id = $request->section;
        
        if ($start_at == null && $end_at == null) {

            $invoices = Invoice::where('section_id', $section_id)->where('product_id', $product_id)->get();
            return view('invoices.customer_reports', compact('invoices', 'products', 'sections'));

        } else {

            $invoices = Invoice::whereBetween('invoice_Date', [$start_at, $end_at])
                ->where('product_id', $product_id)
                ->where('section_id', $section_id)
                ->get();
            return view('invoices.customer_reports', compact('invoices', 'products', 'sections'));
        }

        // return $request;
    }


}
