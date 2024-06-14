@extends('layouts.app')
@section('content')
@section('title')
    تعديل صلاحيه
@endsection
<div class="container-scroller">

    @include('temp.side_navbar')
    <div class="container-fluid page-body-wrapper">
        @include('temp.head_navbar')

        <div class="main-panel">

            <div class="row">
                <div class="col-md-11 grid-margin m-auto py-5 ">
                    <h4 class="card-title">
                        تعديل صلاحيه


                    </h4>

                    <div class="card">


                        <div class="card-body">
                            <form action="{{ route('roles.update', $role->id) }}" method="post"
                                enctype="multipart/form-data" autocomplete="off">
                                {{ csrf_field() }}
                                @method('PUT')


                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label"> تعديل الصلاحيه</label>
                                        <input type="text" class="form-control" id="role_name" name="role_name"
                                            value="{{ $role->name }}" required>
                                        {{-- {!! Form::text('name', null, ['class' => 'form-control']) !!} --}}
                                    </div>





                                </div>


                                <div class="row">
                                    <div class="col">

                                        <ol>

                                            @foreach ($permission as $value)
                                                <li>

                                                    <label style="font-size: 16px;">
                                                        {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, [
                                                            'class' => 'name',
                                                        ]) }}
                                                        {{ $value->name }}</label>
                                                </li>
                                            @endforeach
                                        </ol>


                                    </div>




                                </div>
                                <br>
                                <br>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success"> تعديل</button>
                                </div>

                            </form>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('roles.index') }}" class="btn btn-warning"> رجوع</a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>





@endsection
