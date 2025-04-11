@foreach ($students as $item)
<tr>
    <td>{{ strtoupper($item->name) }}</td>
    <td>{{ $item->email }}</td>
    <td>
    <a href="https://wa.me/{{ $item->whatsappNumber }}" target="_blank">
        {{ $item->whatsappNumber }}
    </a>
</td>

      <td>{{ $item->country_origin }}</td>
       <td>{{ $item->education_level }}</td>
    <!-- <td>{{ $item->created_at->format('F j, Y \a\t g:i A') }}</td> -->
    <td class="text-center">
        {{-- <a href="{{ route('student-view', ['id' => $item->id]) }}" class="btn btn-primary text-white">
            <i class="fa fa-eye"></i> View
        </a> --}}
     
        <button class="btn btn-danger text-white delete-button" data-id="{{ $item->id }}">
            <i class="fa fa-trash"></i> Delete
        </button>
           <form action="{{ route('admin-students-delete', $item->id) }}" method="POST" class="d-inline-block" id="delete-form-{{ $item->id }}">
                 @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $item->id }}">
             </form>
    </td>
</tr>
@endforeach
