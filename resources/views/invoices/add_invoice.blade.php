@extends('layouts.app')
@section('content')
@section('title')
    انشاء فاتورة
@endsection
<div class="container-scroller">

    @include('temp.side_navbar')
    <div class="container-fluid page-body-wrapper">
        @include('temp.head_navbar')

        <div class="main-panel">

            <div class="row">
                <div class="col-md-11 grid-margin m-auto py-5 ">
                    <h4 class="card-title"> انشـــــــــــــاء فاتورة</h4>

                    <div class="card">


                        <div class="card-body">
                            <form action="{{ route('store_invoice') }}" method="post" enctype="multipart/form-data"
                                autocomplete="off">
                                {{ csrf_field() }}
                                {{-- 1 --}}

                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">رقم الفاتورة</label>
                                        <input type="text" class="form-control" id="invoice_number"
                                            name="invoice_number" title="يرجي ادخال رقم الفاتورة" required>
                                    </div>

                                    <div class="col">
                                        <label>تاريخ الفاتورة</label>
                                        <input class="form-control fc-datepicker" name="invoice_Date"
                                            placeholder="YYYY-MM-DD" type="text" value="{{ date('Y-m-d') }}">
                                    </div>


                                    <div class="col">
                                        <label>تاريخ الاستحقاق</label>
                                        <input class="form-control fc-datepicker" name="Due_date"
                                            placeholder="YYYY-MM-DD" type="text">
                                    </div>

                                </div>

                                {{-- 2 --}}
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">القسم</label>
                                        <select name="section" class="form-control SlectBox"
                                            onclick="console.log($(this).val())"
                                            onchange="console.log('change is firing')">
                                            <!--placeholder-->
                                            <option value="" selected disabled>حدد القسم</option>
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}"> {{ $section->section_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>


                                  

                  


                                    <div class="col">
                                        <label for="inputName" class="control-label">المنتج</label>
                                        <select id="product" name="product" class="form-control">
                                            {{-- @foreach ($products as $product)
                                                <option>
                                                     {{ $product->product_name }}   فضيناه عشان هيتملى بال js
                                                </option>
                                            @endforeach --}}
                                        </select>
                                    </div>

                                    <div class="col">
                                        <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                        <input type="text" class="form-control" id="Amount_collection"
                                            name="Amount_collection"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    </div>
                                </div>


                                {{-- 3 --}}

                                <div class="row">

                                    <div class="col">
                                        <label for="inputName" class="control-label">مبلغ العمولة</label>
                                        <input type="text" class="form-control form-control-lg"
                                            id="Amount_Commission" name="Amount_Commission"
                                            title="يرجي ادخال مبلغ العمولة "
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            required>
                                    </div>

                                    <div class="col">
                                        <label for="inputName" class="control-label">الخصم</label>
                                        <input type="text" class="form-control form-control-lg" id="Discount"
                                            name="Discount" title="يرجي ادخال مبلغ الخصم "
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            value=0 required>
                                    </div>

                                    <div class="col">
                                        <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                        <select name="Rate_VAT" id="Rate_VAT" class="form-control"
                                            onchange="Mathfunc()">
                                            <!--placeholder-->
                                            <option value="" selected disabled>حدد نسبة الضريبة</option>
                                            <option value=" 5%">5%</option>
                                            <option value="10%">10%</option>
                                        </select>
                                    </div>

                                </div>

                                {{-- 4 --}}

                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                        <input type="text" class="form-control" id="Value_VAT" name="Value_VAT"
                                            readonly>
                                    </div>

                                    <div class="col">
                                        <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                        <input type="text" class="form-control" id="Total" name="Total"
                                            readonly>
                                    </div>
                                </div>

                                {{-- 5 --}}
                                <div class="row">
                                    <div class="col">
                                        <label for="exampleTextarea">ملاحظات</label>
                                        <textarea class="form-control" id="exampleTextarea" name="note" rows="3"></textarea>
                                    </div>
                                </div><br>

                                <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                <h5 class="card-title">المرفقات</h5>

                                <div class="col-sm-12 col-md-12">
                                    <input type="file" name="pic" class="dropify"
                                        accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                                </div><br>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                                </div>


                            </form>




                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
<script>
    $(document).ready(function() {

        $('select[name="section"]').on('change', function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: "{{ URL::to('ajaxFunc') }}/" + id,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        $('select[name="product"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="product"]').append('<option value="' +
                                key + '">' + value + '</option>');
                        });

                    }
                })
            } else {
                console.log('ajax not working')

            }

        })
    });
</script>
<script>
    function Mathfunc() {

        var Amount_collection = parseFloat(document.getElementById("Amount_collection").value);
        var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
        var Discount = parseFloat(document.getElementById("Discount").value);
        var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);



        var multi = Amount_Commission * Rate_VAT;
        var multi2 = Amount_Commission * Rate_VAT;
        var Value_VAT = Amount_collection + multi;
        var Total = Amount_collection + multi2 - Discount;


        hehia = parseFloat(Value_VAT).toFixed(2);
        zag = parseFloat(Total).toFixed(2);

        document.getElementById("Value_VAT").value = hehia
        document.getElementById("Total").value = zag


    }
</script>






@endsection
