<div class="col-12">
    <div class="form-group">
        <div class="controls">
            <label for="schname">Sekolah</label>
            <input type="text" name="schname" id="schname" value="{{ $data->schname ?? '' }}" class="form-control" required>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="form-group">
        <div class="controls">
            <label for="department">Jurusan</label>
            <input type="text" name="department" id="department" value="{{ $data->department ?? '' }}" class="form-control" required>
        </div>
    </div>
</div>