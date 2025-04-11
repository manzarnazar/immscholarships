@include('includes.top')

<section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h6>Scholarship Details</h6>
          <h2>{{ strtoupper($scholar->title) }}</h2>
        </div>
      </div>
    </div>
  </section>

  <section class="meetings-page" id="meetings">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-12">
              <div class="meeting-single-item">
                <div class="thumb">
                  <div class="price">
                    <span>{{ $scholar->status }}</span>
                  </div>
                  <div class="date">
                    <h6>{{ $scholar->created_at->format('F') }} <span>{{ $scholar->created_at->format('j') }}</span></h6>
                  </div>
                  <a href="#"><img src="assets/images/single-meeting.jpg" alt=""></a>
                </div>
                <div class="down-content">
                  <a href="#"><h4>{{ $scholar->title }}</h4></a>
                  <p>Date Posted: <b> {{ $scholar->created_at->format('F j, Y \a\t g:i A') }} </b> | Entry Level: <b> {{ strtoupper($institutionData->education_level) }} </b> | Duration: <b> {{ $institutionData->duration }} yrs </b></p>

                 
                  <p class="description">
                    <!--<img src="{{ asset($scholar->image_path) ?? asset('default.jpg') }}" alt="Image">-->
                    
                    <!-- Check if $scholarships->image_path is not empty and exists -->
                    @if (!empty($scholar->image_path) && file_exists(public_path($scholar->image_path)))
                        <!-- Display the scholarship image -->
                        <img src="{{ asset($scholar->image_path) }}" class="img-fluid" width="600px" height="325px">
                    @else
                        <!-- Display a default image when the scholarship image is not loaded or not found -->
                        <img src="{{ asset('images/scholarship.jpg') }}" class="img-fluid" width="600px" height="325px">
                    @endif


                    {!! $scholar->description !!}
                  </p>

                  <br>

                  <hr>

                  <div class="row">
                    <div class="col-lg-4">
                      <div class="hours">
                        <h5 class="text text-success">Requirements</h5>
                        <p>
                         {!! $institutionData->requirements !!}
                        </p>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="location">
                        <h5 class="text text-success">Application Fee</h5>
                        <p>{!! $institutionData->application_fee  !!} 
                      </p>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="book now">
                        <h5 class="text text-success">IMS Fee</h5>
                        <p>{!! $institutionData->ims_fee !!}</p>
                      </div>
                    </div>
                    
                      <div class="col-lg-12">
              <div class="main-button-red">
                <a href="{{ route('student-scholarship-store', ['id' => $scholar->id]) }}">Click here to Apply</a>
              </div>
            </div>
            
                    <div class="col-lg-12">
                      <div class="share">
                        <h5>Share:</h5>
                        <ul>
                          <li><a href="https://facebook.com/">Facebook</a>,</li>
                          <li><a href="https:://twitter.com/">Twitter</a>,</li>
                          <li><a href="https://whatsapp.com">WhatsApp</a></li>
                         
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
          </div>
        </div>
      </div>
    </div>
   

@include('includes.footer')