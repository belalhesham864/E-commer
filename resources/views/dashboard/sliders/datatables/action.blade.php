        <div class="form-group">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <a slider-id="{{ $slider->id }}" class="Edit_Slider btn btn-outline-success">Edit <i
                        class="la la-edit"></i></a>



                        <form class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" slider-id="{{ $slider->id }}" class="delete_confirm_slider btn btn-outline-danger">Delete <i class="la la-trash"></i></button>

                        </form>


            </div>
        </div>
