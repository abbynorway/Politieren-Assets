import $ from 'jquery';

class CatColor {
    // 1. describe and create/initiate object
    constructor() {
		 this.addSearchHTML();
		 this.resultsDiv = $("#search-overlay__results");
		 this.openButton = $(".js-search-trigger");
		 this.closeButton = $(".search-overlay__close");
		 this.SearchOverlay = $(".search-overlay");
		 this.searchField = $("#search-term");
		 this.events();
		 this.isOverlayOpen = false;
		 this.isSpinnerVisible = false;
		 this.previousValue;
		 this.typingTimer;
    }    
    
    // 2. events
	
	events() {
		this.openButton.on("click", this.openOverlay.bind(this));
		this.closeButton.on("click", this.closeOverlay.bind(this));
		$(document).on("keydown", this.keyPressDispatcher.bind(this));
		this.searchField.on("keyup", this.typingLogic.bind(this));
	}
    
    // 3. methods (functions, actions)
	typingLogic() {
		if (this.searchField.val() != this.previousValue) {
			
			clearTimeout(this.typingTimer);
			
			if (this.searchField.val()) {
				if (!this.isSpinnerVisible) {
				this.resultsDiv.html('<div class="spinner-loader"></div>');
				this.isSpinnerVisible = true;
				}

				this.typingTimer = setTimeout(this.getResults.bind(this), 500); // two arguments: function, time in ms 
				
			} else {
				this.resultsDiv.html('');
				this.isSpinnerVisible = false;
			}
		}
		
		this.previousValue = this.searchField.val();
	}
	
	getResults() {
		$.when(
			$.getJSON(optimatData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val()), 
			$.getJSON(optimatData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val())
			).then((pages, posts) => {	
			var combinedResults = pages[0].concat(posts[0]);
				this.resultsDiv.html(`
					<h2>PAGES & POSTS</h2>
					${combinedResults.length ? '<ul>' : '<p>Keine Ergebnisse für diese Suche.</p>'}
						${combinedResults.map(item => `<li><a href="${item.link}">${item.title.rendered}</a> ${item.type == 'post' ? `by ${item.authorName}` : ''}</li>`).join('')}
					${combinedResults.length ? '</ul>' : ''}
				`);
				this.isSpinnerVisible = false;
		}, () => {
			this.resultsDiv.html('<p>Unerwarteter Fehler. Bitte versuche es erneut.</p>');
		});
	}
	
	keyPressDispatcher(e) {
		
		// if pressing S-Key (83): do function openOverlay
		if (e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) { 
			this.openOverlay();	 
		}	
		
		// if pressing ESC-Key (27): do function openOverlay
		if (e.keyCode == 27 && this.isOverlayOpen) {
			this.closeOverlay();	 
		}
		
	}
	
	openOverlay() {
		this.SearchOverlay.addClass("search-overlay--active");
		$("body").addClass("body-no-scroll"); // add class body-no-scroll to prevent scrolling page in background
		this.searchField.val('');
		setTimeout(() => this.searchField.focus(), 301); //301: 300ms dauert transition in css -> js macht es erst, wenn visible
		console.log("Open Method just ran");
		this.isOverlayOpen = true;
	}	
	
	closeOverlay() {
		this.SearchOverlay.removeClass("search-overlay--active");
		$("body").removeClass("body-no-scroll"); // remove class body-no-scroll after closing search
		console.log("closeMethod just ran");
		this.isOverlayOpen = false;
	}
	
	addSearchHTML() {
		$.when($.getJSON(optimatData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val())).then(
		$("body").append(`
			<div class="search-overlay">
				<p style="color: ${}"><b>IT WORKS</b></p>
			</div>
		`);
	}
	
}

export default CatColor;