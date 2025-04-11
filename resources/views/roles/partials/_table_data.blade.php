@foreach ($roles as $item)
                    <tr>
                        <td>{{ strtoupper($item->name) }}</td>
                        <td>{{ $item->created_at->format('F j, Y \a\t g:i A') }}</td>
                        <td class="text-center">
                            {{-- <a href="{{ route('admin-roles-view', ['id' => $item->id]) }}" class="btn btn-primary text-white">
                                <i class="fa fa-eye"></i> View
                            </a> --}}
                            <button class="btn btn-danger text-white" onclick="deleteRole({{ $item->id }})">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
