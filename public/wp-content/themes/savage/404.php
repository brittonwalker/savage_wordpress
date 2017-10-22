<?php

namespace Savage;

use Timber;

$context = Timber::get_context();
$context['taxonomies']['subject'] = Timber::get_terms('subject');
$context['taxonomies']['medium'] = Timber::get_terms('medium');

Timber::render( '404.twig', $context );