<li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
    <a href="{!! route('dashboard.index') !!}"><i class="fa fa-dashboard"></i> <span>Dashboard</span>  </a>
</li>

<li class="{{ Request::is('agents*') ? 'active' : '' }}">
    <a href="{!! route('agents.index') !!}"><i class="fa fa-fw fa-user-secret"></i><span>Agents</span></a>
</li>

<li class="{{ Request::is('treasuries*') ? 'active' : '' }}">
    <a href="{!! route('treasuries.index') !!}"><i class="fa fa-fw fa-university"></i><span>Treasuries</span></a>
</li>

<li class="{{ Request::is('districts*') ? 'active' : '' }}">
    <a href="{!! route('districts.index') !!}"><i class="fa fa-fw fa-map-o"></i><span>Districts</span></a>
</li>

<li class="{{ Request::is('payments*') ? 'active' : '' }}">
    <a href="{!! route('payments.index') !!}"><i class="ion ion-cash"></i><span>Payments</span></a>
</li>

<li class="{{ Request::is('members*') ? 'active' : '' }}">
    <a href="{{ url('/test') }}"><i class="fa fa-edit"></i><span>Members</span></a>
</li>

<li>
    <a href="{{ url('/bar') }}"><i class="fa fa-fw fa-bar-chart"></i><span>Charts</span></a>
</li>

<li>
    <a href="{{ url('/tra') }}"><i class="fa fa-fw fa-bar-chart"></i><span>Charts2</span></a>
</li>


