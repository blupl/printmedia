<?php $navbar = new Illuminate\Support\Fluent([
    'id'    => 'media',
    'title' => 'Media',
    'url'   => handles('school::media'),
    'menu'  => view('blupl/printmedia::widgets._menu'),
]); ?>

@decorator('navbar', $navbar)
