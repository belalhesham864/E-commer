        <div class="form-group">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-outline-success">Edit <i
                        class="la la-edit"></i></a>
                <form action="{{ route('dashboard.category.status', $category->id) }}" method="POST" class="d-inline">
                    @csrf
                  @method('PATCH')
                    <button type="submit" class="change_status btn btn-outline-info">
                        Status Management <i class="la la-stop"></i>
                    </button>
                </form>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop2" type="button" class="btn btn-outline-danger dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Delete <i class="la la-trash"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete_confirm dropdown-item">Delete</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
