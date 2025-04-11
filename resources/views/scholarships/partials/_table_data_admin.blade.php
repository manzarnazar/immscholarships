<!-- resources/views/scholarships/_table_data.blade.php -->
@foreach ($scholarshipList as $item)
    <tr>
        <td><span class="badge bg-success">{{ strtoupper($item->application_id) }}</span></td>
        <td>
            @php
                $user = \App\Models\User::where('id', $item->student_id)->first();
                echo $user ? strtoupper($user->name) : 'Not Found';
            @endphp
        </td>
        <td>
            @php
                $user = \App\Models\User::where('id', $item->student_id)->first();
                echo $user ? $user->email : 'Not Found';
            @endphp
        </td>
        <td>
            @if($item->status == 'approved')
                <span class="badge bg-success">{{ strtoupper($item->status) }}</span>
            @elseif($item->status == 'pending')
                <span class="badge bg-warning">{{ strtoupper($item->status) }}</span>
            @elseif($item->status == 'rejected')
                <span class="badge bg-danger">{{ strtoupper($item->status) }}</span>
            @else
                <span class="badge bg-danger">No Status Available</span>
            @endif
        </td>
        <td>{{ $item->created_at->format('F j, Y \a\t g:i A') }}</td>
        <td>
            <a href="{{ route('scholar-application-view', ['id' => $item->id]) }}" class="btn btn-primary text-white">
                <i class="fa fa-eye"></i> View
            </a>
        </td>
    </tr>
@endforeach
