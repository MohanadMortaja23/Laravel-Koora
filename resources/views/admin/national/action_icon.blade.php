

<div style="display: row" class="row">
    <tr>
    
        <a href="{{ route('natio-teams.edit', $na->id) }}" class="btn btn-info"><i class="fa fa-lg fa-edit"></i></a>
        <form action="{{ route('natio-teams.destroy', $na->id) }}" method="POST">
            @csrf
            @method('delete')
        <button type="submit" class="btn btn-danger"><i class="fa fa-lg fa-trash"></i></button>
        </form>
        <tr>
            <div class="toggle lg">
                <label>
                    <input name="status" type="checkbox" checked value="{{ ( $na->status == 1 ) ? '1' : '0'  }}"><span class="button-indecator"></span>
                </label>
            </div>
        </tr>
    </tr>
    </div>
    