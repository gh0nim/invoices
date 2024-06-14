@extends('layouts.app')
@section('content')
@section('title')
    عــرض الاقســـام
@endsection

<div class="container-scroller">

    @include('temp.side_navbar')
    <div class="container-fluid page-body-wrapper">
        @include('temp.head_navbar')

        <div class="main-panel">

            <div class="row">
                <div class="col-md-11 grid-margin m-auto py-5 ">
                    <h4 class="card-title"> الاقسام</h4>

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
                            @elseif (session()->has('update_section'))
                            <div class="badge badge-success">
                                <h2>
                                    {{ session()->get('update_section') }}
                                </h2>
                            </div>

                            @elseif (session()->has('delete_section'))
                            <div class="badge badge-success">
                                <h2>
                                    {{ session()->get('delete_section') }}
                                </h2>
                            </div>



                        @endif
                        <div class="card-body">
                            <a data-effect="effect-scale" data-toggle="modal" class="modal-effect btn btn-primary"
                                href="#modalToAdd">اضافــة قســـم</a>




                            <div class="table-responsive">
                                <table id="example1" class="table key-buttons text-md-nowrap"
                                    data-page-length='50'style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">#</th>
                                            <th class="border-bottom-0">اسم القسم</th>
                                            <th class="border-bottom-0">الوصف</th>
                                            <th class="border-bottom-0"> مضاف بواسطه</th>
                                            <th class="border-bottom-0"> العمليــات</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($sections as $section)
                                            @php
                                                $i++;
                                            @endphp


                                            <tr>
                                                <td>{{ $i }} </td>
                                                <td>{{ $section->section_name }} </td>
                                                <td>{{ $section->description }} </td>
                                                <td>{{ $section->created_by }} </td>
                                                <td><a class=" btn btn-success" href="">عرض</a>
                                                    <a data-toggle="modal" data-effect="effect-modal"
                                                        class="modal-effect btn btn-danger" href="#modalToDelete"
                                                        data-section_id="{{ $section->id }}"
                                                        data-section_name="{{ $section->section_name }}"
                                                        data-description="{{ $section->description }}">
                                                        حذف</a>
                                                    <a data-section_id="{{ $section->id }}"
                                                        data-section_name="{{ $section->section_name }}"
                                                        data-description="{{ $section->description }}"
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
                                                <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close"
                                                    class="close" data-dismiss="modal" type="button"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('add_sections') }}" method="post">
                                                    {{ csrf_field() }}

                                                    <div
                                                        class="form-group       @error('section_name') is-invalid @enderror   ">
                                                        <label for="exampleInputEmail1">اسم القسم</label>
                                                        <input type="text" class="form-control" id="section_name"
                                                            name="section_name">
                                                    </div>
                                                    {{-- @error('section_name')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror --}}

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
{{----------------------------------------------------------- delete modal----------------------------------------------------------------------------- --}}
                                <div class="modal" id="modalToDelete">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title"> هل انت متأكد من حذف القسم</h6><button
                                                    aria-label="Close" class="close" data-dismiss="modal"
                                                    type="button"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('delete_section') }}" method="post">
                                                    {{ csrf_field() }}



                                                    <input  name="section_id" id="section_id" type="hidden">

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

                                <div class="modal" id="modalToEdit" tabindex="-1">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">تعديل قسم</h6><button aria-label="Close"
                                                    class="close" data-dismiss="modal" type="button"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('edit_sections')}}" method="post">
                                                    {{ csrf_field() }}

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">اسم القسم</label>
                                                        <input type="text" class="form-control" id="section_name"
                                                            value="" name="section_name">
                                                    </div>
                                                    <input  name="section_id" id="section_id" type="hidden">
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
            var section_id = button.data('section_id')
            var section_name = button.data('section_name')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #section_id').val(section_id)
            modal.find('.modal-body #section_name').val(section_name)
            modal.find('.modal-body #description').val(description)


        })
    });
    $(document).ready(function() {
        $('#modalToDelete').on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget)
            var section_id = button.data('section_id')
            var section_name = button.data('section_name')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #section_id').val(section_id)
            modal.find('.modal-body #section_name').val(section_name)
            modal.find('.modal-body #description').val(description)


        })
    });
</script>






@endsection
