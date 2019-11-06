<label class="{{$class ?? null}}">
    <span>{{$input}}</span>
    {!!Form::text($input, $value ?? null, $attributes)!!}
</label>