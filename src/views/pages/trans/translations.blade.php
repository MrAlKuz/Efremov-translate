@extends('vocabulare::layouts.main')

@section('content')

    <div class="panel panel-flat">
        <div class="panel-heading">

            <h5 class="panel-title">Translations</h5>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel-body">
                    <form action="{{ route('translate.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>@lang('main.new_translation')</label>
                                    <input type="text" name="key" value="" class="form-control">
                                    <input type="hidden" name="group_id" value="{{ $group_id }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">@lang('main.create')<i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if (!empty($success))
            <h1>{{$success}}</h1>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="translate" action="{{ route('translate.update', [ 'id' => $group_id ]) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT" />
            {{--<input type="hidden" name="group_id" value="{{ $group_id }}" class="form-control">--}}
            <input type="hidden" name="type" value="{{ $type }}" class="form-control">
        <table class="table">
            <thead>
            <tr>
                <th>@lang('main.key')</th>
                @foreach($langs as $lang)
                    <th>{{ $lang->name }}</th>
                @endforeach
            </tr>
            </thead>

            <tbody>
            @foreach($trans as $value)
                <tr>
                    <td>{{ $value->key }}</td>
                    @foreach($transData[$value->id] as $data)
                    <td @if($data['status'] == 0) bgcolor="#FF0000" @elseif($data['status'] == 1) bgcolor="#00FF00" @endif>
                        <input type="text" name="{{ $value->key.'['. $data['lang_id'] .']' }}" value="{{ $data['value'] }}" class="form-control">
                    </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">@lang('main.create')<i class="icon-arrow-right14 position-right"></i></button>
            </div>
        </form>
    </div>
    <script type='text/javascript'>

    </script>

@endsection