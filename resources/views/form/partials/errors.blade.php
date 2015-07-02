@if(!$errors->isEmpty())
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title">{{$title}}</h3>
        </div>
        <div class="panel-body">
            @foreach($errors->getMessages() as $field => $errorForField)
                @foreach($errorForField as $error)
                    <label for="{{$field}}" class="control-label form__label--errorMessage">{{$error}}</label><br>
                @endforeach
            @endforeach
        </div>
    </div>
@endif

{{--
todo: errors controleren
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
--}}
