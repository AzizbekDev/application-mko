@if(count($errors)>0)
    <div class="box-flash no-border">
        <div class="box-tools">
            @foreach($errors->all() as $message)
                <p class="alert alert-danger alert-dismissible"> {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </p>
            @endforeach
        </div>
    </div>
@elseif(Session::has('message'))
    <div class="box-tools">
        <p class="alert alert-success alert-dismissible">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </p>
    </div>
@elseif(Session::has('error'))
    <div class="box-flash no-border">
        <div class="box-tools">
            <p class="alert alert-danger alert-dismissible">
                {{ Session::get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </p>
        </div>
    </div>
@elseif(Session::has('warning'))
    <div class="box-flash no-border">
        <div class="box-tools">
            <p class="alert alert-warning alert-dismissible">
                {{ Session::get('warning') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </p>
        </div>
    </div>
@elseif(Session::has('success'))
    <div class="box-flash no-border">
        <div class="box-tools">
            <p class="alert alert-success alert-dismissible">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </p>
        </div>
    </div>
@endif