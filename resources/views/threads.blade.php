@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    My Threads
                    <div class="pull-right">
                        <select id="order_by">
                            <option value="newest" {{ ($order_by=='newest')?'selected':'' }}>Newest</option>
                            <option value="alphabetically" {{ ($order_by=='alphabetically')?'selected':'' }}>Alphabetically</option>
                        </select>
                    </div>
                </div>

                <div class="panel-body">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        @foreach($threads as $key => $thread)
                            @if($key>0)
                                <div class="col-md-12"><hr></div>
                            @endif
                            <div class="col-md-12">
                                <h4>{{ $thread->title }}</h4>
                                <span>{{ str_limit($thread->content, 75, ' (...)') }}</span>
                                
                                <a href="{{ route('view_thread',$thread->id) }}" class="pull-right add_comment btn btn-primary">Read More</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    var url = '{{ route("threads") }}';
    $('#order_by').on('change',function(){
        var order = $(this).val();
        window.location.href = url+'/'+order;
    });
</script>
@endsection