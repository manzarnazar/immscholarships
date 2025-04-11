@extends('layouts.admin')

@section('content')


    <main class="content">
        <div class="container-fluid p-0">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h1 class="h3 mb-3">Add Guarantor Information</h1>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('guarantor') }}" class="btn btn-success"><i class="align-middle me-2" data-feather="arrow-left"></i>Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('guarantor-store')}}">

                        @csrf

                    <div class="row">
                     
                        <div class="col-md-6">
                            <label>
                                Full Name
                            </label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Full Name">
                        </div>

                        <div class="col-md-6">
                            <label>
                                Relationship
                            </label>
                           <select class="form-control" id="relationship" name="relationship">
                            <option value="">Select Relationship</option>
                            <option value="Mother">Mother</option>
                            <option value="Father">Father</option>
                            <option value="Sister">Sister</option>
                            <option value="Brother">Brother</option>
                            <option value="Uncle">Uncle</option>
                            <option value="Aunt">Aunt</option>
                            <option value="Grandmom">Grandmom</option>
                            <option value="Grandpa">Grandpa</option>
                            

                           </select>
                        </div>

                     



                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label>
                                Email Address
                            </label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="example@example.com">
                        </div>

                        <div class="col-md-6">
                            <label>
                                Physical Address
                            </label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="Physical Address"
                                >
                        </div>

                     



                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label>
                                Profession
                            </label>
                            <input type="text" name="profession" id="profession" class="form-control" placeholder="profession">
                        </div>

                        <div class="col-md-6">
                            <label>
                                Work Institution
                            </label>
                            <input type="text" name="work_institution" id="work_institution" class="form-control" placeholder="12/02/2026"
                                >
                        </div>

                     



                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label>
                                Country/Region
                            </label>
                            <?php
                            use App\Models\Countries;
                            $airports = Countries::pluck('name', 'id');
                            ?>
        
                            <select name="country" id="country" class="form-control">
                                <option value="">Select  Country of Birth</option>
        
                                <?php foreach ($airports as $name): ?>
                                <option value="<?= $name ?>">
                                    <?= strtoupper($name) ?>
        
                                </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>
                                Mobile Number
                            </label>
                            <input type="number" name="mobile" id="mobile" class="form-control" placeholder="+867171716"
                                >
                        </div>

                     



                    </div>

                   

                    <br>

                    <button class="btn btn-primary" type="submit"><i class="align-middle me-2" data-feather="save"></i>Save</button>

                </form>  
                </div>
            </div>
        </div>
    </main>
@endsection


