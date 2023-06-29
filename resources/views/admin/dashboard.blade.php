@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$userCount}}</h3>
                            <p>Users</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$kothaCount}}</h3>
                            <p>Kothas</p>
                        </div>

                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$approvedKothaCount}}</h3>
                            <p>Approved Kothas</p>
                        </div>

                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$pendingKothaCount}}</h3>
                            <p>Pending Kothas</p>
                        </div>

                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$rejectedKothaCount}}</h3>
                            <p>Rejected Kothas</p>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
