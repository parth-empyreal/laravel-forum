@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">My Threads</div>

                <div class="panel-body">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('save_thread') }}" class="form-horizontal" method="post" name="save_thread" id="save_thread">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-2">Title</label>

                            <div class="col-md-4">
                                <input id="title" type="title" class="form-control" name="title" value="{{ old('title',Auth::user()->title) }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-2">Content</label>

                            <div class="col-md-4">
                                <input id="content" type="content" class="form-control" name="content" value="{{ old('content',Auth::user()->content) }}">

                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="col-md-12"><hr></div>
                    <div class="clearfix"></div>
                    <div class="row">
                        @foreach($threads as $key => $thread)
                            @if($key>0)
                                <div class="col-md-12"><hr></div>
                            @endif
                            <div class="col-md-12">
                                <h4>{{ $thread->title }}</h4>
                                <span>{{ str_limit($thread->content, 75, ' (...)') }}</span>
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
    $(document).ready(function(){
        $('#save_thread').validate({
            wrapper: "span",
            errorPlacement: function(label, element) {
                label.addClass('help-inline');
                if (element.attr("type") == "radio") {
                    $(element).parents('.controls').append(label)
                } else {
                    label.insertAfter(element);
                }
            },
            rules: {
                title:{
                    required:true,
                    lettersonly: true,
                    minlength: 3
                },
                content:{
                    'dot':true,
                    maxlength: 255
                }
             },
            messages: {
                title:{
                    required:"Please enter Title",
                    minlength:"Please enter at least 3 characters."
                },
                content:{
                    required:"Please enter description",
                    'maxlength':"Maximum 255 characters allowed."
                }
            }
        });
    });
    $.validator.addMethod("dot",function (value, element, requiredValue) {
        var lastChar = value[value.length -1];
        if(value.length>0)
            return lastChar === '.';
        else
            return true;
    },"Please add dot(.) at end.");
    jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Please enter letters only."); 
</script>
@endsection