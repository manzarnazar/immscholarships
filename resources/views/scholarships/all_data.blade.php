@foreach ($scholarships as $scholarship)
    <tr class="intro-x">
        <td>{{ strtoupper($scholarship->title) }}</td>
         <td> <?php $institution = \App\Models\Institutions::where('id', $scholarship->institution_id)->first(); 
                 $country = \App\Models\Countries::where('id', $institution->country)->first();
         ?>
                                            {{$country ? $country->name : ""}}
                                            </td>
          <td>{{ strtoupper($institution->city) }}</td>
        <td>
            <span class="badge bg-success">
                @php
                    $institution = \App\Models\Institutions::find($scholarship->institution_id);
                    echo $institution ? strtoupper($institution->code) : 'Not Found';
                @endphp
            </span>
        </td>
        <td>{{ strtoupper($scholarship->teaching_language) }}</td>
        <td>
            <span class="badge bg-info">
                {{ strtoupper($scholarship->status) }}
            </span>
        </td>
        <!-- <td>{{ $scholarship->created_at->format('F j, Y \a\t g:i A') }}</td> -->
        <td class="table-report__action w-56">
            <div class="flex justify-center items-center">
                <a href="{{ route('scholarship-view', ['id' => $scholarship->id]) }}" class="flex items-center mr-3 btn btn-success text-white">
                    View
                </a>
            </div>
        </td>
    </tr>
@endforeach
