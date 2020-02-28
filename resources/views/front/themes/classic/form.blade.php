@php
    $form = FormBuilder::create(\App\Forms\CustomeForm::class, [
    'method' => 'POST',
        'url' => 'subscribe',
        'class' => 'm-form m-form--state pt-5',
        'id' =>  'custome-form',
        'enctype' => 'multipart/form-data',
    ]);
@endphp
<div class="container mt-5">
{!! form($form) !!}
</div>