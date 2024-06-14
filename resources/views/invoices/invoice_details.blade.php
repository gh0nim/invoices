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
                    <h4 class="card-title">عــــرض تفاصيل الفواتير</h4>

                    <div class="card">



                        <form enctype="multipart/form-data"
                            action="{{ route('add_new_attachment', [
                                'invoice_id' => $invoice->id,
                                'invoice_number' => $invoice->invoice_number,
                            ]) }}"
                            method="post">
                            @csrf
                            <input type="file" class="dropify" name="file_name">

                            <button class="btn btn-success">
                                اضافة مرفق جديد
                            </button>
                        </form>



                        <div class="card-body">

                            <div class="text-wrap">
                                <div class="example">
                                    <div class="panel panel-primary tabs-style-2">
                                        <div class=" tab-menu-heading">
                                            <div class="tabs-menu1">
                                                <!-- Tabs -->
                                                <ul class="nav panel-tabs main-nav-line">
                                                    <li><a href="#attachments" class="nav-link active"
                                                            data-toggle="tab">المرفقــات</a></li>
                                                    <li><a href="#payStatus" class="nav-link" data-toggle="tab">حالات
                                                            الدفع</a></li>
                                                    <li><a href="#info" class="nav-link" data-toggle="tab">معلومات عن
                                                            الفاتورة</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-body tabs-menu-body main-content-body-right border">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="attachments">
                                                    <table id="example1" class="table key-buttons text-md-nowrap"
                                                        data-page-length='50'style="text-align: center">
                                                        <thead>
                                                            <tr>
                                                                <th class="border-bottom-0">رقم الفاتورة
                                                                </th>
                                                                <th class="border-bottom-0">تاريخ
                                                                    القاتورة</th>
                                                                <th class="border-bottom-0">المرفق</th>
                                                                <th class="border-bottom-0">العمليات</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($invoice_attachments as $invoice_attachments)
                                                                <tr>

                                                                    <td>{{ $invoice_attachments->invoice_number }} </td>
                                                                    <td>{{ $invoice_attachments->created_at }}</td>




                                                                    <td>{{ $invoice_attachments->file_name }}</td>
                                                                    <td>
                                                                        <form enctype="multipart/form-data"
                                                                            action="{{ route('show_attachment', [
                                                                                'invoice_number' => $invoice_attachments->invoice_number,
                                                                                'file_name' => $invoice_attachments->file_name,
                                                                            ]) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            <button class="btn btn-success">
                                                                                عرض
                                                                            </button>
                                                                        </form>


                                                                        <form enctype="multipart/form-data"
                                                                            action="{{ route('download_attachment', [
                                                                                'invoice_number' => $invoice_attachments->invoice_number,
                                                                                'file_name' => $invoice_attachments->file_name,
                                                                            ]) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            <button class="btn btn-primary">
                                                                                تحميل
                                                                            </button>
                                                                        </form>



                                                                        <form enctype="multipart/form-data"
                                                                            action=" {{ route('delete_attachment', [
                                                                                'attachment_id' => $invoice_attachments->id,
                                                                                'invoice_id' => $invoice->id,
                                                                                'invoice_number' => $invoice_attachments->invoice_number,
                                                                                'file_name' => $invoice_attachments->file_name,
                                                                            ]) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            <button class="btn btn-danger">
                                                                                حذف
                                                                            </button>
                                                                        </form>



                                                                    </td>





                                                                </tr>
                                                            @endforeach


                                                        </tbody>
                                                    </table>





                                                </div>
                                                <div class="tab-pane" id="payStatus">
                                                    <table id="example1" class="table key-buttons text-md-nowrap"
                                                        data-page-length='50'style="text-align: center">
                                                        <thead>
                                                            <tr>
                                                                <th class="border-bottom-0">رقم الفاتورة
                                                                </th>
                                                                <th class="border-bottom-0">تاريخ
                                                                    القاتورة</th>
                                                                {{-- <th class="border-bottom-0">تاريخ
                                                                    السداد</th> --}}

                                                                <th class="border-bottom-0">حالة الدفع
                                                                </th>


                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach ($invoice_details as $invoice_details)
                                                                <tr>

                                                                    <td>{{ $invoice_details->invoice_number }} </td>
                                                                    <td>{{ $invoice_details->created_at }}</td>
                                                                    {{-- <td>{{ $invoice_details->invoices->Due_date }}</td> --}}


                                                                    @if ($invoice_details->Value_Status == 1)
                                                                        <td class="badge badge-success"> مدفوعه</td>
                                                                    @elseif ($invoice_details->Value_Status == 0)
                                                                        <td class="badge badge-danger"> غير مدفوعه</td>
                                                                    @elseif ($invoice_details->Value_Status ==2)
                                                                        <td class="badge badge-warning"> مدفوعه جزئيا
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach


                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div class="tab-pane" id="info">
                                                    <table id="example1" class="table key-buttons text-md-nowrap"
                                                        data-page-length='50'style="text-align: center">
                                                        <thead>
                                                            <tr>
                                                                <th class="border-bottom-0">رقم الفاتورة
                                                                </th>

                                                                <th class="border-bottom-0">تابع لقسم

                                                                </th>
                                                                <th class="border-bottom-0">الاجمالي
                                                                </th>
                                                                <th class="border-bottom-0">الحالة</th>
                                                                <th class="border-bottom-0">ملاحظات</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            {{-- 
                                                                <tr>
                                                               
                                                                    <td>{{ $invoice->invoice_number }} </td>
                                                                  
                                                                 
                                                                    <td>
                                                                        <a style="color: rgb(66, 66, 236)" href="">
                                                                            {{ $invoice->sections->section_name }}
                                                                        </a>
                    
                                                                    </td>
                                                                
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
                                                            @endforeach --}}

                                                        </tbody>
                                                    </table>






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
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function getFile_name(params) {
            let file_name = document.getElementById('file_name').files;

        }
    })
</script>

@endsection
