@foreach ($chineseAbility as $data)
    <tr class="intro-x">
        <td>
            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{ strtoupper($data->chinese_level) }}</div>
        </td>
        <td class="text-left">{{ $data->hsk_score }}</td>
        <td class="text-left">{{ $data->hskk_grade }}</td>
        <td class="text-left">{{ $data->hssk_score }}</td>
        <td>
            <div class="flex justify-center items-center">
                <a href="{{ route('chinese-ability-show', $data->id) }}" class="flex items-center mr-3">
                    <i data-feather="check-square" class="w-4 h-4 mr-1"></i><button class="btn btn-success">Edit Details</button> 
                </a>
                {{-- <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                    <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
                </a> --}}
            </div>
        </td>
    </tr>
@endforeach
