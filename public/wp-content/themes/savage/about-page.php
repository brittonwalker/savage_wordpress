<?php
/**
 * Template Name: About Template
 * Description: A Page Template for the about page.
 */
 
 namespace Savage;

 use Timber;

 $context = Timber::get_context();

 Timber::render( 'page-about.twig', $context );