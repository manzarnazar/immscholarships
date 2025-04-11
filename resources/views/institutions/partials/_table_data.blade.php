@foreach ($institutions as $item)
<tr>
    <td><span class="badge ">{{ strtoupper($item->name) }}</span></td>
    <td><span class="badge ">{{ strtoupper($item->code) }}</span></td>
    <?php

    $countries = \App\Models\Countries::pluck('name', 'id');
?>
<td>{{ strtoupper($countries->get($item->country)) }}</td>

    <td>{{ strtoupper($item->city) }}</td>
    <td>{{ strtoupper($item->province) }}</td>
    <!-- <td>{{ $item->created_at->format('F j, Y \a\t g:i A') }}</td> -->
    <td class="text-center">
        <a href="{{ route('admin-institutions-view', ['id' => $item->id]) }}" class="btn btn-primary text-white">
            <i class="fa fa-eye"></i> View
        </a>

        <a href="{{ route('admin-institutions-edit', $item->id) }}" class="btn btn-success text-white">
            <i class="fa fa-edit"></i> Edit
        </a>

        <form action="{{ route('institutions-delete', $item->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger text-white" onclick="return confirm('Are you sure you want to delete this institution?')">
                <i class="fa fa-trash"></i> Delete
            </button>
        </form>
    </td>
</tr>
@endforeach
