<style>
    .file-preview {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .file-preview img {
        border-radius: 6px;
        border: 1px solid #ccc;
    }
    .file-label {
        font-weight: bold;
    }
    .download-btn, .view-btn {
        padding: 5px 10px;
        font-size: 0.875rem;
        border-radius: 6px;
        margin-top: 5px;
        display: inline-block;
    }
    .download-btn {
        background-color: #1e40af;
        color: white;
    }
    .view-btn {
        background-color: #e0e7ff;
        color: #1e40af;
    }
    .not-uploaded {
        background: #fcd34d;
        color: #7c2d12;
        padding: 3px 8px;
        font-size: 0.8rem;
        border-radius: 5px;
    }
</style>

<table class="table table-bordered table-striped mt-4">
    <thead>
        <tr>
            <th>#</th>
            <th>Study Plan</th>
            <th>CV</th>
            <th>Recommendation Letter</th>
            <th>Police Clearance</th>
            <th>Bank Statement</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($attachments as $index => $data)
        <tr>
            <td>{{ $loop->iteration }}</td>

            {{-- Helper function to display any file --}}
            @php
                function fileBlock($file, $label) {
                    if (!$file) {
                        return "<span class='not-uploaded'>Not Uploaded</span>";
                    }

                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $url = asset($file);
                    if ($ext === 'pdf') {
                        return "<div class='file-preview'>
                                    <span class='file-label'>📄 $label (PDF)</span><br>
                                    <a href='$url' target='_blank' class='view-btn'>View</a>
                                    <a href='$url' download class='download-btn'>Download</a>
                                </div>";
                    } else {
                        return "<div class='file-preview'>
                                    <img src='$url' alt='$label' width='60' height='60'>
                                    <div>
                                        <span class='file-label'>🖼️ $label (Image)</span><br>
                                        <a href='$url' download class='download-btn'>Download</a>
                                    </div>
                                </div>";
                    }
                }
            @endphp

            {{-- Render each field --}}
            <td>{!! fileBlock($data->study_plan, 'Study Plan') !!}</td>
            <td>{!! fileBlock($data->cv, 'CV') !!}</td>
            <td>{!! fileBlock($data->recomendation_letter, 'Recommendation Letter') !!}</td>
            <td>{!! fileBlock($data->police_clearance, 'Police Clearance') !!}</td>
            <td>{!! fileBlock($data->bank_statement, 'Bank Statement') !!}</td>

            <td>
                <button type="button" class="btn btn-success" onclick="downloadAllFiles({{ $index }})">
                    📥 Download All
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    function downloadAllFiles(index) {
        const attachments = @json($attachments);
        const baseUrl = "{{ url('/') }}/";

        if (!attachments || !attachments[index]) {
            alert("Attachment not found.");
            return;
        }

        const data = attachments[index];

        const files = [
            data.study_plan,
            data.cv,
            data.recomendation_letter,
            data.police_clearance,
            data.bank_statement,
            data.physical_exam // optional
        ];

        files.forEach(file => {
            if (file) {
                const link = document.createElement('a');
                link.href = file.startsWith('http') ? file : baseUrl + file;
                link.download = file.split('/').pop();
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        });
    }
</script>

