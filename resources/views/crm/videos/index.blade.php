<x-crm.layout.app>
<main>
    <div class="p-3">
        <div class="page-header d-flex align-items-center mb-3">
            <div class="page-header-left">
                <h5 class="m-0 fw-bold">YouTube Videos Master</h5>
            </div>
            <div class="page-header-right ms-auto d-flex gap-2">
                <a href="{{ route('videos.create') }}" class="btn btn-primary btn-sm px-3 shadow-sm">
                    <i class="feather feather-plus"></i> Add Video
                </a>
            </div>
        </div>

        <div id="collapseadd" class="collapse {{ (isset($createMode) || isset($editMode)) ? 'show' : '' }} mb-4">
    <div class="card border-0 shadow-sm p-4 bg-white mt-2">
        
        <h6 class="mb-4 text-primary border-bottom pb-2 fw-bold d-flex align-items-center">
            <i class="feather {{ isset($video) ? 'feather-edit' : 'feather-video' }} me-2" style="font-size: 18px;"></i>
            {{ isset($video) ? 'Edit Video Details' : 'Add New Video' }}
        </h6>
        
        <form action="{{ isset($video) ? route('videos.update', $video->id) : route('videos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf @if(isset($video)) @method('PUT') @endif
            
            <div class="row g-4 align-items-end">
                
                <div class="col-md-4">
                    <label class="form-label font-weight-bold text-uppercase small text-muted mb-1">Video Title <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="feather feather-type text-muted"></i></span>
                        <input type="text" name="title" class="form-control border-start-0 ps-0" value="{{ $video->title ?? old('title') }}" required placeholder="Enter video title">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label font-weight-bold text-uppercase small text-muted mb-1">YouTube URL <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="feather feather-link text-muted"></i></span>
                        <input type="url" name="url" class="form-control border-start-0 ps-0" value="{{ $video->url ?? old('url') }}" required placeholder="https://youtube.com/...">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label font-weight-bold text-uppercase small text-muted mb-1">Thumbnail Image</label>
                    <div class="input-group">
                        
                        <input type="file" name="thumbnail" class="form-control border-start-0 ps-0" accept="image/*">
                    </div>
                    @if(isset($video) && $video->thumbnail)
                        <small class="text-success mt-1 d-block"><i class="feather feather-check-circle"></i> Current image uploaded</small>
                    @endif
                </div>
                
                <div class="col-12 mt-4 pt-4 border-top d-flex align-items-center gap-3">
                    <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm text-uppercase fw-bold" style="width: auto;">
                        <i class="feather {{ isset($video) ? 'feather-check' : 'feather-save' }} me-1"></i>
                        {{ isset($video) ? 'Update Video' : 'Save Video' }}
                    </button>
                    <a href="{{ route('videos.index') }}" class="btn btn-light border px-4 py-2 text-dark text-uppercase fw-bold" style="width: auto; background-color: #f8f9fa;">
                        <i class="feather feather-x me-1"></i> Cancel
                    </a>
                </div>
                
            </div>
        </form>
    </div>
</div>

        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0" style="border-color: #f1f1f1;">
                    <thead style="background: #ffffff;">
                        <tr class="text-uppercase" style="font-size: 11px; color: #777;">
                            <th class="ps-3 py-3" style="width: 80px;">Sr. No.</th>
                            <th style="width: 100px;">Thumbnail</th>
                            <th>Video Title</th>
                            <th>YouTube Link</th>
                            <th class="text-center" style="width: 100px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($videos as $index => $v)
                        <tr style="background: {{ $index % 2 == 0 ? '#f9f9f9' : '#ffffff' }}; border-bottom: 1px solid #f1f1f1;">
                            <td class="ps-3 text-muted">{{ $index + 1 }}</td>
                            <td>
                                @if($v->thumbnail)
                                    <img src="{{ asset('uploads/thumbnails/'.$v->thumbnail) }}" alt="Thumb" class="rounded shadow-sm" style="width: 80px; height: 45px; object-fit: cover;">
                                @else
                                    <span class="badge bg-light text-muted border">No Image</span>
                                @endif
                            </td>
                            <td class="fw-bold text-dark">{{ $v->title }}</td>
                            <td><a href="{{ $v->url }}" target="_blank" class="text-primary small"><i class="feather feather-external-link"></i> Watch Video</a></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('videos.edit', $v->id) }}" class="btn btn-sm border bg-white text-primary shadow-sm px-2 py-1">
                                        <i class="feather feather-edit-2" style="font-size: 13px;"></i>
                                    </a>
                                    <form action="{{ route('videos.destroy', $v->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this video?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm border bg-white text-danger shadow-sm px-2 py-1">
                                            <i class="feather feather-trash-2" style="font-size: 13px;"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
</x-crm.layout.app>