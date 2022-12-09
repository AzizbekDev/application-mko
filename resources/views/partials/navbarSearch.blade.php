<div class="form-row">
    <form action="{{ route('admin.application.search') }}">
        <div class="input-group">
            <input type="search" name="phone" class="form-control form-control-sm" placeholder="Phone number">
            <div class="input-group-append">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>
</div>