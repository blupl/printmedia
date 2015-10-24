<?php $navbar = new Illuminate\Support\Fluent([
    'id'    => 'media',
    'title' => 'Print Media',
    'url'   => handles('blupl::media'),
    'menu'  => view('blupl/printmedia::widgets._menu'),
]); ?>

@decorator('navbar', $navbar)
