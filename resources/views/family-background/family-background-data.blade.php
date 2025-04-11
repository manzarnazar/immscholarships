@forelse ($familyBackgrounds as $data)
    <tr class="intro-x">
        <td>
            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{ strtoupper($data->name) }}</div>
        </td>
        <td class="text-left">{{ $data->relationship }}</td>
        <td class="text-left">{{ $data->profession }}</td>
        <td class="text-left">{{ $data->work_institution }}</td>
        <td class="text-left">{{ $data->country }}</td>
        <td class="text-left">{{ $data->mobile }}</td>
        <td>
            <div class="flex justify-center items-center">
                <a href="{{ route('family-background-show', $data->id) }}" class="flex items-center mr-3">
                    <i data-feather="check-square" class="w-4 h-4 mr-1"></i> <button class="btn btn-success">Edit Details</button>
                </a>
                {{-- <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                    <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
                </a> --}}
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="9" class="text-center text-danger">No Information available</td>
    </tr>
@endforelse
