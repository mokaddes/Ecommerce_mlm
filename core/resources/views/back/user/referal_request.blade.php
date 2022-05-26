
@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class=" mb-0 "><b>{{ __('Referal Requests') }}</b></h3>
                </div>
        </div>
    </div>

	<!-- DataTales -->
	<div class="card shadow mb-4">
		<div class="card-body">
			@include('alerts.alerts')
			<div class="gd-responsive-table">
				<table class="table table-bordered table-striped" id="admin-table" width="100%" cellspacing="0">

					<thead>
						<tr>
							<th>{{ __('Name') }}</th>
							<th>{{ __('Email') }}</th>
							<th>{{ __('Phone') }}</th>
                            <th>{{ __('Referal') }}</th>
							<th>{{ __('Actions') }}</th>
						</tr>
					</thead>

					<tbody>

                        @foreach($datas as $data)
                        <tr>
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
                                @if (!empty($data->referal_id))
                                    {{$data->referal_id}}
                                @elseif(empty($data->referal_id) && !empty($data->referal_email))
                                <a class="btn btn-danger btn-sm "
                                    href="{{ route('back.user.send_referal',$data->id) }}">
                                    Send Id
                                </a>
                                @else
                                {{$data->referal_email}}
                                @endif
                            </td>

                            <td>
                                <div class="action-list">
                                    <a class="btn btn-secondary btn-sm "
                                        href="{{ route('back.user.show',$data->id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm " data-toggle="modal"
                                        data-target="#confirm-delete" href="javascript:;"
                                        data-href="{{ route('back.user.destroy',$data->id) }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
					</tbody>

				</table>
			</div>
		</div>
	</div>

</div>

</div>
<!-- End of Main Content -->


{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

		<!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('Confirm Delete?') }}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
		</div>

		<!-- Modal Body -->
        <div class="modal-body">
			{{ __('You are going to delete this Admin. All contents related with this admin will be lost.') }} {{ __('Do you want to delete it?') }}
		</div>

		<!-- Modal footer -->
        <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
			<form action="" class="d-inline btn-ok" method="POST">

                @csrf

                @method('DELETE')

                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>

			</form>
		</div>

      </div>
    </div>
  </div>

{{-- DELETE MODAL ENDS --}}

@endsection
