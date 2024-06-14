@extends('layouts.app')
@section('content')
@section('title')
    عرض صلاحيه
@endsection
<div class="container-scroller">

    @include('temp.side_navbar')
    <div class="container-fluid page-body-wrapper">
        @include('temp.head_navbar')

        <div class="main-panel">

            <div class="row">
                <div class="col-md-11 grid-margin m-auto py-5 ">
                    <h4 class="card-title">
                        عرض صلاحيه

                    </h4>

                    <div class="card">
                        <input readonly type="text" value="{{ $role->name }}">

                        <div class="card-body">
                            <div class="row">
                                <div class="col">

                                    <ul>

                                        @foreach ($rolePermissions as $value)
                                            <li>
                                                {{ $value->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>




                            </div>
                        </div>
                    </div>
                    <div>
                    <a class="btn btn-primary" href="{{route('roles.index')}}">رجوع</a>

                    </div>
                </div>

            </div>

        </div>

    </div>
</div>





@endsection
