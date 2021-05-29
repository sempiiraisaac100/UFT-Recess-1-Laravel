@extends('layouts.app')
@auth
    @section('content')
        <section class="content-header">
            <h1 class="pull-left">Dashboard</h1>
            <h1 class="pull-right">

            </h1>
        </section>

        <div class="content">

            <div class="clearfix"></div>

            @include('flash::message')

            <div class="clearfix"></div>
            <div class="box box-primary">
                <div class="box-body">
                        <div class="row">
                                <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                    <h3>{{$amount}}</h3>

<<<<<<< HEAD
                                    <p>Finance</p>
=======
                                    <p>TREASURY</p>
                                    </div>
                                    <div class="icon">
                                    <i class="fa fa-fw fa-university"></i>
                                    </div>
                                    <a href={{url('/treasuries')}} class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-green">
                                    <div class="inner">
                                    <h3>{{$salaries}}<sup style="font-size: 20px">%</sup></h3>

                                    <p>SALARIES</p>
>>>>>>> 236792f5ad063b3b68d60be9f843ae454ec0c4cd
                                    </div>
                                    <div class="icon">
                                    <i class="ion ion-cash"></i>
                                    </div>
<<<<<<< HEAD
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
=======
                                    <a href="{{url('/payments')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
>>>>>>> 236792f5ad063b3b68d60be9f843ae454ec0c4cd
                                </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
<<<<<<< HEAD
                                <div class="small-box bg-green">
                                    <div class="inner">
                                    <h3>53<sup style="font-size: 20px">%</sup></h3>

                                    <p>Bounce Rate</p>
                                    </div>
                                    <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                    <h3>44</h3>

                                    <p>User Registrations</p>
                                    </div>
                                    <div class="icon">
                                    <i class="ion ion-person-add"></i>
=======
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                    <h3>{{$members}}</h3>

                                    <p>Members</p>
                                    </div>
                                    <div class="icon">
                                    <i class="fa fa-fw fa-users"></i>
                                    </div>
                                    <a href="{{url('members')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-red">
                                    <div class="inner">
                                    <h3>{{$agents}}</h3>
                                    <p>AGENTS</p>
                                    </div>
                                    <div class="icon">
                                    <i class="fa fa-fw fa-user-secret"></i>
                                    </div>
                                    <a href="{{url('/agents')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                                </div>
                                <!-- ./col -->
                            </div>
                 <!-- NEW ROW -->
                            <div class="row">
                                <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-purple">
                                    <div class="inner">
                                    <h3>{{$district}}</h3>

                                    <p>DISTRICTS</p>
                                    </div>
                                    <div class="icon">
                                    <i class="fa fa-fw fa-map-o"></i>
                                    </div>
                                    <a href="{{ url('/districts')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-maroon">
                                    <div class="inner">
                                    <h3>STAT</h3></h3>

                                    <p>UFT</p>
                                    </div>
                                    <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="{{url('/bar')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-gray">
                                    <div class="inner">
                                    <h3>44</h3>

                                    <p>User Registrations</p>
                                    </div>
                                    <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-orange">
                                    <div class="inner">
                                    <h3>65</h3>

                                    <p>Unique Visitors</p>
                                    </div>
                                    <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
>>>>>>> 236792f5ad063b3b68d60be9f843ae454ec0c4cd
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                                </div>
                                <!-- ./col -->
<<<<<<< HEAD
                                <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-red">
                                    <div class="inner">
                                    <h3>65</h3>

                                    <p>Unique Visitors</p>
                                    </div>
                                    <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
=======
                            </div>

                    <!-- NEW ROW -->
                            <div class="row">
                                <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-green">
                                    <div class="inner">
                                    <h3>{{$amount}}</h3>

                                    <p>Finance</p>
                                    </div>
                                    <div class="icon">
                                    <i class="ion ion-cash"></i>
>>>>>>> 236792f5ad063b3b68d60be9f843ae454ec0c4cd
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                                </div>
                                <!-- ./col -->
<<<<<<< HEAD
=======
                                <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-red">
                                    <div class="inner">
                                    <h3>53<sup style="font-size: 20px">%</sup></h3>

                                    <p>Bounce Rate</p>
                                    </div>
                                    <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                    <h3>44</h3>

                                    <p>User Registrations</p>
                                    </div>
                                    <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-olive">
                                    <div class="inner">
                                    <h3>65</h3>

                                    <p>Unique Visitors</p>
                                    </div>
                                    <div class="icon">
                                    <i class="fa fa-fw fa-user-secret"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                                </div>
                                <!-- ./col -->
>>>>>>> 236792f5ad063b3b68d60be9f843ae454ec0c4cd
                            </div>
                </div>
            </div>
            <div class="text-center">

            </div>
        </div>
    @endsection
@endauth
