@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                   @lang('models/chartofaccounts.plural')
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('chartofaccounts.create') }}">
                         @lang('crud.add_new')
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                <div class="sidebar">
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            @foreach ($accounts as $item)
                            {{-- <li class="nav-item {{($isinvoicesActive||$isinvoiceproduct||$isinvoicescreate)?'menu-open':''}} "> --}}
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-shield-virus"></i>
                                        <p>
                                            {{$item->name}}
                                            <i class="fas fa-angle-left right"></i>
                                            {{$item->journal->getCurrentBalanceInDollars()}}
                                        </p>
                                    </a>
                                    @if($item->has_child)
                                        @foreach($item->children as $d)
                                            <ul class="nav nav-treeview" style="margin-left: 50px;">
                                                <li class="nav-item">
                                                    <a href="{{ route('invoices.index') }}" class="nav-link">
                                                        <i class="nav-icon fas fa-shield-virus"></i>
                                                        <p>{{$d->name}}{{$d->journal->getCurrentBalanceInDollars()}}</p>
                                                    </a>

                                                </li>
                                                @if($d->has_child)
                                                @foreach($d->children as $i)
                                                        <li class="nav-item" style="margin-left: 50px;">
                                                            <a href="{{ route('invoices.index') }}" class="nav-link">
                                                                <i class="nav-icon fas fa-shield-virus"></i>
                                                                <p>{{$i->name}}{{$i->journal->getCurrentBalanceInDollars()}}</p>
                                                            </a>
                                                        </li>
                                                @endforeach
                                            @endif
                                            </ul>
                                        @endforeach
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
               <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>BALANCE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->name}}</td>
                        </tr>
                    @endforeach
                </tbody>
               </table>

                <div class="card-footer clearfix float-right">
                    <div class="float-right">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


