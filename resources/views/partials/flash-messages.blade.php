<div class="row">
    <div class="col-xs-12">
        @if(Session::has('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {!! Session::get('success') !!}
            </div>
        @endif

        @if(Session::has('info'))
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {!! Session::get('info') !!}
            </div>
        @endif
        @if(Session::has('danger'))
            <div class="alert alert-danger animated jello">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {!! Session::get('danger')!!}
            </div>
        @endif
    </div>
</div>
