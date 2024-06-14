@extends('layouts.app')
@section('content')
@section('title')
    عــرض الفواتيرالمؤرشفه
@endsection

<div class="container-scroller">

    @include('temp.side_navbar')
    <div class="container-fluid page-body-wrapper">
        @include('temp.head_navbar')

        <div class="main-panel">

            <div class="row">
                <div class="col-md-11 grid-margin m-auto py-5 ">
                    <h4 class="card-title"> عــــرض الفواتيرالمؤرشفه</h4>

                    <div class="card">







                        <div class="card-body">
                            {{-- <p>الفواتير المؤرشفة</p> --}}
                            <div class="table-responsive pb-5">
                                <table id="example1" class="table key-buttons text-md-nowrap"
                                    data-page-length='50'style="text-align: center">
                                    <thead>
                                        <tr>

                                            <th class="border-bottom-0">رقم الفاتورة</th>

                                            <th class="border-bottom-0">العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoice as $invoice)
                                            <tr>

                                                <td>{{ $invoice->invoice_number }} </td>



                                                <div class="dropdown">
                                                    <button aria-expanded="false" aria-haspopup="true"
                                                        class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                        type="button">العمليات<i
                                                            class="fas fa-caret-down ml-1"></i></button>
                                                    <div class="dropdown-menu tx-13">





                                                        <a style="background-color: rgb(171, 7, 7)"
                                                            class="dropdown-item" data-invoice_id="{{ $invoice->id }}"
                                                            data-toggle="modal" data-target="#modalToDelete">
                                                            <i class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;
                                                            حذف الفاتورة</a>




                                                        <form
                                                            action="{{ route('From_archieve', [
                                                                'invoice_id' => $invoice->id,
                                                            ]) }}"
                                                            method="post">
                                                            @csrf

                                                            <button type="submit" class="btn btn-info">استعادة من
                                                                الارشيف

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
                                                <h6 class="modal-title"> هل انت متأكد من حذف الفاتورة</h6><button
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


<script>
    $(document).ready(function() {
        $('#modalToDelete').on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget)

            var invoice_id = button.data('invoice_id')

            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id)


        })
    });
</script>
@endsection
