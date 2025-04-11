@extends('layouts.admin')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h1 class="h3 mb-3">Add Secondary Education Information</h1>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('secondary-education') }}" class="btn btn-success"><i class="align-middle me-2"
                                    data-feather="arrow-left"></i>Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('secondary-education-store') }}" enctype="multipart/form-data">

                        @csrf

                        <div class="row">
                            <div class="row m-1">

                            
                                <div class="col-md-6">
                                    <label>
                                        Starting Date
                                    </label>
                                    <input type="date" name="start_date" class="form-control" placeholder="From">
                                </div>

                                <div class="col-md-6">
                                    <label>
                                        End Date
                                    </label>
                                    <input type="date" name="end_date" class="form-control" placeholder="End Date">
                                </div>
                            </div>

                            <br>

                            <div class="row m-1">
                                <div class="col-md-6">
                                    <label>
                                        Institution Name
                                    </label>
                                    <input type="text" name="institution_name" class="form-control"
                                        placeholder=" Institution Name">
                                </div>

                                <div class="col-md-6">
                                    <label>
                                        Country
                                    </label>
                                    <?php
                                    use App\Models\Countries as CountryModel;
                                    $countries = CountryModel::pluck('name', 'id');
                                    ?>
    
                                    <select name="country" id="country" class="form-control">
                                        <option value="">Select Country of Origin</option>
    
                                        <?php foreach ($countries as $id => $name): ?>
                                        <option value="<?= $id ?>">
                                            <?= strtoupper($name) ?>
                                        </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                            </div>

                            <br>
                            <div class="row m-1">
                                <div class="col-md-6">
                                    <label>
                                        Major (Course Studied)
                                    </label>
                                    <input type="text" name="major_subject" class="form-control"
                                        placeholder="Major/Course Studied">
                                </div>

                                <div class="col-md-6">
                                    <label>
                                        Award/Certificate
                                    </label>

                                    <input type="text" name="award" class="form-control"
                                        placeholder="Award/Certificate">

                                </div>
                            </div>

                            <br>

                            <div class="row m-1">

                                <div class="col-md-12">
                                    <label>
                                        Have you studied in China? (Please fill in all study Experience in China)
                                    </label>

                                    <br>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="h_yes" value="yes">
                                        <label class="form-check-label" for="yesCheckbox">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="n_no" value="no">
                                        <label class="form-check-label" for="noCheckbox">No</label>
                                    </div>

                                </div>
                            </div>

                            <div class="row m-1">

                                <div class="col-md-12">
                                    <label>
                                        Certificate/Acedemic Transcripts/Letter (JPG,PNG Only)
                                    </label>

                                    <br>

                                    <input type="file" name="image_path" id="image_path"  accept="image/*">

                                </div>
                            </div>
                        </div>

                        <br>

                        <button class="btn btn-primary" type="submit"><i class="align-middle me-2"
                                data-feather="save"></i>Save</button>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
