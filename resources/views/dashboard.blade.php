@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection


@section('content')


    <!-- Main content -->
    <div class="container-fluid">


        @if (isset($recommendated_kothas))
            <div class="content">
                <div class="row text">
                    <h3>Recommendated For You</h3>
                </div>
                <div class="content1">
                    @foreach ($recommendated_kothas as $recommendated_kotha)
                        <x-kotha-card :data="$recommendated_kotha" />
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Kothas</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="content">
            <div class="content1">
                @foreach ($kothas as $kotha)
                    <x-kotha-card :data="$kotha" />
                @endforeach
            </div>

        </div>


        <!-- /.row -->
    </div><!-- /.container-fluid -->
    <!-- /.content -->
@endsection
