@extends('layouts.app')
@section('content')
@section('title')
    اضافة مستخدم جديد
@endsection
<div class="container-scroller">

    @include('temp.side_navbar')
    <div class="container-fluid page-body-wrapper">
        @include('temp.head_navbar')

        <div class="main-panel">

            <div class="row">
                <div class="col-md-11 grid-margin m-auto py-5 ">
                    <h4 class="card-title">
                        اضافة مستخدم جديد

                    </h4>

                    <div class="card">


                        <div class="card-body">
                            <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data"
                                autocomplete="off">
                                {{ csrf_field() }}
                            

                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label"> اسم المستخدم</label>
                                        <input type="text" class="form-control" id="user_name" name="user_name"
                                            required>
                                    </div>

                                    <div class="col">
                                        <label>البريد الالكترونى </label>
                                        <input class="form-control fc-datepicker" name="email" type="email">
                                    </div>


                                    <div class="col">
                                        <label>كلمة السر </label>
                                        <input class="form-control fc-datepicker" name="password" type="password">
                                    </div>

                                </div>

                         
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">الصلاحية</label>
                                        {{-- <select name="role" class="form-control SlectBox">
                                            <!--placeholder-->
                                            <option value="user" selected>user</option>
                                            <option value="owner" selected>owner</option>
                                            <option value="supervisor" selected>supervisor</option>
                                            <option value="admin"> admin</option>

                                        </select> --}}
                                        {!! Form::select('roles_name[]', $roles,[], array('class' => 'form-control','multiple')) !!}

                                    </div>



                                    <div class="col">
                                        <label for="inputName" class="control-label">حالة المستخدم</label>
                                        <select id="status" name="status" class="form-control">
                                           <option value="مفعل">مفعل </option>
                                           <option value="غير مفعل">غير مفعل </option>

                                        </select>
                                        
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary"> اضافة</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>





@endsection
