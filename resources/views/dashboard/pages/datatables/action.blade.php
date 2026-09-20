        <div class="form-group">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <a  href="{{ route('dashboard.pages.edit',$page->id) }}" class="btn btn-outline-success">Edit <i
                        class="la la-edit"></i></a>



                        <form class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" page-id="{{ $page->id }}" class="delete_confirm_page btn btn-outline-danger">Delete <i class="la la-trash"></i></button>

                        </form>


            </div>
        </div>
