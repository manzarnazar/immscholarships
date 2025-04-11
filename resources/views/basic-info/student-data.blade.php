@foreach ($students as $item)
<tr class="intro-x">
    <td class="w-40">
        <div class="flex">
            <div class="w-10 h-10 image-fit zoom-in">
                <img alt="{{ $item->first_name.' '.$item->last_name }}" class="tooltip rounded-full" src="{{ asset($item->image_path) ?? asset('default.jpg') }}" title="{{ $item->first_name.' '.$item->last_name }}">
            </div>
        </div>
    </td>
    <td>
        <a href="" class="font-medium whitespace-nowrap">{{ $item->first_name }}</a>
        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{ $item->last_name }}</div>
    </td>
    <td class="text-center">@php $country = \App\Models\Countries::find($item->country_origin);
        echo $country ? strtoupper($country->name) : 'Not Found' @endphp</td>
    <td class="w-40">
        <div class="flex items-center justify-center ">
            <i data-feather="check-square" class="w-4 h-4 mr-2"></i> {{ $item->highest_education }}
        </div>
    </td>
    <td class="table-report__action w-56">
        <div class="flex justify-center items-center">
            <a href="{{ route('basic-info-show',$item->id) }}" class="flex items-center mr-3" href="javascript:;">
                <i data-feather="check-square" class="w-4 h-4 mr-1"></i><button class="btn btn-success"> Edit Details</button>
            </a>
            {{-- <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
            </a> --}}
        </div>
    </td>
</tr>
@endforeach
