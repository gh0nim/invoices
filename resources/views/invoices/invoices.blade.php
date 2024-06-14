@extends('layouts.app')
@section('content')
@section('title')
    عــرض الفواتير
@endsection

<div class="container-scroller">

    @include('temp.side_navbar')
    <div class="container-fluid page-body-wrapper">
        @include('temp.head_navbar')

        <div class="main-panel">

            <div class="row">
                <div class="col-md-11 grid-margin m-auto py-5 ">
                    <h4 class="card-title">عــــرض الفواتير</h4>

                    <div class="card">
                        @if (session()->has('success'))
                            <div class="badge badge-success">
                                <h2>
                                    {{ session()->get('success') }}
                                </h2>
                            </div>
                        @endif
                        @if (session()->has('delete_invoice'))
                            <div class="badge badge-success">
                                <h2>
                                    {{ session()->get('delete_invoice') }}
                                </h2>
                            </div>
                        @endif

                        @if (session()->has('deleted_attachment'))
                            <div class="badge badge-success">
                                <h2>
                                    {{ session()->get('deleted_attachment') }}
                                </h2>
                            </div>
                        @endif
                        @if (session()->has('no_attachment'))
                            <div class="badge badge-success">
                                <h2>
                                    {{ session()->get('no_attachment') }}
                                </h2>
                            </div>
                        @endif
                        @if (session()->has('add_new_attachment'))
                            <div class="badge badge-success">
                                <h2>
                                    {{ session()->get('add_new_attachment') }}
                                </h2>
                            </div>
                        @endif
                        @if (session()->has('empty_attachment'))
                            <div class="badge badge-success">
                                <h2>
                                    {{ session()->get('empty_attachment') }}
                                </h2>
                            </div>
                            @endif @if (session()->has('edit_success'))
                                <div class="badge badge-success">
                                    <h2>
                                        {{ session()->get('edit_success') }}
                                    </h2>
                                </div>
                            @endif






                            <div class="card-body">
                                <a class="btn btn-success" href="{{ route('add_invoice') }}">انشاء فاتورة</a>
                                <a class="btn btn-info" href="{{ route('invoice_export') }}">انشاء اكسيل</a>
                                <div class="table-responsive pb-5">
                                    <table id="example1" class="table key-buttons text-md-nowrap"
                                        data-page-length='50'style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">رقم الفاتورة</th>
                                                <th class="border-bottom-0">تاريخ القاتورة</th>
                                                <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                                <th class="border-bottom-0">المنتج التابع له</th>
                                                <th class="border-bottom-0">تابع لقسم</th>
                                                <th class="border-bottom-0">الخصم</th>
                                                <th class="border-bottom-0">نسبة الضريبة</th>
                                                <th class="border-bottom-0">قيمة الضريبة</th>
                                                <th class="border-bottom-0">الاجمالي</th>
                                                <th class="border-bottom-0">الحالة</th>
                                                <th class="border-bottom-0">ملاحظات</th>
                                                <th class="border-bottom-0">العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($invoices as $invoice)
                                                @php
                                                    $i++;
                                                @endphp
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $invoice->invoice_number }} </td>
                                                    <td>{{ $invoice->invoice_Date }}</td>
                                                    <td>{{ $invoice->Due_date }}</td>
                                                    <td>
                                                        {{ $invoice->products->product_name }}
                                                    </td>
                                                    <td>
                                                        <form
                                                            action="{{ route('detail_invoice', [
                                                                'invoice_id' => $invoice->id,
                                                            ]) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf

                                                            <input value="{{ $invoice->sections->section_name }}"
                                                                type="submit" style="color: rgb(66, 66, 236)">

                                                        </form>


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
                                                    <td>
                                                        <div class="dropdown">
                                                            <button aria-expanded="false" aria-haspopup="true"
                                                                class="btn ripple btn-primary btn-sm"
                                                                data-toggle="dropdown" type="button">العمليات<i
                                                                    class="fas fa-caret-down ml-1"></i></button>
                                                            <div class="dropdown-menu tx-13">

                                                                <form
                                                                    action="{{ route('edit_invoice', [
                                                                        'invoice_id' => $invoice->id,
                                                                    ]) }} "
                                                                    method="post">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        style="background-color: rgb(162, 162, 1)"
                                                                        class="btn btn-warning dropdown-item"> تعديل
                                                                        الفاتورة

                                                                    </button>
                                                                </form>



                                                                <a style="background-color: rgb(171, 7, 7)"
                                                                    class="dropdown-item"
                                                                    data-invoice_id="{{ $invoice->id }}"
                                                                    data-toggle="modal" data-target="#modalToDelete">
                                                                    <i
                                                                        class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;
                                                                    حذف الفاتورة</a>


                                                                <a style="background-color:rgb(4, 4, 135)"
                                                                    class="dropdown-item"
                                                                    data-invoice_id="{{ $invoice->id }}"
                                                                    data-Value_Status="{{ $invoice->Value_Status }}"
                                                                    data-toggle="modal"
                                                                    data-target="#modalToEditValueStatus">
                                                                    <i
                                                                        class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;
                                                                    تغيير حالة الدفع </a>


                                                                <form
                                                                    action="{{ route('To_archieve', [
                                                                        'invoice_id' => $invoice->id,
                                                                        'invoice_number' => $invoice->invoice_number,
                                                                    ]) }}"
                                                                    method="post">
                                                                    @csrf

                                                                    <button type="submit" class="btn btn-info">نقل الى
                                                                        الارشيف

                                                                    </button>
                                                                </form>
                                                                <form
                                                                    action="{{ route('print_invoice', [
                                                                        'invoice_id' => $invoice->id,
                                                                    ]) }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @csrf

                                                                    <button style="background-color: green"
                                                                        class="dropdown-item">
                                                                        طباعة الفاتورة
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <div class="modal" id="modalToDelete">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title"> هل انت متأكد من حذف القسم</h6><button
                                                        aria-label="Close" class="close" data-dismiss="modal"
                                                        type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('delete_invoice') }}" method="post">
                                                        {{ csrf_field() }}



                                                        <input type="text" name="invoice_id" id="invoice_id">

                                                        <div class="modal-footer">
                                                            <button type="submit"
                                                                class="btn btn-danger">تاكيدالحذف</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">اغلاق</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Basic modal -->


                                    </div>



                                    {{-- -------------------------------------- modal of modalToEditValueStatus---------------------- --}}




                                    <div class="modal" id="modalToEditValueStatus">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title"> تغيير حالة الدفع</h6><button
                                                        aria-label="Close" class="close" data-dismiss="modal"
                                                        type="button"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('change_value_status') }}" method="post">
                                                        {{ csrf_field() }}



                                                        <input type="hidden" id="invoice_id" name="invoice_id">
                                                        <div>
                                                            <input type="hidden" name="Value_Status"
                                                                id="Value_Status">
                                                        </div>


                                                        <div class="modal-footer">
                                                            <button type="submit"
                                                                class="btn btn-warning">تغيير</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">اغلاق</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Basic modal -->


                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@if (session()->has('edit_done'))
    {
    <script>
        window.onload = function() {
            notif({
                msg: 'تم تعديل الفاتورة بنجاح',
                type: 'success'
            })
        }
    </script>

    }
@elseif (session()->has('archieved'))
    {
    <script>
        window.onload = function() {
            notif({
                msg: 'تم ارشفة الفاتورة بنجاح',
                type: 'success'
            })
        }
    </script>

    }
@elseif (session()->has('archieve_stored'))
    {
    <script>
        window.onload = function() {
            notif({
                msg: 'تم استعادة الفاتورة بنجاح',
                type: 'success'
            })
        }
    </script>

    }
@endif


<script>
    $(document).ready(function() {
        $('#modalToDelete').on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget)

            var invoice_id = button.data('invoice_id')

            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id)


        })
    });
    $(document).ready(function() {
        $('#modalToEditValueStatus').on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget)

            var invoice_id = button.data('invoice_id')
            var Value_Status = button.data('Value_Status')

            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id)
            modal.find('.modal-body #Value_Status').val(Value_Status)


        })
    });
</script>
@endsection
