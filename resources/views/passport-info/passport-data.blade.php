@foreach ($passports as $passport)

<tr class="intro-x">
    <td class="w-40">
        <div class="flex">
            <div class="w-10 h-10 image-fit zoom-in">
                <img alt="{{ $passport->first_name.' '.$passport->last_name }}" class="tooltip rounded-full" src="{{ asset($passport->image_path) ?? asset('default.jpg') }}" title="{{ $passport->first_name.' '.$passport->last_name }}">
            </div>
        </div>
    </td>
    <td>
        <a href="" class="font-medium whitespace-nowrap">{{ $passport->last_name }}</a>
    </td>
    <td>
        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{ $passport->first_name }}</div>
    </td>

    <td class="text-center">{{ $passport->passport_number }}</td>
    <td class="text-center">{{ $passport->issued_date }}</td>
    <td class="text-center">{{ $passport->expiry_date }}</td>
    <td class="table-report__action w-56">
        <div class="flex justify-center items-center">
            <a href="{{ route('passport-info-show', $passport->id) }}" class="flex items-center mr-3" href="javascript:;">
                <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Details
            </a>
            {{-- <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
            </a> --}}
        </div>
    </td>
</tr>
@endforeach
