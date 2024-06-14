@extends('layouts.app')
@section('content')
@section('title')
    عــرض المنتـــجات
@endsection

<div class="container-scroller">

    @include('temp.side_navbar')
    <div class="container-fluid page-body-wrapper">
        @include('temp.head_navbar')
        <div class="main-panel">

            <div class="row">
                <div class="col-md-11 grid-margin m-auto py-5 ">
                    <h4 class="card-title"> المنتجــــــــــــــات</h4>

                    <div class="card">

                        @if (session()->has('fail'))
                            <div class="badge badge-danger">
                                <h2>
                                    {{ session()->get('fail') }}
                                </h2>
                            </div>
                        @elseif (session()->has('success'))
                            <div class="badge badge-success">
                                <h2>
                                    {{ session()->get('success') }}
                                </h2>
                            </div>
                        @elseif (session()->has('delete_product'))
                            <div class="badge badge-success">
                                <h2>
                                    {{ session()->get('delete_product') }}
                                </h2>
                            </div>
                        @elseif (session()->has('update_product'))
                            <div class="badge badge-success">
                                <h2>
                                    {{ session()->get('update_product') }}
                                </h2>
                            </div>
                        @endif
                        <div class="card-body">

                            
                            {{-- @can('اضافة منتج') --}}
                                <a data-effect="effect-scale" data-toggle="modal" class="modal-effect btn btn-primary"
                                    href="#modalToAdd">
                                    اضافــة منتج
                                </a>
                            {{-- @endcan --}}




                            <div class="table-responsive">
                                <table id="example1" class="table key-buttons text-md-nowrap"
                                    data-page-length='50'style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">#</th>
                                            <th class="border-bottom-0">اسم المنتج</th>
                                            <th class="border-bottom-0">اسم القسم التابع له</th>
                                            <th class="border-bottom-0">الوصف</th>
                                            <th class="border-bottom-0"> مضاف بواسطه</th>
                                            <th class="border-bottom-0"> العمليــات</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($products as $product)
                                            @php
                                                $i++;
                                            @endphp


                                            <tr>
                                                <td>{{ $i }} </td>
                                                <td>{{ $product->product_name }} </td>
                                                <td>{{ $product->sections->section_name }} </td>
                                                <td>{{ $product->description }} </td>
                                                <td>{{ $product->sections->created_by }} </td>
                                                <td>

                                                    <a data-product_id="{{ $product->id }}"
                                                        data-product_name="{{ $product->product_name }}"
                                                        data-description="{{ $product->description }}"
                                                        data-effect="modal-effect" data-toggle="modal"
                                                        class="modal-effect btn btn-danger" href="#modalToDelete">حذف
                                                    </a>
                                                    <a data-product_id="{{ $product->id }}"
                                                        data-product_name="{{ $product->product_name }}"
                                                        data-description="{{ $product->description }}"
                                                        data-effect="modal-effect" data-toggle="modal"
                                                        class="modal-effect btn btn-warning"
                                                        href="#modalToEdit">تعديل</a>


                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="modal" id="modalToAdd">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">اضافة منتج</h6><button aria-label="Close"
                                                    class="close" data-dismiss="modal" type="button"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('add_products') }}" method="post">
                                                    {{ csrf_field() }}

                                                    <div class="form-group  ">
                                                        <label for="exampleInputEmail1">اسم المنتج</label>
                                                        <input type="text" class="form-control" id="product_name"
                                                            name="product_name">
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="exampleInputEmail1">اسم القسم التابع له</label>
                                                        <select name="section_id" id="section_id">
                                                            @foreach ($sections as $section)
                                                                <option value="{{ $section->id }}">
                                                                    {{ $section->section_name }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>


                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">ملاحظات</label>
                                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                                    </div>



                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">تاكيد</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">اغلاق</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Basic modal -->


                                </div>

                                {{-- -------------------------------------------------- delete modal -------------------------------------- --}}
                                <div class="modal" id="modalToDelete"tabindex="-1">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title"> هل انت متأكد من حذف المنتج</h6>

                                                <button aria-label="Close" class="close" data-dismiss="modal"
                                                    type="button"><span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <form action="{{ route('delete_product') }}" method="post">
                                                    {{ csrf_field() }}

                                                    <input type="text" id="product_id" name="product_id">

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

                                {{-- -------------------------------------------------- edit modal -------------------------------------- --}}

                                <div class="modal" id="modalToEdit" tabindex="-1">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">تعديل منتج</h6><button aria-label="Close"
                                                    class="close" data-dismiss="modal" type="button"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('edit_products') }}" method="post">
                                                    {{ csrf_field() }}

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">اسم المنتج</label>
                                                        <input type="text" class="form-control" id="product_name"
                                                            value="" name="product_name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">اسم القسم التابع له</label>
                                                        <select name="section_id" id="section_id">
                                                            @foreach ($sections as $section)
                                                                <option value="{{ $section->id }}" selected>
                                                                    {{ $section->section_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>


                                                    {{-- عشان اخد قيمه id بتاع الصف  --}}
                                                    <input type="text" id="product_id" name="product_id">

                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">ملاحظات</label>

                                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit"
                                                            class="btn btn-warning">تعـــديل</button>
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


{{-- scripts for editing modal --}}
<script>
    $(document).ready(function() {
        $('#modalToEdit').on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget)
            var product_id = button.data('product_id')
            var product_name = button.data('product_name')
            var description = button.data('description')
            var section_id = button.data('section_id')
            var modal = $(this)
            modal.find('.modal-body #product_id').val(product_id)
            modal.find('.modal-body #product_name').val(product_name)
            modal.find('.modal-body #description').val(description)
            modal.find('.modal-body #section_id').val(section_id)


        })
    });
    // {{-- scripts for deleting modal --}}

    $(document).ready(function() {
        $('#modalToDelete').on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget)
            var product_id = button.data('product_id')
            var product_name = button.data('product_name')
            var description = button.data('description')
            var section_id = button.data('section_id')
            var modal = $(this)
            modal.find('.modal-body #product_id').val(product_id)
            modal.find('.modal-body #product_name').val(product_name)
            modal.find('.modal-body #description').val(description)
            modal.find('.modal-body #section_id').val(section_id)


        })
    });
</script>






@endsection
