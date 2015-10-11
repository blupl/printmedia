<?php $navbar = new Illuminate\Support\Fluent([
    'id'    => 'media',
    'title' => 'Media',
    'url'   => handles('school::student'),
    'menu'  => view('blupl/printmedia::widgets._menu'),
]); ?>

@decorator('navbar', $navbar)
