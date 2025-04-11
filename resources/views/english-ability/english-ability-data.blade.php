@foreach ($englishAbility as $data)
    <tr class="intro-x">
        <td>
            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{ strtoupper($data->english_level) }}</div>
        </td>
        <td class="text-left">{{ $data->toefl }}</td>
        <td class="text-left">{{ $data->ielts }}</td>
        <td class="text-left">{{ $data->gre }}</td>
        <td class="text-left">{{ $data->gmat }}</td>
        <td class="text-left">{{ $data->other }}</td>
        <td> <div class="flex justify-center items-center">
            <a href="{{ route('english-ability-show', $data->id) }}" class="flex items-center mr-3" href="javascript:;">
                <i data-feather="check-square" class="w-4 h-4 mr-1"></i><button class="btn btn-success">Details</button> 
            </a>
            {{-- <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
            </a> --}}
        </div></td>
    </tr>
@endforeach
