@extends('master.back')
@section('content')
    <div class="col-md-8 container-fluid">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <h5>Send Referal ID</h5>
                </div>
                <form action="{{ route('back.user.referal_submit')}}" class="d-inline btn-ok" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="col-lg-12 form-group">
                            <label for="transaction">Email</label>
                            <input type="email" class="form-control" name="referal_email" id="" value=" {{$user->referal_email}} " readonly>
                            @error('referal_email')
                                <p class="text-danger">{{$message}}</p>
                            @endif
                        </div>
                        <div class="col-lg-12 form-group">
                            <label for="transaction">Referal ID</label>
                            <input type="text" class="form-control" name="referal_id" id="" placeholder="Enter referal id" required>
                            @error('referal_id')
                                <p class="text-danger">{{$message}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-2 form-group" style="float: right">
                        <button class="btn btn-primary" type="submit">Send</button>
                    </div>
                </form>

              </div>
            </div>
        </div>
    </div>
@endsection