@forelse ($contactInfoHome as $data)
    <tr class="intro-x">

        <td class="text-left">{{ $data->phone }}</td>
        <td class="text-left">{{ $data->telephone }}</td>
        <td class="text-left">{{ $data->email }}</td>
        <td class="text-left">{{ $data->physical_address }}</td>
        <td class="text-left">{{ $data->postcode }}</td>

        <td>
            <div class="flex justify-center items-center">
                <a href="{{ route('contact-info-home-show', $data->id) }}" class="flex items-center mr-3">
                    <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Details
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
