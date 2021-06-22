<div class="col-12">
    <div class="form-group">
        <div class="controls">
            <label for="address">Alamat</label>
            <input type="text" name="address" id="address" value="{{ $data->address ?? '' }}" class="form-control" required>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="form-group">
        <div class="controls">
            <label for="phone">Nomor HP</label>
            <input type="text" name="phone" id="phone" value="{{ $data->phone ?? '' }}" class="form-control" required>
        </div>
    </div>
</div>
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