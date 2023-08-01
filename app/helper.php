<?php


if (!function_exists('image_url')) {
    function image_url($name)
    {
        return url('images/' . $name);
    }
}