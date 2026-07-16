     <div class="modal" id="editFaqs">
         <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content modal-content-demo">
                 <div class="modal-header">
                     <h6 class="modal-title">Edit Faqs</h6>
                     <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="alert alert-danger" id="edit_alert_div" style="display: none">
                     <ul id="edit_error_list"></ul>
                 </div>
                 <form action="" id="edit_faqs" method="post">
                     @csrf
                     <div class="modal-body">


                         <div class="form-group">
                             <label for="name">Questions</label>
                             <input type="text" name="question" id="edit_question" class="form-control"
                                 placeholder="Enter question ">
                             @error('question')
                                 <span class="text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                         <input type="hidden" id="edit_faqs_id" name="id">



                         <div class="form-group">
                             <label for="">Answer</label>
                             <textarea id="edit_answer" name="answer"  class="form-control" rows="5" placeholder="Enter the answer..."></textarea>


                             @error('answer')
                                 <span class="text-danger">{{ $message }}</span>
                             @enderror


                         </div>





                     </div>

                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary">Update</button>
                     </div>
                 </form>

             </div>
         </div>
     </div>
