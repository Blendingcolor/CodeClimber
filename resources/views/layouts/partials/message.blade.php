@if (isset($errors) && count($errors)>0)
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
    
@if (Session::get('success', false))
    <?php $data= Session::get('success',false); ?>
        @if (is_array($data))
            @foreach ($data as $message)
                {{ $message }}
            @endforeach
        @endif
@endif 