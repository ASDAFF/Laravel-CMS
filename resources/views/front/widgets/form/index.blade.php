@if(\App\Models\Form::active()->first())
@foreach(\App\Models\Form::active()->first()->fields as $field)
{{ $field->title }}
{{ $field->id }}
@endforeach
@endif