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
                            <a class="btn btn-primary" href="{{ route('users.create') }}">
                                اضافــة مستخدم
                            </a>




                            <div class="table-responsive">
                                <table id="example1" class="table key-buttons text-md-nowrap"
                                    data-page-length='50'style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th class="wd-10p border-bottom-0">#</th>
                                            <th class="wd-15p border-bottom-0">اسم المستخدم</th>
                                            <th class="wd-20p border-bottom-0">البريد الالكتروني</th>
                                            <th class="wd-15p border-bottom-0">حالة المستخدم</th>
                                            <th class="wd-15p border-bottom-0">نوع المستخدم</th>
                                            <th class="wd-10p border-bottom-0">العمليات</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($data as $key => $user)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>

                                                @if ($user->Status == 'مفعل')
                                                    <td>
                                                        <span class="label text-success d-flex">
                                                            <div class="dot-label bg-success ml-1"></div>
                                                            {{ $user->Status }}
                                                        </span>
                                                    </td>
                                                @else
                                                    <td>
                                                        <span class="label text-danger d-flex">
                                                            <div class="dot-label bg-danger ml-1"></div>
                                                            {{ $user->Status }}
                                                        </span>
                                                    </td>
                                                @endif

                                                @if (!empty($user->getRoleNames()))
                                                <td>

                                                    {{-- <label class="badge badge-success">{{ $user->roles_name }}</label> --}}

                                                </td>
                                                @endif

                                                <td>
                                                    {{-- @can('تعديل مستخدم') --}}
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn btn-warning" title=""><i
                                                            class="las la-pen"></i>
                                                        تعديل
                                                    </a>
                                                    {{-- @endcan --}}

                                                    {{-- @can('حذف مستخدم') --}}
                                                    <a class="modal-effect btn btn-danger" data-effect="effect-scale"
                                                        data-user_id="{{ $user->id }}"
                                                        data-username="{{ $user->name }}" data-toggle="modal"
                                                        href="#modalToDelete" title=""><i
                                                            class="las la-trash"></i>
                                                        حذف
                                                    </a>
                                                    {{-- @endcan --}}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>


                            </div>



                            <div class="modal" id="modalToDelete">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">هل انت متأكد من حذف مستخدم</h6><button
                                                aria-label="Close" class="close" data-dismiss="modal"
                                                type="button"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                                {{ csrf_field() }}
                                                @method('DELETE')

                                                <input id="user_id" name="user_id" type="text"
                                                    value="{{ $user->id }}">


                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">تاكيد</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">اغلاق</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Basic modal -->


                            </div>




                            <script>
                                $(document).ready(function() {
                                    $('#modalToDelete').on("show.bs.modal", function(event) {
                                        var button = $(event.relatedTarget)

                                        var user_id = button.data('user_id')

                                        var modal = $(this)
                                        modal.find('.modal-body #user_id').val(user_id)


                                    })
                                });
                            </script>


                        @endsection
