        <div class="form-group">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
           





                <form  class="d-inline">
                    @csrf
                  @method('PATCH')
                    <button type="submit" user-id="{{ $user->id }}" class="change_statusUser btn btn-outline-info">
                        Status Management <i class="la la-rotate-right"></i>
                    </button>
                </form>



                        <form  class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button user-id="{{ $user->id }}" type="submit" class="delete_confirmUser btn btn-outline-danger">Delete <i class="la la-trash"></i></button>

                        </form>


            </div>
        </div>
