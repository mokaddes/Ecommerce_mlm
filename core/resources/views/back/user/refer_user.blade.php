@extends('master.back')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
<script>new ClipboardJS('.btn');</script>
<style>
.copyboard {
border: none;
background: #0d6efd;
color: #fff;
max-width: 109px;
padding: 4px 7px;
border-radius: 4px;
display: inline-block;
vertical-align: middle;
outline: none !important;
box-shadow: none !important;
cursor: initial;
}
.copyboard_btn {
padding: 4px 16px;
text-transform: uppercase;
}
.refer_table .accordion-button{
    padding: 0;
    display: contents;
}

.refer_table .accordion-button {
    padding: 0;
    display: contents;
}
.refer_table .accordion-button::after {
    display: list-item;
    margin-top: 11px;
    list-style: none;
    margin-right: auto;
}
.refer_table .accordion-button:not(.collapsed) {
    color: #FF6A00;
    background-color: #FF6A00 !important;
}

.refer_table .refer_user_list td:last-child {
    border: none;
}
.table>tbody {
    vertical-align: inherit;
    border: 1px solid #EEE;
}
.table-bordered>:not(caption)>* {
    border-width: 1px 0;
    border: 1px solid #EEE;
}
</style>
<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class=" mb-0  pl-3"><b>{{ __('Customers Refer User') }}</b> </h3>
                <a class="btn btn-primary btn-sm" href="{{route('back.user.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                </div>
        </div>
    </div>

	<!-- Form -->
    <div class="container padding-bottom-3x mb-1">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="btn btn-primary" style="float: right">
                            <span>Referal ID:
                                <input class="copyboard" id="referalId" readonly value="{{$user->own_referal}}">
                            </span>
                            <button class="copyboard_btn btn" data-clipboard-target="#referalId">Copy</button>
                        </div>
                        <div class="btn btn-primary">
                            <span>Refer User</span>
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
                                                @if ($user->own_referal)
                                                    @foreach($referal as $k => $data)
                                                        <tr class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#flush-collapseOne_{{$k}}" aria-expanded="false" aria-controls="flush-collapseOne_{{$k}}">
                                                            <td>{{$k+1}}</td>
                                                            <td>
                                                                {{ $data->first_name }} {{ $data->last_name }}
                                                            </td>
                                                            <td>
                                                                {{ $data->email }}
                                                            </td>
                                                            <td>
                                                                {{ $data->phone }}
                                                            </td>
                                                            <td>
                                                                {{ $data->own_referal }}
                                                            </td>
                                                            <td>
                                                                {{ $data->points }}
                                                            </td>
                                                            <td>
                                                                    <span><i class="fas fa-eye"></i></span>
                                                            </td>
                                                        </tr>

                                                        @php
                                                            $refers = DB::table('users')->whereNotNull('referal_id')->where('referal_id', $data->own_referal)->get();
                                                        @endphp

                                                        <tr>
                                                            @foreach ($refers as $l => $item)
                                                                <tr id="flush-collapseOne_{{$k}}" class="accordion-collapse refer_user_list collapse" aria-labelledby="flush-headingOne" data-parent="#accordionFlushExample">
                                                                    <td>
                                                                        <input type="checkbox" name="" id="" checked readonly>
                                                                    </td>
                                                                    <td>
                                                                        {{ $item->first_name }} {{ $item->last_name }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $item->email }}
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

</div>

@endsection
