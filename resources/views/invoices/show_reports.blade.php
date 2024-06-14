@extends('layouts.app')
@section('content')
@section('title')
    عــرض التقارير
@endsection

<div class="container-scroller">

    @include('temp.side_navbar')
    <div class="container-fluid page-body-wrapper">
        @include('temp.head_navbar')

        <div class="main-panel">

            <div class="row">
                <div class="col-md-11 grid-margin m-auto py-5 ">
                    <h4 class="card-title"> عــــرض التقارير</h4>

                    <div class="card">

                        <div class="card-body">
                            <div class="card-header pb-0">
                                <div class="col-lg-3">
                                    <label class="radiobox">
                                        <input name="radio1" type="radio" value="1" id="type_search_box">
                                        <span>بحث بنوع
                                            الفاتورة</span></label>
                                </div>


                                <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                    <label class="radiobox"><input name="radio2" value="2" id="number_search_box"
                                            type="radio"><span>بحث برقم الفاتورة
                                        </span></label>
                                </div>
                                <br>
                                <br>
                                {{-- البحث برقم الفاتورة  --}}
                                <div id="number_search" name="number_search">
                                    <form action="{{ route('number_search') }}" method="POST" role="search"
                                        autocomplete="off">
                                        {{ csrf_field() }}

                                        <div class="row">
                                            <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="invoice_number">
                                                <p class="mg-b-10">البحث برقم الفاتورة</p>
                                                <input type="text" class="form-control" id="invoice_number"
                                                    name="invoice_number">

                                            </div>

                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-sm-1 col-md-1">
                                                <button type="submit" class="btn btn-primary btn-block">بحث</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                {{-- البحث بالتاريخ --}}
                                <div id="type_search" name="type_search">
                                    <form action="{{ route('type_search') }}" method="POST" role="search"
                                        autocomplete="off">
                                        {{ csrf_field() }}


                                        <div class="row">

                                            <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                                                <p class="mg-b-10">تحديد نوع الفواتير</p><select
                                                    class="form-control select2" name="type" required>
                                                    <option value="{{ $type ?? 'حدد نوع الفواتير' }}" selected>
                                                        {{ $type ?? 'حدد نوع الفواتير' }}
                                                    </option>

                                                    <option value="مدفوعه">الفواتير المدفوعة</option>
                                                    <option value="غير مدفوعه">الفواتير الغير مدفوعة</option>
                                                    <option value="مدفوعه جزئيا">الفواتير المدفوعة جزئيا</option>

                                                </select>
                                            </div><!-- col-4 -->



                                            <div class="col-lg-3" id="start_at">
                                                <label for="exampleFormControlSelect1">من تاريخ</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-calendar-alt"></i>
                                                        </div>
                                                    </div><input class="form-control fc-datepicker"
                                                        value="{{ $start_at ?? '' }}" name="start_at"
                                                        placeholder="YYYY-MM-DD" type="text">
                                                </div><!-- input-group -->
                                            </div>

                                            <div class="col-lg-3" id="end_at">
                                                <label for="exampleFormControlSelect1">الي تاريخ</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-calendar-alt"></i>
                                                        </div>
                                                    </div><input class="form-control fc-datepicker" name="end_at"
                                                        value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD"
                                                        type="text">
                                                </div><!-- input-group -->
                                            </div>
                                        </div><br>

                                        <div class="row">
                                            <div class="col-sm-1 col-md-1">
                                                <button class="btn btn-primary btn-block">بحث</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                {{-- جدول فى حالة البحث بالرقم --}}

                                <div class="table-responsive">
                                    @if (isset($invoice))
                                        <table id="example" class="table key-buttons text-md-nowrap"
                                            style=" text-align: center">
                                            <thead>
                                                <tr>
                                                    <th class="border-bottom-0">#</th>
                                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                                    <th class="border-bottom-0">تاريخ القاتورة</th>
                                                    <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                                    <th class="border-bottom-0">المنتج</th>
                                                    <th class="border-bottom-0">القسم</th>
                                                    <th class="border-bottom-0">الخصم</th>
                                                    <th class="border-bottom-0">نسبة الضريبة</th>
                                                    <th class="border-bottom-0">قيمة الضريبة</th>
                                                    <th class="border-bottom-0">الاجمالي</th>
                                                    <th class="border-bottom-0">الحالة</th>
                                                    <th class="border-bottom-0">ملاحظات</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 0; ?>
                                                {{-- @foreach ($invoices as $invoice) --}}
                                                <?php $i++; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $invoice->invoice_number }} </td>
                                                    <td>{{ $invoice->invoice_Date }}</td>
                                                    <td>{{ $invoice->Due_date }}</td>
                                                    <td>

                                                        {{ $invoice->products->product_name }}
                                                    </td>


                                                    <td><a href="">
                                                            {{ $invoice->sections->section_name }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $invoice->Discount }}</td>
                                                    <td>{{ $invoice->Rate_VAT }}</td>
                                                    <td>{{ $invoice->Value_VAT }}</td>
                                                    <td>{{ $invoice->Total }}</td>
                                                    <td>
                                                        @if ($invoice->Value_Status == 1)
                                                            <span class="text-success">{{ $invoice->Status }}</span>
                                                        @elseif($invoice->Value_Status == 0)
                                                            <span class="text-danger">{{ $invoice->Status }}</span>
                                                        @else
                                                            <span class="text-warning">{{ $invoice->Status }}</span>
                                                        @endif

                                                    </td>

                                                    <td>{{ $invoice->note }}</td>
                                                </tr>
                                                {{-- @endforeach --}}
                                            </tbody>
                                        </table>
                                    @endif

                                    {{-- جدول فى حالة البحث بالتاريخ --}}

                                    @if (isset($many_invoices))
                                        <table id="example" class="table key-buttons text-md-nowrap"
                                            style=" text-align: center">
                                            <thead>
                                                <tr>
                                                    <th class="border-bottom-0">#</th>
                                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                                    <th class="border-bottom-0">تاريخ القاتورة</th>
                                                    <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                                    <th class="border-bottom-0">المنتج</th>
                                                    <th class="border-bottom-0">القسم</th>
                                                    <th class="border-bottom-0">الخصم</th>
                                                    <th class="border-bottom-0">نسبة الضريبة</th>
                                                    <th class="border-bottom-0">قيمة الضريبة</th>
                                                    <th class="border-bottom-0">الاجمالي</th>
                                                    <th class="border-bottom-0">الحالة</th>
                                                    <th class="border-bottom-0">ملاحظات</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 0; ?>
                                                @foreach ($many_invoices as $invoice)
                                                    <?php $i++; ?>
                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td>{{ $invoice->invoice_number }} </td>
                                                        <td>{{ $invoice->invoice_Date }}</td>
                                                        <td>{{ $invoice->Due_date }}</td>
                                                        <td>

                                                            {{ $invoice->products->product_name }}
                                                        </td>


                                                        <td><a href="">
                                                                {{ $invoice->sections->section_name }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $invoice->Discount }}</td>
                                                        <td>{{ $invoice->Rate_VAT }}</td>
                                                        <td>{{ $invoice->Value_VAT }}</td>
                                                        <td>{{ $invoice->Total }}</td>
                                                        <td>
                                                            @if ($invoice->Value_Status == 1)
                                                                <span
                                                                    class="text-success">{{ $invoice->Status }}</span>
                                                            @elseif($invoice->Value_Status == 0)
                                                                <span
                                                                    class="text-danger">{{ $invoice->Status }}</span>
                                                            @else
                                                                <span
                                                                    class="text-warning">{{ $invoice->Status }}</span>
                                                            @endif

                                                        </td>

                                                        <td>{{ $invoice->note }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif






                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('#number_search').hide();
        // $('#example').hide();


        $('input[type ="radio"]').click(function() {

            if ($(this).attr("id") == "type_search_box") {

                $('#number_search').hide();
                $('#type_search').show();
                // $('#example').show();



            } else if ($(this).attr("id") == "number_search_box") {

                $('#type_search').hide();
                $('#number_search').show();
                // $('#example').show();





            }
        })
    })
</script>



@endsection
