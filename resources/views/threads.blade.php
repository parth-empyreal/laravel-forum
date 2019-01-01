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