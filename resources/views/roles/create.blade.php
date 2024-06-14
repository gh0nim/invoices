@extends('layouts.app')
@section('content')
@section('title')
    اضافة صلاحيه جديد
@endsection
<div class="container-scroller">

    @include('temp.side_navbar')
    <div class="container-fluid page-body-wrapper">
        @include('temp.head_navbar')

        <div class="main-panel">

            <div class="row">
                <div class="col-md-11 grid-margin m-auto py-5 ">
                    <h4 class="card-title">
                        اضافة صلاحيه جديد

                    </h4>

                    <div class="card">


                        <div class="card-body">
                            <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data"
                                autocomplete="off">
                                {{ csrf_field() }}



                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label"> اسم الصلاحيه</label>
                                        <input type="text" class="form-control" id="role_name" name="role_name"
                                            required>
                                        {{-- {!! Form::text('name', null, ['class' => 'form-control']) !!} --}}
                                    </div>





                                </div>


                                <div class="row">
                                    <div class="col">

                                        <ol>

                                            @foreach ($permission as $value)
                                                <li>

                                                    <label style="font-size: 16px;">
                                                        {{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                                                        {{ $value->name }}</label>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>




                                </div>
                                <br>
                                <br>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary"> اضافة صلاحيه</button>
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
