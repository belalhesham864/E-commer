        <div class="form-group">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <a href="{{ route('dashboard.brands.edit', $brand->id) }}" class="btn btn-outline-success">Edit <i
                        class="la la-edit"></i></a>





                <form action="{{ route('dashboard.brands.status', $brand->id) }}" method="POST" class="d-inline">
                    @csrf
                  @method('PATCH')
                    <button type="submit" class="change_status btn btn-outline-info">
                        Status Management <i class="la la-rotate-right"></i>
                    </button>
                </form>

          
                   
                        <form action="{{ route('dashboard.brands.destroy', $brand->id) }}" method="POST"  class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete_confirm btn btn-outline-danger">Delete <i class="la la-trash"></i></button>

                        </form>
                    
              
            </div>
        </div>
