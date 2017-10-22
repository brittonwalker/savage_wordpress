<?php

namespace Savage;

use Timber;

$context = Timber::get_context();
$context['term'] = new \TimberTerm();

Timber::render( 'index.twig', $context );