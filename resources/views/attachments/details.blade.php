@extends('../layout/' . $layout)

@section('subhead')
    <title>{{ isset($attachment) ? 'Update' : 'Create' }} Attachments - IMS - Scholarship Portal</title>
@endsection

@section('subcontent')
<div class="intro-y mt-10">
    <h2 class="text-2xl font-bold mb-5 text-center text-green-900">
        {{ isset($attachment) ? 'Update' : 'Create' }} Attachments
    </h2>

    {{-- Download Templates Section at the top --}}
    <div class="mb-6 text-center">
        <p class="text-sm text-gray-600 mb-2">⬇️ Download required templates:</p>
        <div class="flex flex-wrap gap-3 justify-center">
            <a href="{{ route('download-medical-form') }}"
               class="bg-green-900 hover:bg-green-950 text-white px-4 py-2 rounded shadow transition transform hover:-translate-y-1">
                <i class="fa fa-download"></i> Medical Form
            </a>
            <a href="{{ route('download-Bachelor-form') }}"
               class="bg-green-900 hover:bg-green-950 text-white px-4 py-2 rounded shadow transition transform hover:-translate-y-1">
                <i class="fa fa-download"></i> Bachelor Study Plan
            </a>
            <a href="{{ route('download-Masters-form') }}"
               class="bg-green-900 hover:bg-green-950 text-white px-4 py-2 rounded shadow transition transform hover:-translate-y-1">
                <i class="fa fa-download"></i> Masters Study Plan
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($attachment) ? route('attachments-update', $attachment->id) : route('attachments-store') }}"
          method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-xl">
        @csrf
        @isset($attachment)
            @method('PUT')
        @endisset

        <div class="grid grid-cols-12 gap-6">
            {{-- Required Documents --}}
            <div class="col-span-12">
                <h3 class="text-xl font-semibold text-green-900 border-b pb-2 mb-6">
                    📌 Required Documents
                </h3>
            </div>

            @php
                $requiredFields = [
                    'study_plan' => 'Study Plan (PDF only)',
                    'bank_statement' => 'Bank Statement (PDF only)',
                    'recomendation_letter' => 'Recommendation Letter (PDF only)',
                    'police_clearance' => 'Police Clearance (PDF only)',
                    'cv' => 'Curriculum Vitae (CV) (PDF only)',
                    'medical_form' => 'Medical Examination Form (PDF only)',
                    'Highest_Transcript' => 'Highest Transcript Certificate (PDF only)'
                ];
            @endphp

            @foreach($requiredFields as $field => $label)
                <div class="col-span-12 md:col-span-6">
                    <label class="block mb-2 font-medium text-gray-800">
                        {{ $label }} <span class="text-red-500">*</span>
                    </label>
                    <div class="border-2 border-dashed border-gray-300 p-4 rounded-lg transition duration-300 hover:border-green-900 hover:shadow-lg">
                        <input type="file" name="{{ $field }}" accept="application/pdf"
                               class="w-full text-sm text-gray-700 file:border-0 file:bg-green-900 file:hover:bg-green-950 file:text-white file:px-4 file:py-2 cursor-pointer" />
                        <div class="mt-2 text-sm text-gray-600 file-feedback" data-field="{{ $field }}">
                            @if(isset($attachment->$field))
                                <a href="{{ asset($attachment->$field) }}" target="_blank" class="text-green-900 hover:underline">
                                    <i class="fa fa-eye"></i> View Existing {{ $label }}
                                </a>
                            @else
                                <span class="file-name">No file chosen.</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Optional Certificates --}}
            <div class="col-span-12 mt-8">
                <h3 class="text-xl font-semibold text-green-900 border-b pb-2 mb-6">
                    📁 Optional Certificates
                </h3>
            </div>

            @php
                $optionalFields = [
                    'Chinese_Certificate' => 'Chinese Language Certificate',
                    'English_Certificate' => 'English Language Certificate',
                    'Achievements_Certificate' => 'Achievements Certificate'
                ];
            @endphp

            @foreach($optionalFields as $field => $label)
                <div class="col-span-12 md:col-span-6">
                    <label class="block mb-2 font-medium text-gray-800">
                        {{ $label }} (PDF only)
                    </label>
                    <div class="border-2 border-dashed border-gray-300 p-4 rounded-lg transition duration-300 hover:border-green-900 hover:shadow-lg">
                        <input type="file" name="{{ $field }}" accept="application/pdf"
                               class="w-full text-sm text-gray-700 file:border-0 file:bg-green-900 file:hover:bg-green-950 file:text-white file:px-4 file:py-2 cursor-pointer" />
                        <div class="mt-2 text-sm text-gray-600 file-feedback" data-field="{{ $field }}">
                            @if(isset($attachment->$field))
                                <a href="{{ asset($attachment->$field) }}" target="_blank" class="text-green-900 hover:underline">
                                    <i class="fa fa-eye"></i> View Existing {{ $label }}
                                </a>
                            @else
                                <span class="file-name">No file chosen.</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Submit Button --}}
            <div class="col-span-12 mt-8 text-center">
                <button type="submit" class="bg-green-900 hover:bg-green-950 text-white font-bold py-3 px-8 rounded-lg shadow-xl transition transform hover:-translate-y-1">
                    💾 Save Attachments
                </button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Display selected file name in the container feedback
    document.querySelectorAll('input[type="file"]').forEach(function(input) {
        input.addEventListener('change', function() {
            const feedbackElement = this.parentElement.querySelector('.file-feedback');
            if (this.files && this.files.length > 0) {
                feedbackElement.innerHTML = '<span class="file-name">' + this.files[0].name + '</span>';
            } else {
                feedbackElement.innerHTML = '<span class="file-name">No file chosen.</span>';
            }
        });
    });
});
</script>
@endsection




