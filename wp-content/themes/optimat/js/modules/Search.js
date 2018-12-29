import $ from 'jquery';

class Search {
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
		$.getJSON(optimatData.root_url + '/wp-json/optimat/v1/search?term=' + this.searchField.val(), (results) => {			 
			this.resultsDiv.html(`
			${results.themen.length ? '<div class="cards-container"><div class="cards">' : '<p>Keine Ergebnisse für diese Suche.</p>'}
			${results.themen.map(item => `

			<div class="single-card">

				<div class="icon-tags">
					${item.category[0].name} 
				</div>

				<div class="single-card--text-container">
					<a href="${item.permalink}"><h3>${item.title}</h3></a>
					<p>${item.excerpt}</p>
					<a class="more" href="${item.permalink}">Mehr</a>
				</div>

			</div>
			`).join('')}
				${results.themen.length ? '</div></div>' : ''}
			</div>
			`);
			this.isSpinnerVisible = false;
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
		$("body").append(`
			<div class="search-overlay">
				<div class="searh-overlay__top">
						<div class="search-overlay__icon" aria-hidden="true">SUCHE:</div>
						<input type="text" class="search-term" placeholder="Was suchst du?" id="search-term">
						<div class="search-overlay__close" aria-hidden="true">Schließen X</div>

						<div class="container">
							<div id="search-overlay__results">Let's search</div>
						</div>
				</div>
			</div>
		`);
	}
	
}

export default Search;