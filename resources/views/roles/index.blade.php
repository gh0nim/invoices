@extends('layouts.app')
@section('content')
@section('title')
    عــرض المستخدمين
@endsection

<div class="container-scroller">

    @include('temp.side_navbar')
    <div class="container-fluid page-body-wrapper">
        @include('temp.head_navbar')
        <div class="main-panel">

            <div class="row">
                <div class="col-md-11 grid-margin m-auto py-5 ">
                    <h4 class="card-title"> المستخدمون</h4>

                    <div class="card">

                        <div class="card-body">
                            <a class="btn btn-primary" href={{ route('roles.create') }}>
                                اضافــة صلاحية جديده
                            </a>




                            <div class="table-responsive">
                                <table id="example1" class="table key-buttons text-md-nowrap"
                                    data-page-length='50'style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th class="wd-10p border-bottom-0">#</th>
                                            <th class="wd-15p border-bottom-0">اسم المستخدم</th>
                                            <th class="wd-15p border-bottom-0">العمليات </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    {{-- @can('عرض صلاحية') --}}
                                                    <a class="btn btn-primary" 
                                                    href="{{ route('roles.show', $role->id) }}"
                                                    >
                                                        عرض</a>
                                                    {{-- @endcan --}}

                                                    {{-- @can('تعديل صلاحية') --}}
                                                    <a class="btn btn-warning"
                                                     href="{{ route('roles.edit', $role->id) }}"
                                                     >
                                                        تعديل
                                                    </a>


                                                    {{-- شكل تانى لل form --}}
                                                    {{-- ------------------------ --}}


                                                    {{-- @endcan --}}

                                                    {{-- @if ($role->name !== 'owner') --}}
                                                    {{-- @can('حذف صلاحية') --}}
                                                    {{-- {!! Form::open(['method' => 'DELETE', 'route' => [
                                                    'role_destroy'=> $role->id
                                                ], 
                                                'style' => 'display:inline']) !!}
                                                {!! Form::submit('حذف', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!} --}}
                                                    {{-- @endcan --}}
                                                    {{-- @endif --}}


                                                    <div>
                                                        <form action="{{ route('roles.destroy', $role->id) }}"
                                                            enctype="multipart/form-data" method="post">
                                                            @method('DELETE') {{-- -------> because the controller is resource --}}
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">حذف</button>
                                                        </form>
                                                    </div>


                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="modal" id="modalToAdd">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">اضافة مستخدم</h6><button aria-label="Close"
                                                    class="close" data-dismiss="modal" type="button"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('add_products') }}" method="post">
                                                    {{ csrf_field() }}

                                                    <div class="form-group  ">
                                                        <label for="exampleInputEmail1">اسم المستخدم</label>
                                                        <input type="text" class="form-control" id="product_name"
                                                            name="product_name">
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="exampleInputEmail1">اسم القسم التابع له</label>
                                                        {{-- <select name="section_id" id="section_id">
                                                            @foreach ($sections as $section)
                                                                <option value="{{ $section->id }}">
                                                                    {{ $section->section_name }}</option>
                                                            @endforeach
                                                        </select> --}}

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








                            @endsection
