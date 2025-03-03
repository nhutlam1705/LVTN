@extends('admin.index')
@section('content')
<div class="container">
    <h3>Tin tức & sự kiện</h3>
    <form action="{{ route('InformationManager.store') }}" method="POST"  enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="type">Loại</label>
            <select name="type" id="type" class="form-control">
                <option value="tin tức">Tin tức</option>
                <option value="giới thiệu">Giới thiệu</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="thumbnail">Thumbnail</label>
            <input type="file" name="thumbnail" id="thumbnail" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description_information">Mô tả</label>
            <textarea name="description_information" id="codeEditor" class="form-control" rows="15"></textarea>
        </div>
        <br><br>

        <button type="submit" class="btn btn-primary">Thêm</button>
        {{-- <button type="button" id="closeFormButton">Đóng</button> --}}
    </form>
</div>
@endsection