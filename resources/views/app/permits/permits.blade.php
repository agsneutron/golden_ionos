<div class="row">
    <div class="col-lg-12">
        <h2 class="text-danger">
            Permisos
        </h2>
        <br>
        <h3><i class="fa fa-user"></i>&nbsp;{{ $type['Description'] }}</h3>
        <br>
    </div>
    <div class="col-md-6 col-md-offset-6" align="left">
        <div class="form-group" >
            <label>Asignado a sucursal:</label>
            <select name="flag" id="flag" class="form-control">
                <option {{ $type['FlagAsignedBranch'] == 1 ? 'selected' : '' }} value="1">Si</option>
                <option {{ $type['FlagAsignedBranch'] == 0 ? 'selected' : '' }} value="0">No</option>
            </select>
        </div>
    </div>
    @foreach($groups as $group)
            <div class="col-lg-12">
                <h4 class="text-danger">Permisos</h4>
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-2">
                        <table class="table table-hover margin bottom">
                            <thead>
                                <tr>
                                    <th align="center"><i class="fa fa-lock"></i></th>
                                    <th>Modulo</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($group['modules'] as $module)
                                <tr>
                                    <td>
                                        <input {{ in_array($module['Id'], $permits) ? 'checked' : ''  }}
                                               type="checkbox" value="1" class="checkPermission"
                                               data-id="{{ $module['Id'] }}"
                                               name="check{{ $module['Id'] }}"
                                        >
                                    </td>
                                    <td>{{ $module['Name'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    @endforeach
</div>


<script>
    profileSelected = parseInt('{{ $type['Id'] }}');
    $(".checkPermission").click(function() {
        moduleId = $(this).data('id');
        if($(this).is(':checked')) {
            permission = 1;
        } else {
            permission = 0;
        }
        $.post('{{ route('permits.changePermission') }}',
            {
                _token: '{{ csrf_token() }}',
                permission: permission,
                moduleId: moduleId,
                profileSelected: profileSelected
            }, 'json');
    });

    $("#flag").change(function(){
        $.post('{{ route('permits.changeFlag') }}',
            {
                _token: '{{ csrf_token() }}',
                flag: $("#flag").find(":selected").val(),
                profileSelected: profileSelected
            }, 'json');
    })
</script>