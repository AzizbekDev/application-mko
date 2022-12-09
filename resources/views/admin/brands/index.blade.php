@extends('layouts.admin')
@section('content')
{{ Breadcrumbs::render('brands') }}
<div class="card">
    <div class="card-header">
        {{ trans('cruds.brands.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Brands text-center">
            <thead>
                <tr>
                    <th width="5%">

                    </th>
                    <th width="5%">
                        {{ trans('cruds.brands.fields.id') }}
                    </th>
                    <th width="30%">
                        {{ trans('cruds.brands.fields.name') }}
                    </th>
                    <th width="20%">
                        {{ trans('cruds.brands.fields.logo') }}
                    </th>
                    <th width="20%">
                        {{ trans('cruds.brands.fields.status') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
$(function () {
  let dtOverrideGlobals = {
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.brands.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
      { data: 'id', name: 'id' },
      { data: 'name', name: 'name' },
      { data: 'logo', name: 'logo',
          render: function (data) {
              return "<img src=\"" + data + "\" height=\"100\"/>";
          }
      },
      { data: 'status', name: 'status' },
      { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 20,
  };
  let table = $('.datatable-Brands').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
});

</script>
@endsection