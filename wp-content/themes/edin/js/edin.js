/* global screen_reader_text */
( function( $ ) {

	/**
	 * A function to add classes to body depending on window width.
	 */
	function body_class() {

		window_width = $( window ).width();
		$( 'body' ).removeClass( 'small-screen medium-screen large-screen' );
		if ( window_width >= 1020 ) {
			$( 'body' ).addClass( 'small-screen medium-screen large-screen' );
		} else if ( window_width >= 768 ) {
			$( 'body' ).addClass( 'small-screen medium-screen' );
		} else if ( window_width >= 600 ) {
			$( 'body' ).addClass( 'small-screen' );
		}

	}

	function findState() {

		var url = '/',
			$form = $( '#find-state-form' ),
			$select = $( 'select', $form );

		if ($form) {
			$select.on('change', function() {
				url = this.value;
			});

			$form.on('submit', function() {
				window.location.href = url;
				return false;
			});
		}

	}

	function accordions() {

		var activeClass = 'active',
			$container = $( '#accordions' ),
			$accordions = $( '.accordion', $container ),
			accordLength = $accordions.length,
			$titles = $( '.accordion-title', $container );

		if ($container) {
			$titles.on( 'click', function() {
				var $this = $(this),
					$thisParent = $this.parent('.accordion'),
					$thisContent = $( '.accordion-content', $thisParent);

				if ($thisParent.hasClass(activeClass)) {
					$thisParent.removeClass(activeClass);
					$thisContent.slideUp();

				} else {
					for (var i = 0; i < accordLength; i++) {
						var $container = $($accordions[i]);

						if($container.hasClass(activeClass)) {
							$container.removeClass(activeClass);
							$( '.accordion-content', $container).slideUp();
						}
					}

					$thisParent.addClass(activeClass);
					$thisContent.slideDown();
				}
			});			
		}

		readMoreLess($container);

	}

	function readMoreLess($container) {

		var $container = $( '#accordions' ),
			$readMore = $( '.read-more', $container ),
			$showLess = $( '.show-less', $container );

		$readMore.on( 'click', function() {
			var $this = $(this);

			$this.hide();
			$this.siblings('.more-text').slideDown();
			return false;
		});

		$showLess.on( 'click', function() {
			var $this = $(this),
				$text = $this.parent('.more-text');

				console.log('SHOW LESS > ', $text.siblings('.read-more'));

			$text.slideUp();
			$text.siblings('.read-more').show();
			return false;
		});

	}

	$( window ).load( function() {

		body_class();
		findState();
		accordions();

		/* Add dropdown toggle to Custom Menus Widget items */
		$( '.widget_nav_menu ul:not([id^="menu-social"]) .page_item_has_children > a, .widget_nav_menu ul:not([id^="menu-social"]) .menu-item-has-children > a' ).after( '<button class="dropdown-toggle" aria-expanded="false">' + screen_reader_text.expand + '</button>' );

		/* Toggle child menu items */
		$( '.dropdown-toggle' ).click( function( e ) {
			e.preventDefault();
			$( this ).toggleClass( 'toggle-on' );
			$( this ).prev( 'a' ).toggleClass( 'toggle-on' );
			$( this ).next( '.children, .sub-menu' ).toggleClass( 'toggle-on' );
			$( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			$( this ).html( $( this ).html() === screen_reader_text.expand ? screen_reader_text.collapse : screen_reader_text.expand )
		} );

	} ).resize( body_class );

} )( jQuery );
