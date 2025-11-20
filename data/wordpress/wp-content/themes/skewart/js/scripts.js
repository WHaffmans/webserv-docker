/**
 * Skewart theme navigation and accessibility scripts.
 *
 * Contains handlers for navigation and UI accessibility.
 */

( function() {
	'use strict';

	// DOM elements
	const menu = document.getElementById( 'main-menu-container' );
	const menuToggle = document.querySelector( '.open-menu' );
	const closeMenuButton = document.querySelector( '.close-menu' );
	
	/**
	 * Opens the mobile menu
	 */
	function openMenu() {
		menu.classList.add( 'menu-open' );
		menu.classList.remove( 'menu-closed' );
		menuToggle.setAttribute( 'aria-expanded', 'true' );
		trapFocus();
	}
	
	/**
	 * Closes the mobile menu
	 */
	function closeMenu() {
		menu.classList.remove( 'menu-open' );
		menu.classList.add( 'menu-closed' );
		menuToggle.setAttribute( 'aria-expanded', 'false' );
		menuToggle.focus(); // Return focus to the toggle button
	}
	
	/**
	 * Traps keyboard focus within the mobile menu
	 */
	function trapFocus() {
		const modal = document.getElementById( 'main-menu' );
		
		// Find all focusable elements
		const focusableEls = modal.querySelectorAll( 
			'a[href]:not([disabled]), button:not([disabled]), input[type="text"]:not([disabled]), [tabindex]:not([tabindex="-1"])' 
		);
		
		if ( focusableEls.length ) {
			const firstFocusableEl = focusableEls[0];
			const lastFocusableEl = focusableEls[focusableEls.length - 1];
			
			// Set focus on first element
			firstFocusableEl.focus();
			
			// Trap focus inside the modal
			modal.addEventListener( 'keydown', function( e ) {
				const isTabPressed = ( e.key === 'Tab' || e.keyCode === 9 );
	
				if ( !isTabPressed ) {
					return;
				}
	
				if ( e.shiftKey ) {
					if ( document.activeElement === firstFocusableEl ) {
						lastFocusableEl.focus();
						e.preventDefault();
					}
				} else {
					if ( document.activeElement === lastFocusableEl ) {
						firstFocusableEl.focus();
						e.preventDefault();
					}
				}
			} );
		}
	}
	
	// Initialize event listeners
	document.addEventListener( 'DOMContentLoaded', function() {
		// Ensure menu starts in a properly closed state
		if ( !menu.classList.contains( 'menu-open' ) ) {
			menu.classList.add( 'menu-closed' );
		}
		
		// Add event listeners to menu toggle buttons
		if ( menuToggle ) {
			menuToggle.addEventListener( 'click', function( e ) {
				e.preventDefault();
				openMenu();
			} );
		}
		
		if ( closeMenuButton ) {
			closeMenuButton.addEventListener( 'click', function( e ) {
				e.preventDefault();
				closeMenu();
			} );
		}
		
		// Close menu on outside click
		window.addEventListener( 'click', function( event ) {
			if ( event.target === menu ) {
				closeMenu();
			}
		} );
		
		// Close menu on Escape key
		document.addEventListener( 'keydown', function( event ) {
			if ( event.key === 'Escape' && menu.classList.contains( 'menu-open' ) ) {
				closeMenu();
			}
		} );
	} );
	
} )();
