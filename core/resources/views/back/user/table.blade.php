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
        {{ $data->own_referal }}
    </td>
    <td>
        {{ $data->referal_id }}
    </td>


    <td>
        {{-- @if ($data->status == 1)
            <div class="badge badge-primary">
                Active
            </div>
        @else
            <div class="badge badge-warning">
                Inactive
            </div>
        @endif --}}
        <div class="dropdown">
            <button class="btn btn-{{  $data->status == 1 ? 'success' : 'danger'  }} btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{  $data->status == 1 ? __('Enabled') : __('Disabled')  }}
            </button>
            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="{{ route('back.user.active',$data->id) }}">{{ __('Enable') }}</a>
              <a class="dropdown-item" href="{{ route('back.user.inactive',$data->id) }}">{{ __('Disable') }}</a>
            </div>
        </div>
    </td>
    <td>
        <a class="btn btn-secondary btn-sm "
                href="{{ route('back.user.refer',$data->id) }}">
                <i class="fas fa-eye"></i>
            </a>
    </td>

    <td>
        <div class="action-list">

            <a class="btn btn-secondary btn-sm "
                href="{{ route('back.user.show',$data->id) }}">
                <i class="fas fa-edit"></i>
            </a>
            <a class="btn btn-danger btn-sm " data-toggle="modal"
                data-target="#confirm-delete" href="javascript:;"
                data-href="{{ route('back.user.destroy',$data->id) }}">
                <i class="fas fa-trash-alt"></i>
            </a>
            {{-- @if ($data->status == 1)
                <a class="btn btn-secondary btn-sm "
                    href="{{ route('back.user.inactive',$data->id) }}">
                    <i class="fas fa-thumbs-up"></i>
                </a>
            @else
                <a class="btn btn-secondary btn-sm "
                    href="{{ route('back.user.active',$data->id) }}">
                    <i class="fas fa-thumbs-down"></i>
                </a>
            @endif --}}
        </div>
    </td>
</tr>
@endforeach
