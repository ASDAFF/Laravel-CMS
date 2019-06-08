@extends('layout.admin')

@push('script')
<script>
	var columns  = '{!! json_encode($columns) !!}';
	columns = JSON.parse(columns);
</script>
<script src="{{ Cdn::asset('js/table/permition-table.js') }}"></script>
<script src="{{ Cdn::asset('js/table/change-status.js') }}"></script>
@if(Session::has('alert-success'))
<script>
    jQuery(document).ready(function() {
        $.notify({"message": "{{ Session::get('alert-success') }}" },{"type":"success"});
    });
</script>
@endif
@endpush

@section('content')
    <div class="m_datatable"></div>
@endsection