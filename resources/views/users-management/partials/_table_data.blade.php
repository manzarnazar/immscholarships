@foreach ($staff as $item)
                    <tr>
                        <td>{{ strtoupper($item->name) }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <span class="badge bg-info">{{ strtoupper($item->user_type) }}</span>
                        </td>
                        <td>{{ $item->created_at->format('F j, Y \a\t g:i A') }}</td>
                        <td class="text-center">
                            {{-- <a href="{{ route('admin-users-management-view', ['id' => $item->id]) }}" class="btn btn-primary text-white">
                                <i class="fa fa-eye"></i> View
                            </a> --}}
                            <button class="btn btn-danger text-white" onclick="deleteStaff({{ $item->id }})">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
