@foreach ($scholarships as $item)
                    <tr>
                        <td>{{ strtoupper($item->title) }}</td>
                        <td>
                            @php
                                $institution = \App\Models\Institutions::find($item->institution_id);
                                echo $institution ? strtoupper($institution->name) : 'Not Found';
                            @endphp
                        </td>
                        <td>
                            @if (!empty($item->image_path))
                                <!-- Display the course image -->
                                <img src="{{ asset($item->image_path) }}" class="img-fluid" width="80px" height="60px">
                              

                            @else
                                <!-- Display a default image when the course image is not loaded or not found -->
                                <img src="{{ asset('images/default-course.jpg') }}" class="img-fluid" width="80px" height="60px">
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-info">
                                {{ strtoupper($item->status) }}
                            </span>
                        </td>
                        <!-- <td>{{ $item->created_at->format('F j, Y \a\t g:i A') }}</td> -->
                        <td class="text-center">
                            <a href="{{ route('scholarship-view', ['id' => $item->id]) }}" class="btn btn-dark text-white">
                                <i class="fa fa-eye"></i> View
                            </a></td>
                             <td >
                             
                             <a href="{{ route('scholarship-Edit', ['id' => $item->id]) }}" class="btn btn-primary text-white pt-3">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                        </td>
                             <td >
                            <form action="{{ route('scholarships-delete', $item->id) }}" method="POST" class="d-inline-block" id="delete-form-{{ $item->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger text-white delete-button" data-id="{{ $item->id }}">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
