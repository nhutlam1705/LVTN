@extends('admin.index')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Cập nhật Tin tức & Sự kiện</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('InformationManager.Update', $information->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Loại -->
                        <div class="mb-3">
                            <label for="type" class="form-label">Loại</label>
                            <select name="type" id="type" class="form-select">
                                <option value="tin tức" {{ $information->type === 'tin tức' ? 'selected' : '' }}>Tin tức</option>
                                <option value="giới thiệu" {{ $information->type === 'giới thiệu' ? 'selected' : '' }}>Giới thiệu</option>
                            </select>
                        </div>

                        <!-- Tiêu đề -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $information->title }}" placeholder="Nhập tiêu đề">
                        </div>

                        <!-- Thumbnail -->
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail</label>
                            @if ($information->thumbnail)
                                <div class="mb-3">
                                    <img src="{{ asset('images/' . $information->thumbnail) }}" alt="Thumbnail" class="img-thumbnail d-block" style="max-width: 150px;">
                                </div>
                            @endif
                            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3">
                            <label for="description_information" class="form-label">Mô tả</label>
                            <textarea name="description_information" id="codeEditor" class="form-control" rows="8" placeholder="Nhập mô tả">{{ $information->description_information }}</textarea>
                        </div>

                        <!-- Nút hành động -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('InformationManager.ShowInformation') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left-circle"></i> Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Cập nhật
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
