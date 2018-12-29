import $ from 'jquery';

class MyNotes {
	constructor() {
		
        this.events();
		
   }
    
    events() {
       
      $(".delete-note").on("click", this.deleteNote);  
      $(".edit-note").on("click", this.editNote);  
        
    }
    
    // Methods
	
    editNote(e) {
		 var thisNote = $(e.target).parents("li"); // gets id stored in li
		 thisNote.find(".note-title-field, .note-body-field").removeAttr("readonly").addClass("note-active-field");   
    }	
	
    deleteNote(e) {
		 var thisNote = $(e.target).parents("li"); // gets id stored in li
		 
      $.ajax({
			beforeSend: (xhr) => {
				xhr.setRequestHeader('X-WP-Nonce', optimatData.nonce);
			},
			url: optimatData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
			type: 'DELETE',
			success: (response) => {
				thisNote.slideUp();
				console.log("Glückwunsch!");
				console.log(response);
			},
			error: (response) => {
				console.log("Sorry...");
				console.log(response);
			}
		});
        
    }
}

export default MyNotes;