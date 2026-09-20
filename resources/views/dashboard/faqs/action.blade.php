
                        <form class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" faqQuetion-id="{{ $faqQuetion->id }}" class="delete_confirm_faqQuetion btn btn-outline-danger">Delete <i class="la la-trash"></i></button>

                        </form>
