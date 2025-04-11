
        @forelse ($degree as $data)
            <tr>
                <td>{{ $data->start_date }}</td>
                <td>{{ $data->end_date }}</td>
                <td>{{ $data->institution_name }}</td>
                <td>
                    @php
                        $country = \App\Models\Countries::find($data->country);
                        echo $country ? strtoupper($country->name) : 'Not Found';
                    @endphp
                </td>
                <td>{{ $data->major_subject }}</td>
                <td>{{ $data->award }}</td>
                <td>{{ $data->study_in_china ?? 'Null' }}</td>
                <td>
                    <a class="btn btn-info" href="{{ asset($data->image_path) }}">
                        <i class="fa fa-download"></i> Download
                    </a>
                </td>
                <td>
                    <div class="flex justify-center items-center">
                        <a href="{{ route('master-education-show', $data->id) }}" class="btn btn-primary mr-2">View</a>
                        {{-- <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal" class="btn btn-danger">Delete</a> --}}
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center text-danger">No Information available</td>
            </tr>
        @endforelse
