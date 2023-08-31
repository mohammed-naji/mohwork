@extends('front.master')

@section('content')
    <main>

        <!-- Hero Area Start-->
        <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ asset($project->image) }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>{{ $project->title }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Hero Area End -->
        <!-- job post company Start -->
        <div class="job-post-company pt-120 pb-120">
            <div class="container">
                <div class="row justify-content-between">
                    <!-- Left Content -->
                    <div class="col-xl-7 col-lg-8">
                        <!-- job single -->
                        <div class="single-job-items mb-50">
                            <div class="job-items">
                                @include('front._time')
                            </div>
                        </div>
                          <!-- job single End -->

                        <div class="job-post-details">
                            <div class="post-details1 mb-50">
                                <!-- Small Section Tittle -->
                                <div class="small-section-tittle">
                                    <h4>Job Description</h4>
                                </div>
                                {{ $project->description }}
                            </div>
                            <div class="post-details2  mb-50">
                                 <!-- Small Section Tittle -->
                                <div class="small-section-tittle">
                                    <h4>Required Skills</h4>
                                </div>
                               <ul>
                                @foreach ($project->skills as $skill)
                                    <li>{{ $skill->name }}</li>
                                @endforeach
                               </ul>
                            </div>

                        </div>

                    </div>
                    <!-- Right Content -->
                    <div class="col-xl-4 col-lg-4">
                        <div class="post-details3  mb-50">
                            <!-- Small Section Tittle -->
                           <div class="small-section-tittle">
                               <h4>Job Overview</h4>
                           </div>
                          <ul>
                              <li>Posted date : <span>{{ $project->created_at->format('d M Y ') }}</span></li>
                              @if ($project->user->address)
                              <li>Location : <span>{{ $project->user->address }}</span></li>
                              @endif

                              <li>Job nature : <span>{{ $project->type }}</span></li>
                              <li>Salary :  <span>${{ number_format($project->price) }}</span></li>
                          </ul>
                         <div class="apply-btn2">
                            @if (Auth::check() || Auth::guard('admin')->check())
                                <a data-toggle="modal" data-target="#exampleModal" class="btn text-white">Apply Now</a>
                            @else
                            <a href="{{ route('login') }}" class="btn text-white">Apply Now</a>
                            @endif

                         </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- job post company End -->

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apply to <b class="text-danger">{{ $project->title }}</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('front.project_apply', $project->slug) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control" >
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label>Duration</label>
                            <input type="text" name="duration" class="form-control" >
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label>Content</label>
                            <textarea name="content" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>

                <button class="btn">Save changes</button>

            </form>
        </div>
      </div>
    </div>
  </div>
    </main>
@endsection
