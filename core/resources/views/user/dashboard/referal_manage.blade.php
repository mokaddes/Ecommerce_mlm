@extends('master.front')
@section('title')
Referals
@endsection
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
<script>new ClipboardJS('.btn');</script>
<style>
    .copyboard{border:none;background:#0d6efd;color:#fff;max-width:109px;padding:4px 7px;border-radius:4px;display:inline-block;vertical-align:middle;outline:0!important;box-shadow:none!important;cursor:initial}
    .copyboard_btn{padding:4px 16px;text-transform:uppercase}
    .refer_table .accordion-button{padding:0;display:contents}
    .refer_table .accordion-button{padding:0;display:contents}
    .refer_table .accordion-button::after{display:list-item;margin-top:11px;list-style:none;margin-right:auto}
    .refer_table .accordion-button:not(.collapsed){color:#ff6a00;background-color:#ff6a00!important}
    .refer_table .refer_user_list td:last-child{border:none}
    .table>tbody{vertical-align:inherit;border:1px solid #eee}
    .table-bordered>:not(caption)>*{border-width:1px 0;border:1px solid #eee}
    .referarea.btn.btn-primary:hover::before{width:0px !important}
</style>
<!-- Page Title-->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumbs">
                    <li><a href="{{route('front.index')}}">{{__('Home')}}</a> </li>
                    <li class="separator"></li>
                    <li>{{__('Referal Manage')}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page Content-->
<div class="container padding-bottom-3x mb-1">
    <div class="row">
        @include('includes.user_sitebar')
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body referarea">
                    <div class="btn btn-primary" style="float: right">
                        <span>Referal ID:
                            <input class="copyboard" id="referalId" readonly value="{{Auth::user()->own_referal}}">
                        </span>
                        <button class="copyboard_btn btn" data-clipboard-target="#referalId">Copy</button>
                    </div>
                    <div class="btn btn-primary">
                        <span>Refer Genealogy</span>
                    </div>
                </div>
                <div class="card-body refer_table">
                    <div class="u-table-res">
                        <table class="table responsive table-bordered" id="admin-table">
                            <thead>
                                <tr>
                                    <th>{{ __('No') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Phone') }}</th>
                                    <th>{{ __('Own Referal') }}</th>
                                    <th>{{ __('Points') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <div class="accordion-header" id="flush-headingOne">
                                            @if (isset(Auth::user()->own_referal))
                                                @foreach($users as $k => $data)
                                                    <tr >
                                                        <td>{{$k+1}}</td>
                                                        <td>
                                                            {{ $data->first_name }} {{ $data->last_name }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('user.order.index') }}?user={{ $data->id }}">{{ $data->email }}</a>
                                                        </td>
                                                        <td>
                                                            {{ $data->phone }}
                                                        </td>
                                                        <td>
                                                            {{ $data->own_referal }}
                                                        </td>
                                                        <td>
                                                            {{ $data->points ?? 0 }}
                                                        </td>

                                                        <td>
                                                            <button type="button" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne_{{$k}}" aria-expanded="false" aria-controls="flush-collapseOne_{{$k}}" title="Show All"></button>
                                                        </td>
                                                    </tr>

                                                    @php
                                                        $refers = DB::table('users')->whereNotNull('referal_id')->where('referal_id', $data->own_referal)->get();
                                                    @endphp

                                                    <tr>
                                                        @foreach ($refers as $l => $item)
                                                            <tr id="flush-collapseOne_{{$k}}" class="accordion-collapse refer_user_list collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                                <td>
                                                                    <input type="checkbox" name="" id="" checked readonly>
                                                                </td>
                                                                <td>
                                                                    {{ $item->first_name }} {{ $item->last_name }}
                                                                </td>
                                                                <td>

                                                                    <a href="{{ route('user.order.index') }}?user={{ $item->id }}">{{ $item->email }}</a>
                                                                </td>
                                                                <td>
                                                                    {{ $item->phone }}
                                                                </td>
                                                                <td>
                                                                    {{ $item->own_referal }}
                                                                </td>
                                                                <td>
                                                                    {{ $item->points }}
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection