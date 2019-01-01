@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    My Threads
                </div>

                <div class="panel-body">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <h4>{{ $thread->title }}</h4>
                            <p>{{ $thread->content }}</p>
                            <div class="row comments_div">
                                <form class="form-horizontal" action="{{ route('add_comment',$thread->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="col-md-11">
                                        <textarea name="comment" class="form-control comment"></textarea>
                                    </div>
                                    <div class="col-md-1">
                                        <button class="pull-right add_comment btn btn-primary">
                                           Comment 
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
    $('.add_comment').on('click',function(){
        // 
    });
</script>
@endsection