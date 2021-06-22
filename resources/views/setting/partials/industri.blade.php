<div class="col-12">
    <div class="form-group">
        <div class="controls">
            <label for="address">Alamat</label>
            <input type="text" name="address" id="address" value="{{ $data->biography->address ?? '' }}" class="form-control" required>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="form-group">
        <div class="controls">
            <label for="phone">Nomor HP</label>
            <input type="text" name="phone" id="phone" value="{{ $data->biography->phone ?? '' }}" class="form-control" required>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="form-group">
        <div class="controls">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="{{ $data->biography->email ?? '' }}" class="form-control" required>
        </div>
    </div>
</div>