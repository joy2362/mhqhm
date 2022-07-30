@extends('admin.layout.master')
@section('title')
    <title>Application Setting</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Application Setting</h1>
            </div>
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">App Logo</h5>
                        </div>
                        <div class="card-body text-center">
                            <div style="position: relative; width: 150px; height: 150px">
                                <img  src="{{ $setting->logo }}" alt="{{$setting->name}}" class="img-fluid rounded-circle mb-2" style="width:100%; height:100%;  overflow: hidden;" />
                                <button style="bottom: 0;right:0; position: absolute;border-radius: 50%;width: 35px;height: 35px" data-bs-toggle="modal" data-bs-target="#changeImage" class="btn btn-primary btn-sm"> <i class="align-middle" data-feather="camera"></i></button>
                            </div>
                        </div>
                        <hr class="my-0" />
                    </div>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Favicon</h5>
                        </div>
                        <div class="card-body text-center">
                            <div style="position: relative; width: 150px; height: 150px">
                                <a href="{{$setting->favicon}}"> <img src="{{ $setting->favicon }}" alt="{{$setting->name}}" class="img-fluid rounded-circle mb-2" style="width:250px; height:150px;" /></a>
                                <button style="bottom: 0;right:0; position: absolute;border-radius: 50%;width: 35px;height: 35px" data-bs-toggle="modal" data-bs-target="#changeFaviconImage" class="btn btn-primary btn-sm"><i class="align-middle" data-feather="camera"></i></button>
                            </div>
                        </div>
                        <hr class="my-0" />
                    </div>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="changeImage" tabindex="-1" aria-labelledby="changeImageLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form method="post" action="{{route('admin.logos.update','logo')}}"  enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="changeImageLabel">Change Logo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" id="image" name="image" placeholder="Image" accept="image/*">
                                        <label for="image">Logo</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!--favicon image Modal -->
                <div class="modal fade" id="changeFaviconImage" tabindex="-1" aria-labelledby="changeFaviconImageLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form method="post" action="{{route('admin.logos.update','favicon')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="changeFaviconImageLabel">Change Favicon Image</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" id="favicon" name="image" placeholder="Image" accept="image/*">
                                        <label for="favicon">Favicon</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-xl-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Update Application Setting</h5>
                        </div>
                        <div class="card-body h-100">
                            <div class="d-flex align-items-start">
                                <form class="flex-grow-1" method="POST" action="{{route('admin.setting.update',1)}}">
                                    @csrf
                                    @method('put')
                                    <div class="form-group g-2 mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control"  id="name" name="name" required value="{{$setting->name}}">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group g-2 mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control"  id="email" name="email" required value="{{$setting->email}}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group g-2 mb-3">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control"  id="phone" name="phone" required value="{{$setting->phone}}">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>




                                    <div class="form-group g-2 mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control"  id="address" name="address" value="{{$setting->address}}">
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group g-2 mb-3">
                                        <label for="facebook">Facebook</label>
                                        <input type="text" class="form-control"  id="facebook" name="facebook" value="{{$setting->facebook}}">
                                        @error('facebook')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group g-2 mb-3">
                                        <label for="twitter">Twitter</label>
                                        <input type="text" class="form-control"  id="twitter" name="twitter" value="{{$setting->twitter}}">
                                        @error('twitter')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group g-2 mb-3">
                                        <label for="linkedin">Linkedin</label>
                                        <input type="text" class="form-control"  id="linkedin" name="linkedin" value="{{$setting->linkedin}}">
                                        @error('linkedin')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group g-2 mb-3">
                                        <label for="instagram">Instagram</label>
                                        <input type="text" class="form-control"  id="instagram" name="instagram" value="{{$setting->instagram}}">
                                        @error('instagram')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group g-2 mb-3">
                                        <label for="youtube_link">Youtube Video Link</label>
                                        <input type="text" class="form-control" id="youtube_link" name="youtube_link" value="{{$setting->youtube}}">
                                        @error('youtube_link')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group g-2 mb-3">
                                        <label for="footer_description">Footer Description</label>
                                        <input type="text" class="form-control"  id="footer_description" name="footer_description" value="{{$setting->footer_description}}">
                                        @error('footer_description')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-sm btn-success mt-1"> Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script>
        $(document).ready(function(){

        });
    </script>
@endsection
